<?php
  require 'data.php';

  if(!isset($_GET['product_id'])) {
    header('location: index.php');
    exit(0);
  }

  $product_id = intval($_GET['product_id']);

  $sql = "SELECT * FROM `product` WHERE `id`=:product_id";  // De SQL-statement die door de database server moet worden uitgevoerd
  $placeholders = [                                         // Hiermee vertellen we dat de placeholder in de SQL-statement moet
    ':product_id' => $product_id                            // worden vervangen (na beveiliging) door de inhoud van $product_id
  ];                                                        
  $dbStatement = $dbConnection->prepare($sql);              // Bereid de SQL-statement voor op de database server
  $dbStatement->execute($placeholders);                     // Voer de SQL-statement op de database server uit
  $product = $dbStatement->fetch(PDO::FETCH_ASSOC);         // Haal de gevonden data binnen vanuit de database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  
  <link rel="icon" type="image/x-icon" href="img\Baantjer_en_de_cockfavicon.png">
  
  <title>Baantjer en de Cock</title>

  <link rel="stylesheet" href="css/style.css" >
</head>
<body>
  <?php include 'menu.php' ?>
  <div>
    <div class="header">
      <span>
        Eén plek voor alle boeken van of over Baantjer
      </span>
    </div>
    <div class="content-product-page">
      <?php if(!empty($product) and $product['id'] != 11 and $product['id'] != 12): ?>
      </span>
      <div id="productField" class="">
        <div class="product-page" id="product">
          <div class="image-product-page-parant">
            <img class="image-product-page" src="<?= $product['IMGpath'] ?>" alt="plaatje">
          </div>
          <div class="product-page-info">
            <p>
              <?= $product['Title'] ?>
            </p>
            <div class="product-page-info-summary">
            Dit is een <?= $product['Type'] ?> De Cock boek die in '<?= $product['Status'] ?>' staat is. <br><br>In dit boek: <br> <?= $product['Inhoud'] ?>
            </div>
            <div class="product-page-info-status-price">
              Status: <?= $product['Status'] ?><br>
              Prijs: &euro; <?= $product['Price'] ?><br>
              
              <button class="button-product-page" id='add-to-cart' data-product_id='<?= $product['id'] ?>'>Voeg toe</button>
            </div>
            <div class="product-page-info-summary-bottom">
              
            </div>
          </div>
        </div>

        <div class="footer">
        </div>
      </div>
      <?php elseif($product['id'] == 11 or $product['id'] == 12): ?>
      <div id="productField" class="">
        <div class="product-page" id="product">
          <div class="image-product-page-parant">
            <img class="image-product-page" src="<?= $product['IMGpath'] ?>" alt="plaatje">
          </div>
          <div class="product-page-info">
            <p>
              <?= $product['Title'] ?>
            </p>
            <div class="product-page-info-summary">
              Ik ben op zoek naar dit boek dat in een <?= $product['Status'] ?> staat is, en dit type is: '<?= $product['Type'] ?>'. 
            </div>
            <div class="product-page-info-status-price">
              Status: <?= $product['Status'] ?><br>
              Wat ik er voor over heb: &euro; <?= $product['Price'] ?><br>
              
              Contact opnemen kan via mijn E-mail;
              <a class="linkjehehehe" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">
                echtgeenneppeemail@gmail.com
              </a>
            </div>
            <div class="product-page-info-summary-bottom">
              
            </div>
          </div>
        </div>

        <div class="footer">
        </div>
      </div>
      <?php else: ?>
        <span id="title" class="title">
          Product Niet Gevonden
        </span>
      <?php endif; ?>
    </div>
  </div>

  <script src="js/main.js"></script>
  <script src="js/product.js"></script>
</body>
</html>