<?php
include "config/session.php";

// Register
if (isset($_POST['reg_user'])) {
    // Escape strings
    $username = escape($db, $_POST['username']);
    $password = escape($db, $_POST['password']);
    $confirm_password = escape($db, $_POST['confirm_password']);

    // If error then the function returns error otherwise, register
    $error = register($db, $username, $password, $confirm_password);

    // Close database
    mysqli_close($db);
}

// Include register page markup
include "views/register.php";
