<?php
// config_session.php

// Set custom session settings (optional)
$server_clint_life_time = 60/*min*/ * 60/*second*/ /* = 3600second = 1hour*/ ;
// session_name('my_custom_session');
// ini_set('session.gc_maxlifetime', $server_clint_life_time);
// ini_set("session.use_only_cookies", 1);
// ini_set("session.use_strict_mode", 1);
// session_set_cookie_params([
//     'lifetime' => $server_clint_life_time,
//     // Set your domain if needed
//     'path' => '/',
//     'secure' => true,  // Set true if using HTTPS
//     'httponly' => true,
//     'samesite' => 'Lax' // Can also be 'Strict' or 'None'
// ]);
$is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;

session_set_cookie_params([
    'lifetime' => $server_clint_life_time,
    'path' => '/',
    'secure' => $is_https,
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Start the session
session_start();

if (!isset($_SESSION['last_regeneration'])) {
    regenerate_session_id();
} else {
    if (time() - $_SESSION['last_regeneration'] >= $server_clint_life_time) {
        regenerate_session_id();
    }
}

function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
?>