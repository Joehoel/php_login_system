<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "usbw";
$db_name = "users";

$link = mysqli_connect($db_server, $db_user, $db_password, $db_name);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>