<?php
include "config/session.php";



$error = null;
if (isset($_POST['login'])) {
    // username and password sent from form

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $password = md5($password);

    $get_existance_query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = query($db, $get_existance_query, "id");

    if ($result) {
        $_SESSION['username'] = $username;
        header("location: welcome.php");
    } else {
        $error = "Your username or password is invalid";
    }
}
include "views/index.php";
?>
