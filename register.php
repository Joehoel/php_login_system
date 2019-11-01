<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-hVpXlpdRmJ+uXGwD5W6HZMnR9ENcKVRn855pPbuI/mwPIEKAuKgTKgGksVGmlAvt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>Register</title>
</head>

<body>

    <?php
    include "config.php";

    session_start();

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

        $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {
                $error =  "Username already exists";
            }
        }

        if (!$error) {
            // Capitalize first letter of username
            $username = ucfirst($username);

            // Encrypt the password
            $password = md5($password);

            // Saving in the database
            $query = "INSERT INTO users (username, password) 
            VALUES('$username', '$password')";
            mysqli_query($db, $query);
            $_SESSION['login_user'] = $username;
            header('location: welcome.php');
        }
    }
    mysqli_close($db);

    ?>
    <div class="container" style="width: 500px; margin-top: 17rem;">
        <div class="wrapper">
            <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php } ?>
            <form
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="username" value="<?php if (isset($_POST['username'])) {
        echo $_POST['username'];
    } ?>" class="form-control" placeholder="Username" type="text" autocomplete="off">
                    <span class="help-block"></span>
                </div> <!-- form-group// -->
                <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" type="password" name="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Confirm password" type="password" name="confirm_password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="reg_user"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="index.php">Log In</a> </p>
            </form>
        </div>
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
