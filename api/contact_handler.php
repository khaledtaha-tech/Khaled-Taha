<?php
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../app/Helpers/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$company = trim($_POST['company'] ?? '');
$email = trim($_POST['email'] ?? '');
$inquiry_type = trim($_POST['inquiry_type'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Please fill in required fields.']);
    exit;
}

// Ensure data directory exists on server
$dir_path = __DIR__ . '/../data';
if (!is_dir($dir_path)) {
    mkdir($dir_path, 0777, true);
}

$file_path = $dir_path . '/inquiries.json';
$inquiries = file_exists($file_path) ? json_decode(file_get_contents($file_path), true) : [];

if (!is_array($inquiries)) {
    $inquiries = [];
}

$new_inquiry = [
    'id' => time(),
    'date' => date('Y-m-d H:i:s'),
    'name' => htmlspecialchars($name),
    'company' => htmlspecialchars($company),
    'email' => htmlspecialchars($email),
    'inquiry_type' => htmlspecialchars($inquiry_type),
    'message' => htmlspecialchars($message)
];

array_unshift($inquiries, $new_inquiry);

ob_end_clean();
if (file_put_contents($file_path, json_encode($inquiries, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save message. Check server write permissions.']);
}
