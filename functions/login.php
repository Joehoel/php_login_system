<?php
function login($db, $username, $password) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $password = md5($password);

    $get_existence_query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = query($db, $get_existence_query, "id");

    if ($result) {
        $_SESSION['username'] = $username;
        header("location: welcome.php");
        exit();
    } else {
        return $error = "Your username or password is invalid";
    }
}