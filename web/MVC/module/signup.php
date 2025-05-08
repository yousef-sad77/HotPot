<?php

declare(strict_type=1);

function get_username(object $conn, string $username)
{
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // cd .\web\MVC\module\ && php signup.php 
    echo $row;
    if (!empty($row)) {
        return [0 => true, 1 => $row['username']];
    } else {
        return [0 => false, 1 => ""];
    }
}
function get_email(object $conn, string $email)
{
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT username FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // cd .\web\MVC\module\ && php signup.php 
    // todo 
    echo $row;
    if (!empty($row)) {
        return [0 => true, 1 => $row['email']];
    } else {
        $row['email'] = '';
        return [0 => false, 1 => $row['email']];
    }
}
