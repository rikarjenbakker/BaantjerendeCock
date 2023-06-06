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
  </div>
  <div>
    <div class="header">
      <span>
        Eén plek voor alle boeken van of over Baantjer
      </span>
    </div>
    <div class="content">
      <span id="title" class="title">
        Dit zijn alle inkoop boeken:
      </span>
      <div id="productField" class="product-field">

        <?php
          require 'data.php';
          $inhoud = "SELECT * FROM `product` WHERE Type='Paperback Inkoop'; ORDER BY Price ASC";
          $dbStatement = $dbConnection->prepare($inhoud);
          $dbStatement->execute();
          $products = $dbStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- hier komt de php code met alle producten -->
        <?php foreach($products as $product): ?>
  	        <!-- <a onclick="productPage(<?= $product['ID']?>)" href="product.php" class="product-cell"> -->
            <a id="product" href="product.php?product_id=<?= $product['id'] ?>" class="product-cell">
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