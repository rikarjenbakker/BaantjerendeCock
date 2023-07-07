<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HowToDo - Log in</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="other/1.3.0/css/line-awesome.min.css">
</head>
<body>
  <?php include 'includes/menu.php'; ?>
  <div class="login-card">
    <div class="login-card__img">
    <i class="las la-user"></i>
    </div>
    <form class="login-card__text" method="POST" action="includes/login.php">

      <input id="Email" type="text" name="email" class="login-card__text--email">
      <label for="Email">E-mail</label>

      <input id="Password" name="password" type="password" class="login-card__text--password">
      <label for="Password">Password</label>

      <div class="login-card__text-button__div">
        <button type="submit" name="action" class="login-card__text-button__button">
          Log In
        </button>
      </div>
    </form>
  </div>
  <script src="js/main.js"></script>
</body>
</html>
