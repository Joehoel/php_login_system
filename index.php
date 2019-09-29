<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <title>Login</title>
</head>

<body>
  <?php
  include "config.php";
  session_start();
  $error = null;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
    
      $myusername = mysqli_real_escape_string($db, $_POST['username']);
      $mypassword = mysqli_real_escape_string($db, $_POST['password']);

      $mypassword = md5($mypassword);
    
      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // $active = $row['active'];
    
      $count = mysqli_num_rows($result);
    
      // If result matched $myusername and $mypassword, table row must be 1 row
  
      if ($count == 1) {
          $_SESSION['username'];
          $_SESSION['login_user'] = $myusername;
       
          header("location: welcome.php");
      } else {
          $error = "Your Login Name or Password is invalid";
      }
  }
    ?>
  <div class="container mt-4 " style="width: 20vw;">
    <?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php  echo $error; ?>
    </div>
    <?php } ?>
    <form method="post">
      <!-- form-group// -->
      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fas fa-user"></i> </span>
        </div>
        <input value="<?php if (isset($_POST['username'])) {
        echo $_POST['username'];
    } ?>" name="username" class="form-control" placeholder="Username" type="text" autocomplete="off">
      </div>
      <!-- form-group// -->
      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input value="<?php $password;?>" class="form-control" placeholder="Password" type="password" name="password"
          autocomplete="off">
      </div> <!-- form-group// -->
      <!-- form-group// -->
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login </button>
      </div> <!-- form-group// -->
      <p class="text-center">Dont have an account? <a href="register.php">Register</a> </p>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>