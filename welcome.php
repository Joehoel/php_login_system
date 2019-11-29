<?php
include "config/session.php";

if (!isset($_SESSION['username'])) {
  header("location: index.php");
  exit();
} else {
  $username = $_SESSION['username'];

  // Get timestamp
  $get_timestamp_query = "SELECT * FROM users WHERE username='$username'";
  $timestamp = query($db, $get_timestamp_query, "timestamp");

  // Close database
  mysqli_close($db);

  // Include welcome page markup
  include "views/welcome.php";
}
