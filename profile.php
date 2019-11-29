<?php
include "config/session.php";

if (!isset($_SESSION['username'])) {
  header("location: index.php");
  exit();
} else {

  // Set username variable for readability
  $username = $_SESSION['username'];

  // When delete account button is pressed
  if (isset($_POST['delete'])) {
    $delete_account_query = "DELETE FROM users WHERE username='$username'";
    delete($db, $delete_account_query);
    header('location: register.php');
  };

  if (isset($_POST['edit'])) {
    $text = edit($db, $_POST['new-username'], $_POST['password'], $_POST['new-password'], $_POST['confirm_new_password']);

    // Get error or message
    if ($text[1] == true) {
      $error = $text[0];
    } elseif ($text[1] == false) {
      $message = $text[0];
    }

    // Close database
    mysqli_close($db);
  }
}

// Include profile page markup
include "views/profile.php";
