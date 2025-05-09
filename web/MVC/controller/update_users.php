<?php
require_once('../module/db_connect.php');

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'], $data['username'], $data['email'], $data['role'])) {
    echo json_encode(['success' => false, 'error' => 'Missing fields']);
    exit;
}

$id = intval($data['id']);
$username = trim($data['username']);
$email = trim($data['email']);
$role = trim($data['role']);

// Simple validation (expand as needed)
if ($id <= 0 || !$username || !$email || !$role) {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
$stmt->bind_param("sssi", $username, $email, $role, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
