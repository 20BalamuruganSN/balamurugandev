<?php
/**
 * Portfolio Configuration
 * ⚠️ Change these values before deploying.
 */

// ---------- SMTP (Gmail) ----------
define('SMTP_HOST',      'smtp.gmail.com');
define('SMTP_PORT',      587);
define('SMTP_USER',      'snbalamurugan20@gmail.com');
define('SMTP_PASS',      'zajf rkcq npqh uqfx'); // https://myaccount.google.com/apppasswords
define('SMTP_FROM',      'snbalamurugan20@gmail.com');
define('SMTP_FROM_NAME', 'Bala Murugan Portfolio');

// ---------- Leads inbox ----------
define('LEAD_EMAIL', 'snbalamurugan20@gmail.com');

// ---------- WhatsApp (Meta Cloud API) — optional ----------
define('WA_PHONE_NUMBER_ID', 'YOUR_PHONE_NUMBER_ID');
define('WA_ACCESS_TOKEN',    'YOUR_PERMANENT_ACCESS_TOKEN');
define('WA_VERIFY_TOKEN',    'bala_portfolio_verify_2026');
define('WA_ADMIN_NUMBER',    '919384902854');

// ---------- Public links ----------
define('CRM_URL',        'https://worksmartcrm.vercel.app');
define('PORTFOLIO_URL',  'https://balamurugandev.vercel.app');
define('ADMIN_PHONE',    '919384902854');

// ---------- Screenshot API ----------
define('SCREENSHOT_API', 'https://image.thum.io/get/width/1200/crop/800/noanimate/');

// ---------- Packages ----------
$GLOBALS['PACKAGES'] = [
    'crm' => [
        'name'     => 'Work Smart CRM Subscription',
        'price'    => 1500,
        'duration' => 'month',
        'desc'     => 'Monthly CRM subscription — leads, customers, quotations, tasks, tickets.',
    ],
    'website' => [
        'name'     => 'Website Development',
        'price'    => 0,
        'duration' => 'one-time',
        'desc'     => 'Custom business website / web application development.',
    ],
    'android' => [
        'name'     => 'Android App Development',
        'price'    => 0,
        'duration' => 'one-time',
        'desc'     => 'Cross-platform Android app development (React Native + Expo).',
    ],
];

// Logging
ini_set('display_errors', 0);
error_reporting(E_ALL);