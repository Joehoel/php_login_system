<?php
include "config/session.php";

// Initializing variables
$error = null;

// Register
if (isset($_POST['reg_user'])) {
    $username = check($db, $_POST['username']);
    $password = check($db, $_POST['password']);
    $confirm_password = check($db, $_POST['confirm_password']);

    $error = error($db, $username, $password, $confirm_password);

    if (!$error) {
        register($db, $username, $password);
    }
}

// Close database
mysqli_close($db);

// Include register markup
include "views/register.php";
