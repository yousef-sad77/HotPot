<?php
require_once("./MVC/controller/signup.php");

verify_session_user( $_SESSION['username'], $_SESSION['email']);

?>