<?php

declare(strict_types=1);

function get_username(mysqli $conn, string $username)
{
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        return true;
    }
    return false;
}
function get_email(mysqli $conn, string $email)
{
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        return true;
    }
    return false;
}

function create_user(mysqli $conn, string $username, string $pwd, string $email)
{
    // Check if username already exists

    $option = [
        'cost' => 12,
    ];
    $hashedPassword = password_hash($pwd, PASSWORD_BCRYPT, $option);

    // Proceed with the insertion if the username is unique
    $stmt = $conn->prepare("INSERT INTO users (uuid, username, pwd, email) VALUES (UUID(), ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        return true; // User successfully created
    } else {
        return false;
    }
}

function get_uuid(mysqli $conn, string $username): ?string
{
    // Prepare SQL query to retrieve UUID based on the username
    $stmt = $conn->prepare("SELECT uuid FROM users WHERE username = ?");

    // Check if prepare statement was successful
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $stmt->bind_result($uuid);
    $stmt->fetch();
    $stmt->close();
    return $uuid ? $uuid : null;
}

function check_for_user_info(mysqli $conn, string $username, string $email): bool
{
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND uuid = ? AND email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $uuid, $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if ($count === 1) {
        return true;
    } else {
        return false;
    }

}

