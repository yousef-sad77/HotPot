<?php

function is_email_admin(string $email)
{
    // First, check if it's a valid email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Parse the domain part of the email
        $domain = substr(strrchr($email, "@"), 1);

        // Check if it matches the required admin domain
        if ($domain === "admin.example.com") {
            return true; // It's a valid admin email
        } else {
            $_SESSION['form_data']['signin']['email']['error'] = "Please use a valid admin email (e.g., user@admin.example.com)";
            return false;
        }
    } else {
        $_SESSION['form_data']['signin']['email']['error'] = "Invalid email format";
        return false;
    }
}