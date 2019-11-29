<?php
function register($db, $username, $password, $confirm_password)
{
    // Password conditions
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    // Check if username does not already exists in database
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $user = query($db, $user_check_query, "username");

    if ($user) {
        if ($user === $username) {
            return $error =  "Username already exists";
        }
    } elseif (empty($username)) {
        return $error = "Username is required";
    } elseif (empty($password)) {
        return $error = "Password is required";
    } elseif ($password != $confirm_password) {
        return $error =  "The two passwords do not match";
    } elseif (!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
        return $error = 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
        // Encrypt the password
        $password = md5($password);

        // Saving in the database
        $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";
        insert($db, $query);

        // Save username in session and redirect
        $_SESSION['username'] = $username;
        header('location: welcome.php');
        return $error = null;
    }
}
