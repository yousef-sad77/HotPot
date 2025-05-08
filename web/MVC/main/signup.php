<?php
require_once 'config_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $password = trim($_POST['password']) ?? '';
    // confirm password

    try {

        require_once '../module/signup.php';
        require_once '../controller/signup.php';

    } catch (\Throwable $e) {
        die("Query failed:" . $e->getMessage());
    }

    if (any_error()) {
        
    }
    if (!any_error()) {
        echo "<h3 style='color:green ;'>Form Submition Successfuly</h3>";

        $_SESSION['form_data']["username"]["data"] = $username;
        $_SESSION['form_data']["email"]["data"] = $email;
        $_SESSION['form_data']["password"]["data"] = $password;
        header('Location: success.php');
        exit();
    }
    //todo
    $_SESSION['form_data'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!";
        // Optionally auto-login:
        // $_SESSION['user_id'] = $stmt->insert_id;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("location: ../index.php");
    die("Invalid request method.");
}
?>