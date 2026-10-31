<?php
require_once __DIR__ . '/../config.php';

function clean(string $v): string {
    return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
}

function valid_email(string $e): bool {
    return filter_var($e, FILTER_VALIDATE_EMAIL) !== false;
}

function screenshot_url(string $site): string {
    return '/api/screenshot.php?url=' . urlencode($site);
}

function wa_link(string $msg = ''): string {
    $msg = $msg ?: 'Hi Bala, I am interested for Website or CRM';
    return 'https://wa.me/' . ADMIN_PHONE . '?text=' . urlencode($msg);
}

function send_whatsapp(string $to, string $message): array {
    if (WA_PHONE_NUMBER_ID === 'YOUR_PHONE_NUMBER_ID') {
        return ['ok' => false, 'body' => 'WhatsApp API not configured'];
    }

    $url = 'https://graph.facebook.com/v20.0/' . WA_PHONE_NUMBER_ID . '/messages';

    $payload = [
        'messaging_product' => 'whatsapp',
        'to'                => $to,
        'type'              => 'text',
        'text'              => ['body' => $message],
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WA_ACCESS_TOKEN,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_TIMEOUT        => 15,
    ]);
    $res = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    return ['ok' => $err === '', 'body' => $res ?: $err];
}

function log_lead(array $data): void {
    $dir = __DIR__ . '/../logs';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $line = date('Y-m-d H:i:s') . ' | ' . json_encode($data) . PHP_EOL;
    file_put_contents($dir . '/leads.log', $line, FILE_APPEND | LOCK_EX);
}