<?php

$user = 'root';
$password = 'Hoendiep11';
$database = 'webshop';
$servername = '127.0.0.1';

$dbConnection = null;
$dbStatement = null;

try {
  $dbConnection = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
} catch(PDOException $error) {
  echo $error->getErrorMessage();
}


// $mysqli = new mysqli($servername, $user, $password, $database);

// if (!$mysqli){
//   echo "Connection Unsuccesful";
// }