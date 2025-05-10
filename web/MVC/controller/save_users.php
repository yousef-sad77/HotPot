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

// Collect the data
$username = trim($data['username']);
$email = trim($data['email']);
$password = trim($data['password']); // Handle password securely
$role = trim($data['role']); // Assuming a 'role' field (e.g., admin, user, etc.)

if ($username && $email && $password && $role) {
    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement for inserting the user
    $stmt = $conn->prepare("INSERT INTO users (uuid,username, email, pwd, role) VALUES (UUID(),?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]); // Return the ID of the inserted user
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Insert failed']);
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Missing required fields']);
