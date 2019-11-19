<?php
session_start();
// (This file not line 3) included in every file to check if user is logged in, otherwise redirect to index.php
include 'config.php';
include "functions/database.php";
include "functions/logout.php";

// $user_check = $_SESSION['login_user'];

// $user_check_query = "SELECT username FROM users WHERE username='$user_check'";
// $result = mysqli_query($db, $user_check_query);

// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// $login_session = $row['username'];
// $_SESSION['user'] = $row['username'];
// if (isset($_SESSION['newUsername'])) {
//     $_SESSION['user'] = $_SESSION['newUsername'];
// }
// header("location: ./welcome.php");
// die();
// header("location: index.php");
// die();
if (!isset($_SESSION['username'])) {
    // session_destroy();
}
