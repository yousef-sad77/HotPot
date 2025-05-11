<?php
require_once('../controller/config_session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $pwd = trim($_POST['password']) ?? '';

    try {
        require_once('../module/signup.php');
        require_once('../controller/signup.php');
    } catch (\Throwable $e) {
        die("Query failed:" . $e->getMessage());
    }

    if (any_error($username, $pwd, $email)) {

        header('Location: ../views/sign.php?form=signup');
        $conn->close();
        die();
    } else {
        sign_up($username, $pwd, $email);
        verify_session_user($username, $email);
        header('Location: ../views/success.php');
        $conn->close();
        die();
    }
}

?>