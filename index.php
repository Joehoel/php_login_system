<?php
// Includes
include "config/session.php";

// Initialize error variable
$error = null;

// When login for is submitted
if (isset($_POST['login'])) {
    $error = login($db, $_POST['username'], $_POST['password']);
}

// Include login page markup
include "views/index.php";
