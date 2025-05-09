<?php
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
    // Prepare the SQL query to fetch the stored password hash based on the email
    $stmt = $conn->prepare("SELECT pwd, username, uuid FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists with the provided email
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedHashedPassword, $username, $uuid);
        $stmt->fetch();

        // Verify the provided password matches the stored hash
        if (password_verify($pwd, $storedHashedPassword)) {
            return ['username' => $username, 'uuid' => $uuid];
        }
    }

    // Return null if the user does not exist or the password is incorrect
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
