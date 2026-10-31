<?php
/**
 * api/screenshot.php
 * ------------------------------------------------------------
 * Serves a cached website screenshot. Fetches from thum.io
 * (or configured API) once per 24 hours, then serves the cached
 * JPG file on every subsequent request.
 *
 * Usage:  /api/screenshot.php?url=https://righthms.com
 * ------------------------------------------------------------
 */

require_once __DIR__ . '/../config.php';

/* ============================================================
   1. VALIDATE INPUT
   ============================================================ */
$url = trim($_GET['url'] ?? '');

// Must be a valid URL
if ($url === '' || !filter_var($url, FILTER_VALIDATE_URL)) {
    respond_error(400, 'Invalid URL');
}

// Only allow http(s)
$scheme = strtolower(parse_url($url, PHP_URL_SCHEME) ?: '');
if (!in_array($scheme, ['http', 'https'], true)) {
    respond_error(400, 'Only http and https URLs allowed');
}

// Optional: whitelist hosts (uncomment and add your domains for safety)
/*
$allowedHosts = ['righthms.com', 'meddoz.com', 'sriganeshfoods.in', 'smartsteno.azurewebsites.net'];
$host = strtolower(parse_url($url, PHP_URL_HOST) ?: '');
if (!in_array($host, $allowedHosts, true)) {
    respond_error(403, 'Host not allowed');
}
*/

/* ============================================================
   2. SETUP CACHE DIRECTORY
   ============================================================ */
$cacheDir = __DIR__ . '/../assets/img/cache';

if (!is_dir($cacheDir)) {
    if (!@mkdir($cacheDir, 0755, true) && !is_dir($cacheDir)) {
        error_log('[screenshot] Cannot create cache dir: ' . $cacheDir);
        respond_error(500, 'Cache directory not writable');
    }
}

// Ensure it's writable
if (!is_writable($cacheDir)) {
    error_log('[screenshot] Cache dir not writable: ' . $cacheDir);
    respond_error(500, 'Cache directory not writable');
}

/* ============================================================
   3. DETERMINE CACHE FILE
   ============================================================ */
$hash     = md5($url);
$cacheFile = $cacheDir . '/' . $hash . '.jpg';
$ttl       = 86400; // 24 hours
$needsFetch = !file_exists($cacheFile) || (time() - filemtime($cacheFile)) > $ttl;

/* ============================================================
   4. FETCH FRESH SCREENSHOT IF NEEDED
   ============================================================ */
if ($needsFetch) {
    $fetched = fetch_screenshot($url, $cacheFile);

    if (!$fetched && !file_exists($cacheFile)) {
        // No cache, fetch failed → serve fallback placeholder
        serve_fallback($url);
    }
    // If fetch failed but old cache exists → fall through and serve old cache
}

/* ============================================================
   5. SERVE THE CACHED IMAGE
   ============================================================ */
serve_image($cacheFile);


/* ============================================================
   HELPER FUNCTIONS
   ============================================================ */

/**
 * Fetch screenshot from remote API and save to cache.
 * Returns true on success, false on failure.
 */
function fetch_screenshot(string $url, string $cacheFile): bool
{
    $apiUrl = SCREENSHOT_API . urlencode($url);

    // --- Try cURL first (more reliable) ---
    if (function_exists('curl_init')) {
        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Portfolio Screenshot Bot)',
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_FAILONERROR    => false,
        ]);

        $data     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($data !== false && $httpCode === 200 && strlen($data) > 1000) {
            if (save_image($data, $cacheFile)) {
                return true;
            }
        } else {
            error_log("[screenshot] cURL failed for $url — HTTP $httpCode — $err");
        }
    }

    // --- Fallback to file_get_contents ---
    $ctx = stream_context_create([
        'http' => [
            'timeout'       => 30,
            'user_agent'    => 'Mozilla/5.0 (Portfolio Screenshot Bot)',
            'ignore_errors' => true,
        ],
        'ssl' => [
            'verify_peer'      => true,
            'verify_peer_name' => true,
        ],
    ]);

    $data = @file_get_contents($apiUrl, false, $ctx);

    if ($data !== false && strlen($data) > 1000) {
        return save_image($data, $cacheFile);
    }

    error_log("[screenshot] file_get_contents failed for $url");
    return false;
}

/**
 * Validate the image and save atomically to disk.
 */
function save_image(string $data, string $cacheFile): bool
{
    // Verify it's a real image
    $info = @getimagesizefromstring($data);
    if ($info === false) {
        error_log('[screenshot] Invalid image data received');
        return false;
    }

    // Only allow JPEG / PNG / WEBP
    $allowed = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP];
    if (!in_array($info[2], $allowed, true)) {
        error_log('[screenshot] Unsupported image type: ' . $info[2]);
        return false;
    }

    // Save to temp file first, then rename (atomic write)
    $tmp = $cacheFile . '.tmp.' . getmypid();

    if (@file_put_contents($tmp, $data, LOCK_EX) === false) {
        error_log('[screenshot] Cannot write temp file: ' . $tmp);
        return false;
    }

    if (!@rename($tmp, $cacheFile)) {
        @unlink($tmp);
        error_log('[screenshot] Cannot rename temp file to cache');
        return false;
    }

    @chmod($cacheFile, 0644);
    return true;
}

/**
 * Send the cached image to the client with proper headers.
 */
function serve_image(string $cacheFile): void
{
    if (!is_file($cacheFile)) {
        respond_error(404, 'Not found');
    }

    $size = @filesize($cacheFile);
    if ($size === false || $size === 0) {
        respond_error(500, 'Empty cache file');
    }

    // Basic caching headers
    header('Content-Type: image/jpeg');
    header('Content-Length: ' . $size);
    header('Cache-Control: public, max-age=86400, immutable');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($cacheFile)) . ' GMT');

    // ETag support for 304 Not Modified
    $etag = '"' . md5_file($cacheFile) . '"';
    header('ETag: ' . $etag);

    if (($_SERVER['HTTP_IF_NONE_MATCH'] ?? '') === $etag) {
        http_response_code(304);
        exit;
    }

    // Support HEAD requests (no body)
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'HEAD') {
        exit;
    }

    // Stream with readfile (handles big files efficiently)
    readfile($cacheFile);
    exit;
}

/**
 * Serve an inline SVG placeholder if screenshot is unavailable.
 */
function serve_fallback(string $url): void
{
    $host  = parse_url($url, PHP_URL_HOST) ?: 'Website';
    $host  = htmlspecialchars($host, ENT_QUOTES, 'UTF-8');
    $label = $host;

    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#e0f2fe"/>
      <stop offset="100%" stop-color="#dbeafe"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="800" fill="url(#g)"/>
  <rect x="40" y="40" width="1120" height="80" rx="14" fill="#ffffff" opacity="0.7"/>
  <circle cx="80" cy="80" r="10" fill="#f87171"/>
  <circle cx="110" cy="80" r="10" fill="#fbbf24"/>
  <circle cx="140" cy="80" r="10" fill="#34d399"/>
  <text x="600" y="440" font-family="Poppins, Arial, sans-serif"
        font-size="46" font-weight="700" fill="#0f6fff" text-anchor="middle">
    {$label}
  </text>
  <text x="600" y="500" font-family="Poppins, Arial, sans-serif"
        font-size="22" fill="#64748b" text-anchor="middle">
    Screenshot unavailable — click to visit
  </text>
</svg>
SVG;

    header('Content-Type: image/svg+xml');
    header('Cache-Control: public, max-age=3600');
    header('Content-Length: ' . strlen($svg));
    echo $svg;
    exit;
}

/**
 * Send a JSON error response and exit.
 */
function respond_error(int $code, string $msg): void
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'error' => $msg]);
    exit;
}