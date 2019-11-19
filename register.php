<?php
// TODO: change to session.php and fix variables so that there is no conflict
include "config/session.php";

// Initializing variables
$username = '';
$error = null;

// Register
if (isset($_POST['reg_user'])) {
    $_POST['username'] = htmlspecialchars($_POST['username']);
    $_POST['password'] = htmlspecialchars($_POST['password']);
    $_POST['confirm_password'] = htmlspecialchars($_POST['confirm_password']);

    // Receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    // Password conditions
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    // Input checks
    if (empty($username)) {
        $error = "Username is required";
    } elseif (empty($password)) {
        $error = "Password is required";
    } elseif ($password != $confirm_password) {
        $error =  "The two passwords do not match";
    } elseif (!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
        $error = 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
    }

    // Check if username doesnt already exists in database
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $user = query($db, $user_check_query, "username");

    if ($user) {
        if ($user === $username) {
            $error =  "Username already exists";
        }
    }

    if (!$error) {
        // Encrypt the password
        $password = md5($password);

        // Saving in the database
        $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";
        insert($db, $query);

        // Save username in session and redirect
        $_SESSION['username'] = $username;
        header('location: welcome.php');
    }
}

// Close database
mysqli_close($db);

// Include register markup
include "views/register.php";
