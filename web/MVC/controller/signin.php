<?php

require_once("../module/db_connect.php");
require_once("../module/signin.php");
require_once("../controller/signup.php");



get_username_from_email($conn, $email);

function check_if_signed_up(string $pwd, string $email): bool
{
    global $conn;
    // Step 1: Call the module function to check if the user exists and verify the password
    $user_data = check_user_exists($conn, $email, $pwd);
    
    if ($user_data) {
        // If user data is returned, set the session data
        set_user_data_session($user_data['uuid'], $user_data['username'], $email);
        return true; // User is successfully authenticated
    }

    // If user does not exist or password verification fails, unset session data and return false
    unset_user_data_session();
    return false;
}

function is_email_admin(string $email)
{
    global $conn;

    // First, check if it's a valid email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Parse the domain part of the email
        $domain = substr(strrchr($email, "@"), 1);
        // Check if it matches the required admin domain
        if ($domain === "admin.hotpot.com") {
            $_SESSION['admin_id'] = get_uuid_by_email($conn, $email);
            return true; // It's a valid admin email
        } else {
            $_SESSION['form_data']['signin']['email']['error'] = "Please use a valid admin email";
            return false;
        }
    } else {
        $_SESSION['form_data']['signin']['email']['error'] = "Invalid email format";
        return false;
    }
}

