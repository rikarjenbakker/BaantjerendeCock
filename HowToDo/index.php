<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HowToDo - Home</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="other/1.3.0/css/line-awesome.min.css">
</head>
<body>
  <?php 
    include 'includes/menu.php'; 
    include 'includes/db.php';
    $tutorials = "SELECT * FROM `tutorial`";
    $dbStatement = $dbConnection->prepare($tutorials);
    $dbStatement->execute();
    $tutorial = $dbStatement->fetchAll(PDO::FETCH_ASSOC);  
    
  ?>


<div class="tutorial-page">
  
    <?php foreach($tutorial as $tutorial): ?>
      
      <a href="tutorial.php?tutorial_id=<?= $tutorial['title'] ?>" class="tutorial-item">
        <img src="img\istockphoto-530491981-612x612.jpg"alt="image-tutorial" class="tutorial-item__img">
        <p class="tutorial-item__title">
        <?= $tutorial['title'] ?>
        </p>
      </a>

    <?php endforeach ?>

  </div>

</body>
</html>