<?php

declare(strict_type=1);

require_once("../module/db_connect.php");
// double check:
if (!$connected) {
    echo "database are not connected";
}
//
require_once("./config_session.php");
$_SESSION['form_data'];

function all(array $items, callable $callback): bool
{
    foreach ($items as $item) {
        if (!$callback($item)) {
            return false;
        }
    }
    return true;
}
function any(array $items, callable $callback): bool
{
    foreach ($items as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
}

function is_empty($x)
{
    return empty($x);
}
function is_filled($x)
{
    return !empty($x);
}
function is_input_empty(string $username, string $pwd, string $email)
{
    $args = func_get_args();
    if (all($args, 'is_filled')) /* all are filled => false. other wise => continue */ {
        $_SESSION['form_data']['global_error'][] = "";
        return false;
    } elseif (any($args, 'is_filled')) /* only(one or two empty || one or two filled) => true. other wise => false */ {
        $one_or_more = 0;
        if (is_empty($username)) {
            $_SESSION['form_data']['username']['error'] = "Username is required";
        }
        if (is_empty($email)) {
            $_SESSION['form_data']['email']['error'] = "Email is required";
        }
        if (is_empty($pwd)) {
            $_SESSION['form_data']['password']['error'] = "Password is required";
        }
        return true;

        //              not required in the homework details!
        // if (empty($confirm_password)) {
        //     $errors['confirm_password'] = "Confirm password is required";
        // } elseif ($password !== $confirm_password) {
        //     $errors['confirm_password'] = "Passwords do not match";
        // }
    } elseif (all($args, 'is_empty')) /* all are empty => true. other wise => false*/ {
        $_SESSION['form_data']['global_error'][] = "Please fill in all fields with valid data.";
        return true;
    } else {
        return false;
    }
}

function is_password_strong(string $pwd)
{
    if (preg_match_all('/[A-Z]/', $pwd) > 2) {
        $_SESSION['form_data']['password']['detailed_error'][] = "at least 3 capital";
    }
    if (preg_match_all('/[a-z]/', $pwd) > 2) {
        $_SESSION['form_data']['password']['detailed_error'][] = "at least 3 lower";
    }
    if (preg_match_all('/[0-9]/', $pwd) > 2) {
        $_SESSION['form_data']['password']['detailed_error'][] = "at least 3 number";
    }

}
function is_password_length_valid(string $pwd)
{
    if (strlen($pwd) < 9) {
        $_SESSION['form_data']['password']['detailed_error'][] = "Password must be at least 10 characters long, password way too short";
    } elseif (strlen($pwd) < 65) {
        $_SESSION['form_data']['password']['detailed_error'][] = "Password must be at most 64 characters long, password way too long";
    }
}
function is_email_valid(string $email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['form_data']['email']['error'] = "Please fill in a valid email";
        return true;
    } else {
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
        $_SESSION['form_data']['email']['error'] = "email already registered";
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
        $_SESSION['form_data']['username']['error'] = "user name already taken";
        return true;
    } else {
        return false;
    }
}

function any_error(string $username,string $pwd,string $email)
{
    // $field_error = is_filled($_SESSION['form_data']['username']['error']) || is_filled($_SESSION['form_data']['email']['error']) || is_filled($_SESSION['form_data']['password']['error']);
    // $global_error = is_filled($_SESSION['form_data']['global_error']);
    // $password_detailed_error = is_filled($_SESSION['form_data']['password']['detailed_error']);
    // if ($global_error || $password_detailed_error || $field_error) {
    //     return true;
    // } else {
    //     return false;
    // }

    return is_input_empty($username, $pwd, $email) || is_password_strong($pwd) || is_password_length_valid($pwd) || is_email_valid($email) || is_email_registered($email) || is_username_taken($username);
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
//             $_SESSION['form_data']['email']['error'] = "email already registered";
//             return true;
//         }
//         return false;
//     }
// }
