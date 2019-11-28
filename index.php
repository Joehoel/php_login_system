<?php
include "config/session.php";

$error = null;
if (isset($_POST['login'])) {
    $error = login($db, $_POST['username'], $_POST['password']);
}

include "views/index.php";
