<?php
require_once('../module/db_connect.php'); // your DB connection

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$id = intval($data['id']);
$name = trim($data['name']);
$description = trim($data['description']);
$price = floatval($data['price']);

if ($id && $name && $description && $price) {
    $stmt = $conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $name, $description, $price, $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false]);
