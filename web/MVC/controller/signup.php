<?php

declare(strict_types=1);

require_once("../module/db_connect.php");
require_once("../module/signup.php");
// double check:
if (!$connected) {
    echo "database are not connected";
}
//
require_once("config_session.php");

require_once("utility.php");
function is_input_empty(string $username, string $pwd, string $email)
{
    $args = func_get_args();
    if (all($args, 'is_filled')) /* all are filled => false. other wise => continue */ {
        unset($_SESSION['form_data']['signup']['global_error']);
        return false;
    } elseif (any($args, 'is_filled')) /* only(one or two empty || one or two filled) => true. other wise => false */ {
        if (is_empty($username)) {
            $_SESSION['form_data']['signup']['username']['error'] = "Username is required";
        }
        if (is_empty($email)) {
            $_SESSION['form_data']['signup']['email']['error'] = "Email is required";
        }
        if (is_empty($pwd)) {
            $_SESSION['form_data']['signup']['password']['error'] = "Password is required";
        }
        return true;

        //              not required in the homework details!
        // if (empty($confirm_password)) {
        //     $errors['confirm_password'] = "Confirm password is required";
        // } elseif ($password !== $confirm_password) {
        //     $errors['confirm_password'] = "Passwords do not match";
        // }
    } elseif (all($args, 'is_empty')) /* all are empty => true. other wise => false*/ {
        $_SESSION['form_data']['signup']['global_error'] = "Please fill in all fields with valid data.";
        return true;
    } else {
        return false;
    }
}

function is_password_strong(string $pwd)
{
    $is_strong = true;

    // Check if the password has at least 3 uppercase letters
    if (preg_match_all('/[A-Z]/', $pwd) < 2) {
        $_SESSION['form_data']['signup']['password']['detailed_error'][] = "at least 3 uppercase letters required";
        $is_strong = false;
    }

    // Check if the password has at least 3 lowercase letters
    if (preg_match_all('/[a-z]/', $pwd) < 2) {
        $_SESSION['form_data']['signup']['password']['detailed_error'][] = "at least 3 lowercase letters required";
        $is_strong = false;
    }

    // Check if the password has at least 3 numbers
    if (preg_match_all('/[0-9]/', $pwd) < 2) {
        $_SESSION['form_data']['signup']['password']['detailed_error'][] = "at least 3 numbers required";
        $is_strong = false;
    }

    return $is_strong;
}

function is_password_length_valid(string $pwd)
{
    if (strlen($pwd) < 9) {
        $_SESSION['form_data']['signup']['password']['detailed_error'][] = "Password must be at least 10 characters long, password way too short";
        return false;
    }
    if (strlen($pwd) > 64) {
        $_SESSION['form_data']['signup']['password']['detailed_error'][] = "Password must be at most 64 characters long, password way too long";
        return false;
    }
    return true;
}
function is_email_valid(string $email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        $_SESSION['form_data']['signup']['email']['error'] = "Please fill in a valid email";
        return false;
    }
}

function is_email_registered(string $email)
{
    global $conn;
    if (get_email($conn, $email)) {
        if (!$conn) {
            echo "is_email_registered function does not have connection to database";
        }
        $_SESSION['form_data']['signup']['email']['error'] = "email already registered";
        return true;
    } else {
        return false;
    }
}
function is_username_taken(string $username)
{
    global $conn;
    if (get_username($conn, $username)) {
        if (!$conn) {
            echo "is_username_taken function does not have connection to database";
        }
        $_SESSION['form_data']['signup']['username']['error'] = "user name already taken";
        return true;
    } else {
        return false;
    }
}

function any_error(string $username, string $pwd, string $email)
{
    if (is_input_empty($username, $pwd, $email)) {
        return true; // immediately return if inputs are empty
    }
    return !(is_password_strong($pwd) && is_password_length_valid($pwd) && is_email_valid($email) && !is_email_registered($email) && !is_username_taken($username));
}



function sign_up($username, $pwd, $email)
{

    global $conn;
    if (!$conn) {
        echo "sign_up function does not have connection to database";
    }
    $create_response = create_user($conn, $username, $pwd, $email);
    if ($create_response) {
        echo 'user got added';
    } else {
        echo 'user did not got added';
    }
}
function verify_session_user(string $username, string $email): bool
{
    global $conn;

    if (!$conn) {
        echo "No DB connection.";
        return false;
    }

    // Check if the user exists in the DB
    if (check_for_user_info($conn, $username, $email)) {
        $uuid = get_uuid_by_username($conn, $username);
        set_user_data_session($uuid, $username, $email);
        return true;
    } else {
        unset_user_data_session();
        return false;
    }
}
function verify_user_exist(string $pwd, string $email): bool
{
    global $conn;

    if (!$conn) {
        echo "No DB connection.";
        return false;
    }

    // Check if the user exists in the DB and verify password
    if (check_for_user_info($conn, $pwd, $email)) {
        // Assuming get_uuid returns the user's UUID, and the username can be retrieved
        $uuid = get_uuid_by_email($conn, $email);  // Use email to get UUID
        $username = get_username_from_email($conn, $email);  // Assuming this function fetches the username by email

        if ($username) {
            // Set the session variables with username, email, and UUID
            set_user_data_session($uuid, $username, $email);
            return true;
        }
    }

    // If the user does not exist or any condition fails, unset the session data
    unset_user_data_session();
    return false;
}


function set_user_data_session($uuidid, $username, $email)
{
    $_SESSION['user_id'] = $uuidid;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
}
function unset_user_data_session()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
}



    // global does not get read form local
    // marking conn with global keyword does not let you later to reuse it
    // making a class the have the conn would require an import 
    
    
    // maybe i change approach later:
    // class FormValidator {
    //     private mysqli $conn;
    
    //     public function __construct(mysqli $conn) {
    //         $this->conn = $conn;
    //     }
    
    //     public function is_email_registered(string $email): bool {
    //         if (get_email($this->conn, $email)) {
    //             $_SESSION['form_data']['signup']['email']['error'] = "email already registered";
    //             return true;
    //         }
    //         return false;
    //     }
    // }