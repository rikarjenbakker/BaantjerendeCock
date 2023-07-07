<?php
session_start();

$page_title = 'Aanmelden';

@require_once('src/helpers/nav-helpers.php');
@require_once('src/helpers/auth-helpers.php');
@require_once('src/templates/bovenstukhtml.php');
?>

   <form method="POST" action="src/formhandlers/login.php">
      <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
      </div>
      <div>
            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password" />
      </div>
      <button type="submit">Inloggen</button>
   </form>
   
<?php
@require_once('src/templates/onderstukhtml.php');