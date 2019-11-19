<?php
include "config/session.php";

session_start();

$error = null;
$_SESSION['login_user'] = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $password = md5($password);

    $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // $active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['username'];
        $_SESSION['login_user'] = $username;

        header("location: welcome.php");
    } else {
        $error = "Your username or password is invalid";
    }
}

include "views/index.php";
?>
