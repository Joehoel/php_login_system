<?php
include "config/session.php";

if (!isset($_SESSION['username'])) {
  header("location: index.php");
  exit();
} else {
    $username = $_SESSION['username'];
    $get_timestamp_query = "SELECT * FROM users WHERE username='$username'";
    $timestamp = query($db, $get_timestamp_query, "timestamp");
  
    include "views/welcome.php";
}
