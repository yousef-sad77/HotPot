<?php
require_once('../module/db_connect.php');
header('Content-Type: application/json');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$name = trim($data['name']);
$description = trim($data['description']);
$price = floatval($data['price']);
$amount = intval($data['amount']);

if ($name && $description && $price) {
    $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $price, $amount);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Insert failed']);
