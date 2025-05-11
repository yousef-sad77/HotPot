<?php
require_once('../controller/config_session.php');
function check_if_super_admin(string $pwd, string $email): bool
{
    if ($pwd === "aaAA11" && $email === 'super.admin@hotpot.com') {
        return true;
    }
    return false;
}
function check_if_admin(mysqli $conn, string $pwd, string $email): bool
{
    if ($pwd === "aaAA11" && $email === 'super.admin@hotpot.com') {
        return true;
    }
    return false;
}

function check_user_exists(mysqli $conn, string $email, string $pwd): ?array
{
    $stmt = $conn->prepare("SELECT pwd, username, uuid FROM users WHERE email = ?");
    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedHashedPassword, $username, $uuid);
        $stmt->fetch();

        if (password_verify($pwd, $storedHashedPassword)) {
            // Clean up old errors and form data on success
            unset($_SESSION['form_data']['signin']);
            return ['username' => $username, 'uuid' => $uuid];
        } else {
            $_SESSION['form_data']['signin']['password']['error'] = 'password does not match';
        }
    } else {
        $_SESSION['form_data']['signin']['email']['error'] = 'email not signed up';
        $_SESSION['form_data']['signin']['password']['error'] = '';
    }

    return null;
}


function get_username_from_email($conn, string $email): ?string
{
    $stmt = $conn->prepare("SELECT username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['username'];
    }

    return null;
}
