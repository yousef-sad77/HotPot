<?php
session_start();

// Remove user-related session variables
unset($_SESSION['user_id']);
unset($_SESSION['username']);

// Optional: destroy all session data
session_destroy();

// Redirect to sign-in or homepage
header("Location: ../../index.php");
exit();
