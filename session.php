<?php
// (This file not line 3) included in every file to check if user is logged in, otherwise redirect to index.php
include 'config.php';

session_start();

$user_check = $_SESSION['login_user'];

$result = mysqli_query($db, "SELECT username FROM users WHERE username = '$user_check' ");

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$login_session = $row['username'];
$_SESSION['user'] = $row['username'];
if (isset($_SESSION['newUsername'])) {
    $_SESSION['user'] = $_SESSION['newUsername'];
}
if (!isset($_SESSION['login_user'])) {
    header("location: index.php");
    die();
}
