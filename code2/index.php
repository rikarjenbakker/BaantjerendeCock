<?php
session_start();

$page_title = 'Home';

@require_once('src/helpers/nav-helpers.php');
@require_once('src/helpers/auth-helpers.php');
@require_once('src/templates/bovenstukhtml.php');

// Globale variabelen nodig om een connectie te maken
// met de databaseserver
$dbHost = '127.0.0.1';
$dbName = 'wittekip';
$dbUser = 'root';
$dbPassword = 'root';

// Globale variabelen om te kunnen werken met de database
// via PDO
$dbConnection = null; 
$dbStatement = null;

// Connectie met de database server maken
try {
   $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
} catch(PDOException $error) {
   // Connectie maken is mislukt, dus laten we de gebruiker terugkeren naar de startpagina
   header('location: ../../index.php');
   exit();
}

// Connectie is gelukt.
// We gaan nu de SQL-statement voor deze pagina samenstellen   
$sql = "SELECT * FROM `products`";     // SQL-statement om alle producten binnen te halen
$placeholders = [];                    // Lege array, want we gebruiken geen placeholders
                                       // in de SQL-statement

// Vragen de database server de SQL-statement voor te bereiden
$dbStatement = $dbConnection->prepare($sql);  
// We laten de SQL-statement nu door de database server uitvoeren  
$dbStatement->execute($placeholders);

// Als alles goed gegaan is dan staat er data op ons te wachten op de database server
// Die gaan we nu binnenhalen
$products = $dbStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="shop-container">

   <!-- Met de PHP-statement foreach gaan we nu voor ieder product de onderstaande HTML-code herhalen -->
   <?php foreach($products as $product): ?>
   <div class="product-card">
      <!-- We injecteren hier de titel van het product -->
      <h1 class="product-title"><?= $product['title'] ?></h1>
      <!-- We injecteren hier de link naar de bijbehorende image in de img-map -->
      <img src="<?= $product['image'] ?>" class="product-image" alt="" />
      <div class="product-description">
         <!-- We injecteren hier nu de beschrijving van het product -->
         <?= $product['description'] ?>
      </div>
      <section>
         <!-- De button stelt de gebruiker in staat het product toe te voegen aan de winkelwagen
         Met data- voegen we een 'variabele' toe aan het element (button)
         Deze kunnen we in JavaScript dan lezen en gebruiken -->
         <button class="product-buy-btn" data-product_id="<?= $product['id'] ?>">
                  <i class="las la-cart-arrow-down"></i> Kopen
         </button>

         <div class="product-price">
            <!-- We injecteren hier de prijs van het product -->
            &euro; <?= $product['price'] ?>
         </div>
      </section>
   </div>
   <!-- Einde van de foreach-lus, alle code tussen foreach en endforeach zit in deze lus -->
   <?php endforeach; ?>
</div>

<script>
   /**
    * We maken hier een globale variabele aan voor onze JavaScript code met de naam products
    * Dit is één van de manieren om de data vanuit PHP in JavaScript beschikbaar te stellen.
    * 
    * Met json_encode($products) laten we array vorm van PHP omzetten naar een vorm
    * die in JavaScript te gebruiken is.
    */
   let products = <?= json_encode($products) ?>;
</script>

<?php
@require_once('src/templates/onderstukhtml.php');