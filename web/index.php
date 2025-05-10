<?php
require_once("./MVC/controller/config_session.php");

$page = $_GET['page'] ?? 'home'; // default to dashboard

$allowed_pages = ['home', 'cart', 'profile']; // whitelist

if (!in_array($page, $allowed_pages)) {
    $page = 'home'; // fallback
}
if (isset($_SESSION['admin_id'])) {
    $page = 'dashboard';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./static/css/master.css" />
    <link rel="stylesheet" href="./static/css/nav.css" />
    <link rel="stylesheet" href="./static/css/card.css" />
    <link rel="stylesheet" href="./static/css/footer.css" />
    <link rel="stylesheet" href="./static/css/dashboard.css" />
    <script defer src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="./static/js/nav.js"></script>
    <script defer src="./static/js/main.js"></script>
    <script defer src="./static/js/debug.js"></script>
    <script defer src="./static/js/dashboard.js"></script>
    <title>hotpot</title>


</head>

<body data-signed-in="<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>">

    
    <?php require_once("./MVC/views/common/nav.php"); ?>

    <?php require_once("./MVC/views/$page.php"); ?>

    <?php require_once("./MVC/views/common/footer.php"); ?>

</body>

</html>
