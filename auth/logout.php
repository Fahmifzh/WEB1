<?php
include '../config.php';

// HAPUS SEMUA DATA SESSION
$_SESSION = [];

// HAPUS COOKIE SESSION PHP
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}

// HANCURKAN SESSION
session_destroy();

// REDIRECT KE HOME
header("Location: ../index.php");
exit;
