<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// ---------- Read input ----------
$name    = clean($_POST['name']    ?? '');
$email   = clean($_POST['email']   ?? '');
$phone   = clean($_POST['phone']   ?? '');
$package = clean($_POST['package'] ?? '');
$message = clean($_POST['message'] ?? '');

// ---------- Validate ----------
$errors = [];
if (strlen($name) < 2)              $errors[] = 'Name is required.';
if (!valid_email($email))           $errors[] = 'Valid email is required.';
if (!preg_match('/^[0-9+\-\s]{8,15}$/', $phone)) $errors[] = 'Valid phone required.';
if (!in_array($package, ['crm','website','android'], true)) $errors[] = 'Invalid package.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

$pkg = $GLOBALS['PACKAGES'][$package];
$priceLabel = $pkg['price'] > 0
    ? '₹' . number_format($pkg['price']) . ' / ' . $pkg['duration']
    : 'Custom Quote';

// ---------- 1) Send email to admin ----------
$mail = new PHPMailer(true);
$emailSent = false;

try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress(LEAD_EMAIL);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "New Lead: {$pkg['name']} — {$name}";
    $mail->Body = "
        <h2 style='font-family:Arial'>New Enquiry</h2>
        <table style='font-family:Arial;font-size:14px;border-collapse:collapse'>
          <tr><td style='padding:6px 12px'><b>Name</b></td><td>{$name}</td></tr>
          <tr><td style='padding:6px 12px'><b>Email</b></td><td>{$email}</td></tr>
          <tr><td style='padding:6px 12px'><b>Phone</b></td><td>{$phone}</td></tr>
          <tr><td style='padding:6px 12px'><b>Package</b></td><td>{$pkg['name']}</td></tr>
          <tr><td style='padding:6px 12px'><b>Price</b></td><td>{$priceLabel}</td></tr>
          <tr><td style='padding:6px 12px'><b>Message</b></td><td>" . nl2br($message) . "</td></tr>
        </table>";

    $mail->send();
    $emailSent = true;
} catch (Exception $e) {
    error_log('Mail error: ' . $mail->ErrorInfo);
}

// ---------- 2) Notify admin on WhatsApp ----------
$waAdminMsg =
    "🔔 *New Lead — Portfolio*\n\n" .
    "👤 {$name}\n" .
    "📧 {$email}\n" .
    "📱 {$phone}\n" .
    "📦 *{$pkg['name']}*\n" .
    "💰 {$priceLabel}\n\n" .
    ($message ? "💬 {$message}" : '');

$waResult = send_whatsapp(WA_ADMIN_NUMBER, $waAdminMsg);

// ---------- 3) Auto-reply to user's WhatsApp (if 10-digit -> +91) ----------
$userWA = preg_replace('/\D/', '', $phone);
if (strlen($userWA) === 10) $userWA = '91' . $userWA;
if (strlen($userWA) >= 11 && $userWA[0] !== '9') {
    // skip if invalid international
} else {
    $autoReply =
        "Hi {$name} 👋\n\n" .
        "Thank you for your interest in *{$pkg['name']}*.\n\n" .
        "💰 Price: *{$priceLabel}*\n" .
        "🔗 " . ($package === 'crm' ? CRM_URL : 'https://balamurugandev.vercel.app') . "\n\n" .
        "Bala Murugan will get back to you shortly on WhatsApp and email.\n\n" .
        "— Bala Murugan | Full Stack Engineer";
    send_whatsapp($userWA, $autoReply);
}

// ---------- 4) Log ----------
log_lead(compact('name','email','phone','package','message','priceLabel','emailSent'));

// ---------- 5) Response ----------
echo json_encode([
    'ok'        => true,
    'emailSent' => $emailSent,
    'message'   => 'Thank you! Your enquiry was received. We will contact you on WhatsApp & email shortly.',
]);