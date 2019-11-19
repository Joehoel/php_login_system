<?php
include "config/session.php";

$error = null;

$user = $_SESSION['user'];

if (isset($_POST['delete'])) {
    $get_delete_query = "DELETE FROM users WHERE username='$user'";
    mysqli_query($db, $get_delete_query);
    header('location: register.php');
};

if (isset($_POST['edit'])) {
    // Set variables
    $newUsername = $_POST['new-username'];
    $username = ucfirst(strtolower($_SESSION['login_user']));
    $password = $_POST['password'];
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number    = preg_match('@[0-9]@', $newPassword);
  
    // Escape input fields
    $fields = [$newUsername, $password, $newPassword, $confirmNewPassword];
    foreach ($fields as $field) {
        escapeString($db, $field);
    };
    // $newUsername = mysqli_real_escape_string($db, $newUsername);
    // $password = mysqli_real_escape_string($db, $password);
    // $newPassword = mysqli_real_escape_string($db, $newPassword);
    // $confirmNewPassword = mysqli_real_escape_string($db, $confirmNewPassword);

    // Hash password
    $password = md5($password);

    // MySQL
    $get_password_query = "SELECT password FROM users WHERE username='$username'";
    $currentPassword = query($db, $get_password_query, "password");

    // Check if users exists
    $user_check_query = "SELECT username FROM users WHERE username='$username'";
    $user_check = query($db, $user_check_query, "username");

    // Conditions
    if (empty($newUsername) || empty($password) || empty($newPassword) || empty($confirmNewPassword)) {
        $error = 'Please fill in all fields';
    } elseif ($currentPassword !== $password) {
        $error = "Password is incorrect";
    } elseif ($newPassword !== $confirmNewPassword) {
        $error = 'New passwords do not match';
    } elseif (!$uppercase || !$lowercase || !$number || strlen($newPassword) < 6) {
        $error = 'New password should be at least 6 characters in length and should include at least one upper case letter, one number.';
    } elseif ($user_check !== null && $username !== $user_check) {
        $error =  "Username already exists";
    } elseif ($currentPassword == $password && $newPassword == $confirmNewPassword && $uppercase && $lowercase && $number) {
        $error = null;
    };
    // When there is no error
    if (!$error) {
        $password = md5($newPassword);
        $sql1 = "UPDATE users SET password = '$password' WHERE username = '$username'";
        $sql2 = "UPDATE users SET username = '$newUsername' WHERE username = '$username'";
        mysqli_query($db, $sql1);
        mysqli_query($db, $sql2);
        $message = 'Profile updated';
        $_SESSION['newUsername'] = $newUsername;
    }
    // }
  // check();
}

include "views/profile.php";
?>
