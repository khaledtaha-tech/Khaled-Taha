<?php
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../app/Helpers/functions.php';
require_once __DIR__ . '/../app/Helpers/db.php';

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

// Insert directly into Turso DB Cloud
$sql = "INSERT INTO inquiries (date, name, company, email, inquiry_type, message) VALUES (?, ?, ?, ?, ?, ?)";
$params = [date('Y-m-d H:i:s'), $name, $company, $email, $inquiry_type, $message];

$res = turso_query($sql, $params);

ob_end_clean();
if ($res !== null) {
    echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database Storage Error.']);
}
