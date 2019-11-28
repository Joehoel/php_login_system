<?php
include "config/session.php";

if (!isset($_SESSION['username'])) {
  header("location: index.php");
  exit();
} else {
  // Initialize error variable
  $error = null;

  // Set username variable for readability
  $username = $_SESSION['username'];

  // When delete account button is pressed
  if (isset($_POST['delete'])) {
    $delete_account_query = "DELETE FROM users WHERE username='$username'";
    delete($db, $delete_account_query);
    header('location: register.php');
  };

  if (isset($_POST['edit'])) {
    // Set variables
    $newUsername = $_POST['new-username'];
    $password = $_POST['password'];
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];

    // Password conditions
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number    = preg_match('@[0-9]@', $newPassword);

    // Escape input fields
    $fields = [$newUsername, $password, $newPassword, $confirmNewPassword];
    foreach ($fields as $field) {
      escapeString($db, $field);
    };

    // Hash password
    $password = md5($password);

    // MySQL
    $get_password_query = "SELECT password FROM users WHERE username='$username'";
    $currentPassword = query($db, $get_password_query, "password");

    // Check if users exists
    $user_check_query = "SELECT username FROM users WHERE username='$newUsername'";
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
    } elseif ($user_check !== null && strtolower($username) !== strtolower($user_check)) {
      $error =  "Username already exists";
    } elseif ($currentPassword == $password && $newPassword == $confirmNewPassword && $uppercase && $lowercase && $number) {
      $error = null;
    };

    // When there is no error
    if (!$error) {
      // Hash password
      $password = md5($newPassword);

      // Query's
      $update_username_query = "UPDATE users SET username = '$newUsername' WHERE username = '$username'";
      $update_password_query = "UPDATE users SET password = '$password' WHERE username = '$username'";

      // Update fields in database
      update($db, $update_username_query);
      update($db, $update_password_query);

      // Success message
      $message = 'Profile updated';

      // Update session username value
      $_SESSION['username'] = $newUsername;
    }
  }

  // Include profile page markup
  include "views/profile.php";
}
