<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HowToDo - Registration</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="other/1.3.0/css/line-awesome.min.css">
</head>
<body>
  <?php include 'includes/menu.php'; ?>
  <div class="registration-card">
    <div id="profilePicture" class="registration-card__img">
    <i class="las la-user"></i>
    <div class="registration-card__img__text">
      Click to add a profile picture.
    </div>
    </div>
    <form class="registration-card__info" method="POST" action="includes/register.php">
      <input id="Email" class="registration-card__info--email" name="email" type="text">
      <label for="Email">E-mail</label>
      <input id="username" name="username" type="text" class="registration-card__info--username">
      <label for="Username">Username</label>
      <input id="Password" name="password" type="password" class="registration-card__info--password"> 
      <label for="Password">Password</label> 
      <div class="registration-card__info--button-div">
        <button class="registration-card__info--button-div__button" type="submit" name="action">
          Register
        </button>
      </div>
    </form>
  </div>
  <script src="js/main.js"></script>
</body>
</html>