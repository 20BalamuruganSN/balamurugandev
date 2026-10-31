<?php
require_once __DIR__ . '/../includes/functions.php';

// ---------- 1) Webhook verification (Meta sends GET) ----------
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mode      = $_GET['hub_mode']          ?? $_GET['hub.mode']          ?? '';
    $token     = $_GET['hub_verify_token']  ?? $_GET['hub.verify_token']  ?? '';
    $challenge = $_GET['hub_challenge']     ?? $_GET['hub.challenge']     ?? '';

    if ($mode === 'subscribe' && $token === WA_VERIFY_TOKEN) {
        http_response_code(200);
        echo $challenge;
        exit;
    }
    http_response_code(403);
    echo 'Forbidden';
    exit;
}

// ---------- 2) Incoming messages (POST) ----------
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) { http_response_code(400); exit; }

$entry = $data['entry'][0]['changes'][0]['value'] ?? [];
$messages = $entry['messages'] ?? [];

foreach ($messages as $msg) {
    $from = $msg['from'] ?? '';
    if (!$from) continue;

    $text = strtolower(trim($msg['text']['body'] ?? ''));
    $reply = build_bot_reply($text);
    if ($reply) send_whatsapp($from, $reply);
}

// ---------- Bot logic ----------
function build_bot_reply(string $t): string {
    $packages = $GLOBALS['PACKAGES'];

    $hi =
        "👋 Welcome to *Bala Murugan – Full Stack Engineer*!\n\n" .
        "How can I help you today? Reply with a number:\n\n" .
        "1️⃣ *CRM Subscription* – ₹1,500/month\n" .
        "2️⃣ *Website Development*\n" .
        "3️⃣ *Android App Development*\n" .
        "4️⃣ *View Portfolio*\n" .
        "5️⃣ *Talk to Bala*\n";

    if (in_array($t, ['hi','hello','hey','start','menu',''], true)) {
        return $hi;
    }

    if ($t === '1' || str_contains($t, 'crm')) {
        $p = $packages['crm'];
        return
            "💼 *{$p['name']}*\n\n" .
            "Price: *₹1,500 / month*\n\n" .
            "✅ Lead Management\n" .
            "✅ Customer Management\n" .
            "✅ Products & Services\n" .
            "✅ Quotations\n" .
            "✅ Tasks & Tickets\n" .
            "✅ Reports\n\n" .
            "🔗 Demo: " . CRM_URL . "\n\n" .
            "Reply *BUY* to subscribe or *MENU* to go back.";
    }

    if ($t === '2' || str_contains($t, 'website')) {
        return
            "🌐 *Website Development*\n\n" .
            "Business websites, landing pages, CRM dashboards, e-commerce — built with React.js, PHP MVC, MySQL.\n\n" .
            "💰 Custom quote based on scope.\n\n" .
            "Reply *MENU* to view other services.";
    }

    if ($t === '3' || str_contains($t, 'android') || str_contains($t, 'app')) {
        return
            "📱 *Android App Development*\n\n" .
            "Cross-platform Android apps using React Native + Expo (retail, CRM, KOT, wallet, chat).\n\n" .
            "💰 Custom quote based on scope.\n\n" .
            "Reply *MENU* to view other services.";
    }

    if ($t === '4' || str_contains($t, 'portfolio')) {
        return
            "🚀 *Portfolio*\n\n" .
            "https://balamurugandev.vercel.app\n\n" .
            "Featured: RightHMS · Meddoz · ASkeyCRM · ASkeyRetail · RightKOT · Infuex\n\n" .
            "Reply *MENU* to go back.";
    }

    if ($t === '5' || str_contains($t, 'talk') || str_contains($t, 'contact')) {
        return
            "📞 *Contact Bala Murugan*\n\n" .
            "📧 snbalamurugan20@gmail.com\n" .
            "📱 +91 93849 02854\n" .
            "🔗 linkedin.com/in/bala-murugan-34a7bb244\n\n" .
            "Reply *MENU* to go back.";
    }

    if ($t === 'buy' || str_contains($t, 'subscribe')) {
        return
            "🛒 *Work Smart CRM Subscription*\n\n" .
            "₹1,500 / month\n\n" .
            "To activate your subscription:\n" .
            "1. Reply with your business name\n" .
            "2. We will send a payment link\n" .
            "3. Access is provisioned within 24 hours\n\n" .
            "Or email: snbalamurugan20@gmail.com";
    }

    return
        "Sorry, I didn't catch that.\n\n" . $hi;
}