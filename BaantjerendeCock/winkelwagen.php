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
    <div class="content">
      <span id="title" class="title">
        Dit zit er in je winkelwagen:
      </span>
      <div id="productField" class="shoppingcart-page">

        <?php
          require 'data.php';
          $cookie_items = json_decode($_COOKIE['baantjer_ws_cart']);
          $cookie = json_encode($cookie_items);
            error_reporting(0);
          // print_r($cookie);

          if ($cookie <= 0) {
            echo("De winkelwagen is leeg");
            die;
          };

          $sql = "SELECT `product`.* FROM `product` WHERE `product`.`id` IN ";
          
          /**
           * $id_range is een string waarin we alle ID's van de producten in de winkelwagen
           * plaatsen. De format van deze string is: ( .., .., .. ) Dus met haakjes er om heen.
           * Deze string voegen we dan toe aan de SQL-statement.
           */
          $id_range = "(";    // In SQL moet een range beginnen met een ( dus initiëren we de variabele hiermee
          /**
           * $item_count    Hulpvariabele, want we moeten weten hoeveel items er in de winkelwagen zitten
           * $current_item  Hulpvariabele, dit is een teller die we steeds met 1 verhogen in de lus. Hiermee
           *                controleren we of we bij de laatste item zijn want dan moet er geen komma meer achter in de string
           *                hierboven.
           */
          $item_count = count($cookie_items);
          $current_item = 1;

          /**
           * In de onderstaande lus lopen we langs alle items in de winkelwagen
           * De ID's van ieder item hierin voegen we dus toe aan de string $id_range
           * Na iedere ID in deze string plaatsen we een komma, behalve bij de laatste
           */
          foreach($cookie_items as $item) {
            // Hebben we de laatste item bereikt?
            if($current_item < $item_count) {
              // Nee, dan nog wel een komma na de ID
              $id_range .= "{$item->id}, ";
            } else {
              // Ja, dus nu geen komma achter de ID
              $id_range .= "{$item->id}";
            }

            // Na iedere loop in de deze lus moeten we de onderstaande teller wel met 1 verhogen
            $current_item++;
          }
          // Nu sluiten we de range string af met een sluithaakje, want dat moet in SQL
          $id_range .= ")";

          // We plakken de nu samengestelde range string aan de SQL-string vast en krijgen dan b.v.:
          // SELECT `product`.* FROM `product` WHERE `product`.`id` IN ( 1, 3, 6 )
          $sql .= $id_range;

          $dbStatement = $dbConnection->prepare($sql);
          $dbStatement->execute();
          $products = $dbStatement->fetchAll(PDO::FETCH_ASSOC);

        ?>


        <?php foreach($products as $item): ?>
        <div class="shoppingcart-field">
          <div class="shoppingcart-item">
            <div class="shoppingcart-info">
              <p>Title: <?= $item['Title'] ?></p>
              <div class="shoppingcart-subinfo">
                Price: <?= $item['Price'] ?>
                Status: <?= $item['Status'] ?>
                Type:  <?= $item['Type'] ?>
              </div>
            </div>
            <img class="shoppingcart-img" src="<?= $item['IMGpath'] ?>">
            <!-- dit is het vak waar het product in staat -->
          </div>
          <div class="buttons">
              <button class="button-shoppingcart" aria-label="remove-amount" data-product_id="<?= $item['id'] ?>">verwijderen</button>
              <button class="button-shoppingcart" aria-label="increase-amount" data-product_id="<?= $item['id'] ?>"> + </button>
              <span aria-label="product-amount<?= $item['id'] ?>">Aantal: </span>
              <button class="button-shoppingcart" aria-label="decrease-amount" data-product_id="<?= $item['id'] ?>"> - </button>
            </div>
          <?php endforeach; ?>
      

          <div class="footer">
            <!-- dit is er voor ruimte tussen de cellen en de onderkant van het scherm, dit wou niet lukken met een padding/margin:( -->
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="js/main.js"></script>
  <script src="js/product.js"></script>
</body>
</html>