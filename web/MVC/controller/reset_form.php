<?php
require_once('config_session.php');

// Clear form data session
unset($_SESSION['form_data']);

// Redirect back to the form page
header("Location: ../views/sign.php");
exit;
