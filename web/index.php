<?php
$your_path = "E:/1000_programer/HotPot"; // change this to your path;
$_SERVER['DOCUMENT_ROOT'] = "$your_path/web"; // to ensure path sync (your root path should end with web)

require_once("./MVC/controller/config_session.php");

$page = $_GET['page'] ?? 'home'; // default to home

$allowed_pages = ['home', 'cart', 'product', 'dashboard']; // whitelist

if (!in_array($page, $allowed_pages)) {
    $page = 'home'; // fallback
}

if ($page === 'dashboard' && !isset($_SESSION['admin_id'])) {
    header("Location: index.php?page=home");
    exit;
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