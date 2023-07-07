<!DOCTYPE html>
<html lang="nl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title><?= $page_title ?> | Webshop Het Gewitte Kippetje</title>

   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" /> -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <nav>
      <section class="nav-branding">
         <a href="index.php">
            <img src="img/logo4.png" alt="Webshop" />
            <h1>Witte Kip</h1>
         </a>
      </section>
      <section class="nav-items">
         <a href="index.php" class="<?= isActiveNavItem('index') ? 'nav-items__active' : '' ?>"><i class="las la-home"></i><span class="nav-item__text">Home</span></a>

         <?php if(! isLoggedIn()): ?>
            <a href="login.php" class="<?= isActiveNavItem('login') ? 'nav-items__active' : '' ?>"><i class="las la-sign-in-alt"></i><span class="nav-item__text">Aanmelden</span></a>
            <a href="register.php" class="<?= isActiveNavItem('register') ? 'nav-items__active' : '' ?>"><i class="lar la-id-card"></i><span class="nav-item__text">Registreren</span></a>
         <?php else: ?>
            <a href="src/auth/logout.php" class="<?= isActiveNavItem('logout') ? 'nav-items__active' : '' ?>"><i class="las la-sign-out-alt"></i><span class="nav-item__text">Afmelden</span></a>
         <?php endif; ?>
         
         <a href="shoppingcart.php" class="<?= isActiveNavItem('cart') ? 'nav-items__active' : '' ?>">
            
            <i class="las la-shopping-cart">
               <!-- De CSS-class staat er nu in, maar moet uiteindelijk alleen gebruikt worden als er 
                     items in de winkelwagen zitten. -->
               <span id="shoppingcart-icon" class="has-cart-items"></span>
            </i>

            <span class="nav-item__text">Winkelwagen</span>
         </a>
      </section>
   </nav>

    <main>