giut<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HowToDo - Tutorial</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="other/1.3.0/css/line-awesome.min.css">
</head>
<body>
  <?php include 'includes/menu.php'; 
  
  if(!isset($_GET['tutorial_id'])) {
    header('location: index.php');
    exit(0);
  }

  if(!isset($_GET['tutorial_id'])) {
    echo('ik doe het' + $_GET['tutorial_id']);
    exit(0);
  }

  $tutorial_id = intval($_GET['tutorial_id']);
  require 'includes/db.php';
  $sql = "SELECT * FROM `tutorial` WHERE `id` = $tutorial_id";
  $dbStatement = $dbConnection->prepare($sql);
  $dbStatement->execute();
  $content = $dbStatement->fetchAll(PDO::FETCH_ASSOC);
  // $content = json_encode($contents);
  ?>
  <?= json_encode($content['id']) ?>
  <div class="tutorial-page">
    <div class="tutorial-page__title">
      Here goes the title of the tutorial
    </div>
    <div class="tutorial-page__description">
      Here goes a short description of what the tutorial is about, who placed it and what the rating is.
    </div>
    <div class="tutorial-page__steps">
      <div class="tutorial-page__steps__step">
        1. here will the steps go.
      </div>
      <div class="tutorial-page__steps__step">
        2. like is shown here.
      </div>
      <div class="tutorial-page__steps__step">
        3. I think you can move on now :).
      </div>
    </div>
    <div class="tutorial-page__comments">
      <div class="tutorial-page__comments__comment">
        <div class="tutorial-page__comments__comment--username">
          User123          
        </div>
        <div class="tutorial-page__comments__comment--text">
          Here goes the comment.
        </div>
        <div class="tutorial-page__comments__comment--rating">
          4,5/5
        </div>
      </div>
      <div class="tutorial-page__comments__reaction">
        <div class="tutorial-page__comments__reaction--username">
          User321
        </div>
        <div class="tutorial-page__comments__reaction--text">
          I do think that is a weird comment on this topic to be honnest.
        </div>
      </div>
    </div>
  </div>
  <script src="js/main.js"></script>
</body>
</html>