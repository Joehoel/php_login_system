<?php
include "config/session.php";

$user = $_SESSION['user'];
$get_timestamp_query = "SELECT * FROM users WHERE username='$user'";
$timestamp = query($db, $get_timestamp_query, "timestamp");

include "views/welcome.php";
?>