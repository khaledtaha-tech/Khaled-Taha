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

$json_input = json_decode(file_get_contents('php://input'), true);

$product_id = trim($_POST['product_id'] ?? $json_input['product_id'] ?? '');
$product_name = trim($_POST['product_name'] ?? $json_input['product_name'] ?? '');
$price = trim($_POST['price'] ?? $json_input['price'] ?? '');

if (empty($product_name)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Product details missing.']);
    exit;
}

// حفظ طلب الواتساب في ملف JSON أو جدول الواتساب في Turso
$file = __DIR__ . '/../data/whatsapp_orders.json';
$orders = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$new_order = [
    'date' => date('Y-m-d H:i:s'),
    'product_id' => $product_id,
    'product_name' => $product_name,
    'price' => $price
];

array_unshift($orders, $new_order);

// التأكد من وجود مجلد data
if (!is_dir(__DIR__ . '/../data')) {
    mkdir(__DIR__ . '/../data', 0755, true);
}

file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT));

ob_end_clean();
echo json_encode(['success' => true]);
