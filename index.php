<?php
// Includes
include "config/session.php";

// When login for is submitted
if (isset($_POST['login'])) {
    $error = login($db, $_POST['username'], $_POST['password']);

    // Close database
    mysqli_close($db);
}

// Include login page markup
include "views/index.php";
