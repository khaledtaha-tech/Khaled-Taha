<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../app/Helpers/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$product_id = trim($_POST['product_id'] ?? '');
$product_name = trim($_POST['product_name'] ?? '');
$price = trim($_POST['price'] ?? '');

$file_path = __DIR__ . '/../data/whatsapp_orders.json';
$orders = file_exists($file_path) ? json_decode(file_get_contents($file_path), true) : [];

$new_order = [
    'id' => time(),
    'date' => date('Y-m-d H:i:s'),
    'product_id' => htmlspecialchars($product_id),
    'product_name' => htmlspecialchars($product_name),
    'price' => htmlspecialchars($price)
];

array_unshift($orders, $new_order);

if (file_put_contents($file_path, json_encode($orders, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
