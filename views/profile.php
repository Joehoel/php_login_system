<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
  <link rel="icon" href="./assets/favicon.ico" type="image/x-icon">
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css" rel="stylesheet" integrity="sha384-hVpXlpdRmJ+uXGwD5W6HZMnR9ENcKVRn855pPbuI/mwPIEKAuKgTKgGksVGmlAvt" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

  <title>Profile</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./welcome.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form action="./config/session.php" method="post">
        <button class="btn btn-outline-secondary my-2 my-sm-0" style="width: auto" type="submit" name="logout">Sign
          Out</button>
      </form>
    </div>
  </nav>
  <main>
    <div class="container" style="width: 500px;">
      <div class="wrapper m-4">
        <?php if (isset($error)) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
        <?php if (isset($message)) : ?>
          <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
          </div>
        <?php endif; ?>
        <h2 class="my-4">Edit Profile</h2>
        <form action="profile.php" method="post">
          <div class="form-group">
            <label for="new-username">New Username</label>
            <input autocomplete="off" class="form-control" type="text" name="new-username" value="<?php echo $_SESSION['username'] ?>">
          </div>
          <div class="form-group">
            <label for="password">Current Password</label>
            <input autocomplete="off" class="form-control" type="password" name="password">
          </div>
          <div class="form-group">
            <label for="new-password">New Password</label>
            <input autocomplete="off" class="form-control" type="password" name="new-password">
          </div>
          <div class="form-group">
            <label for="confirm-new-password">Confirm New Password</label>
            <input autocomplete="off" class="form-control" type="password" name="confirm-new-password">
          </div>
          <input class="btn btn-success" type="submit" value="Confirm" name="edit">
          <input type="submit" class="btn btn-danger" name="delete" value="Delete account">
        </form>
      </div>
    </div>
  </main>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>
