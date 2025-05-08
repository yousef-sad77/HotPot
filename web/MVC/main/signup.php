<?php
require_once 'config_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $pwd = trim($_POST['password']) ?? '';
    // confirm password

    try {

        require_once '../module/signup.php';
        require_once '../controller/signup.php';

    } catch (\Throwable $e) {
        die("Query failed:" . $e->getMessage());
    }

    if (any_error($username, $pwd, $email)) {

        die();
    } else  {
        sign_up($username, $pwd, $email);
        header('Location: success.php');
    }
    //todo
    $_SESSION['form_data']['signup'];




} else {
    header("location: ../index.php");
    die("Invalid request method.");
}
?>