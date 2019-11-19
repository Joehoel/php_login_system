<?php
session_start();
include 'config.php';
include "functions/database.php";
include "functions/global.php";

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: ../index.php");
    exit();
}
