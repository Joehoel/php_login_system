<?php
function edit($db, $newUsername, $password, $newPassword, $confirmNewPassword)
{
  // Set username variable for readability
  $username = $_SESSION['username'];

  // Escape input fields
  $newUsername = escape($db, $newUsername);
  $password = escape($db, $password);
  $newPassword = escape($db, $newPassword);
  $confirmNewPassword = escape($db, $confirmNewPassword);

  // Password conditions    
  $uppercase = preg_match('@[A-Z]@', $newPassword);
  $lowercase = preg_match('@[a-z]@', $newPassword);
  $number    = preg_match('@[0-9]@', $newPassword);

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
    return ['Please fill in all fields', true];
  } elseif ($currentPassword !== $password) {
    return ["Password is incorrect", true];
  } elseif ($newPassword !== $confirmNewPassword) {
    return ['New passwords do not match', true];
  } elseif (!$uppercase || !$lowercase || !$number || strlen($newPassword) < 6) {
    return ['New password should be at least 6 characters in length and should include at least one upper case letter, one number.', true];
  } elseif ($user_check !== null && strtolower($username) !== strtolower($user_check)) {
    return ["Username already exists", true];
  } elseif ($currentPassword == $password && $newPassword == $confirmNewPassword && $uppercase && $lowercase && $number) {
    // Hash password
    $password = md5($newPassword);

    // Update query's
    $update_username_query = "UPDATE users SET username = '$newUsername' WHERE username = '$username'";
    $update_password_query = "UPDATE users SET password = '$password' WHERE username = '$username'";

    // Update fields in database
    update($db, $update_username_query);
    update($db, $update_password_query);

    // Success message
    return ['Profile updated', false];

    // Update session username value
    $_SESSION['username'] = $newUsername;
  }
}
