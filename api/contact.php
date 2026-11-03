<?php
// api/contact.php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || empty($data['name']) || empty($data['email']) || empty($data['phone']) || empty($data['plan'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$name = htmlspecialchars(strip_tags($data['name']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(strip_tags($data['phone']));
$plan = htmlspecialchars(strip_tags($data['plan']));

// 1. SEND EMAIL NOTIFICATION
$to = 'snbalamurugan20@gmail.com';
$subject = "New Inquiry: $plan";
$message = "You have received a new request.\n\nName: $name\nEmail: $email\nPhone: $phone\nPlan: $plan\nDate: " . date('Y-m-d H:i:s');
$headers = "From: noreply@balamurugandev.com\r\nReply-To: $email\r\n";
$mail_sent = @mail($to, $subject, $message, $headers);

// 2. SEND WHATSAPP BOT MESSAGE (CallMeBot API)
// Setup: Send "I allow callmebot to send me messages" to +34 644 44 44 44 on WhatsApp to get your API key.
$whatsapp_api_key = 'YOUR_API_KEY_HERE'; // Replace this!
$whatsapp_phone = '+919384902854';

if ($whatsapp_api_key !== 'YOUR_API_KEY_HERE') {
    $wa_message = urlencode("🚀 *New Lead!*\n\n*Name:* $name\n*Email:* $email\n*Phone:* $phone\n*Interest:* $plan");
    $wa_url = "https://api.callmebot.com/whatsapp.php?phone=$whatsapp_phone&text=$wa_message&apikey=$whatsapp_api_key";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $wa_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
    curl_exec($ch);
    curl_close($ch);
}

echo json_encode(['success' => true, 'message' => 'Request processed successfully']);