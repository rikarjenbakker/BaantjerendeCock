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
  <div class="menu-left">
    <a href="index.php">
      <img class="img-menu-left" src="img/Baantjer_en_de_cock.png" alt="logo">
    </a>
    <div class="menu-options">
      <a class="menu-item" href="index.php">
        <div> 
          Alle Boeken
        </div>
      </a>
      <a class="menu-item" href="paperback.php">
        <div>
          Paperback
        </div>
      </a>
      <a class="menu-item" href="omnibus.php">
        <div>
          Omnibus
        </div>
      </a>
      <a class="menu-item" href="inkoop.php">
        <div>
          Inkoop
        </div>
      </a>
      <a class="menu-item" href="winkelwagen.php">
        <div>
          Winkelwagen
        </div>
      </a>
    </div>
    <div class="credit">
      <div class="credit-text">
        Created by 
        <a href="https://rikarjenbakker.nl/" target="_blank">
          Rik Arjen Bakker
        </a>
      </div>
    </div>
  </div>
  <div>
    <div class="header">
      <span>
        Eén plek voor alle boeken van of over Baantjer
      </span>
    </div>
    <div class="content">
      <span id="title" class="title">
        Dit zijn alle boeken:
      </span>
      <div id="productField" class="product-field">

        <?php
          require 'data.php';
          $inhoud = "SELECT * FROM `product` ORDER BY Price ASC";
          $dbStatement = $dbConnection->prepare($inhoud);
          $dbStatement->execute();
          $products = $dbStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- hier komt de php code met alle producten -->
        <?php foreach($products as $product): ?>
  	        <a onclick="productPage(<?= $product['ID']?>)" href="product.php" class="product-cell">
              <p class="product-title">
                <?= $product['Title'] ?>
              </p>
              <img class="img" src="<?= $product['IMGpath'] ?>" alt="Foto_product">
              <span class="product-info">
                <?= $product['Status'] ?>/&euro; <?= $product['Price'] ?>
              </span>
            </a>

        <?php endforeach; ?>

          <div class="footer">
            <!-- dit is er voor ruimte tussen de cellen en de onderkant van het scherm, dit wou niet lukken met een padding/margin:( -->
          </div>

      </div>
    </div>
  </div>
  <script src="js/main.js"></script>
</body>
</html>