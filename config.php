<?php
// MATIKAN ERROR DI PRODUCTION
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// SESSION SECURITY
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');
// ini_set('session.cookie_secure', 1); // aktifkan kalau HTTPS

session_start();

// KONEKSI DATABASE
$conn = mysqli_connect("localhost","root","","sweetsip_studio");
if(!$conn){
    die("Koneksi gagal");
}

// BASE URL
define('BASE_URL', '/sweetsip-studio/');

// CEGAH SESSION HIJACK
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// SESSION TIMEOUT (30 MENIT)
if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
