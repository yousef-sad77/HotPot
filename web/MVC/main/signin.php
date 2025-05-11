<?php
require_once('../controller/config_session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']) ?? '';
    $pwd = trim($_POST['password']) ?? '';

    try {
        require_once('../module/signin.php');
        require_once('../controller/signin.php');
    } catch (\Throwable $e) {
        die("Query failed:" . $e->getMessage());
    }

    if (!check_if_signed_up($pwd, $email)) {
        header('Location: ../views/sign.php?form=signin');
        $conn->close();
        die();
    } else {
        if (is_email_admin($email)) {
            header('Location: ../../index.php?page=dashboard');
            die();
        }
        header('Location: ../views/success.php');
        $conn->close();
        die();
    }
}

?>