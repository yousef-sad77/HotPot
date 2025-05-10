<?php
require_once('../module/db_connect.php');

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$id = intval($data['id']);  // Get user ID from request

if ($id) {
    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);  // Success response
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Delete failed']);  // Error response
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid ID']);  // Invalid ID
