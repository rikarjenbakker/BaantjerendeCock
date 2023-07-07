<?php


$dbHost = '127.0.0.1';
$dbName = 'how_to_do';
$dbUser = 'root';
$dbPass = 'root';

$dbConnection = null;
$dbStatement = null;  

try {
  $dbConnection = new PDO("mysql:host={$dbHost};dbname={$dbName};", $dbUser, $dbPass);
} catch(PDOExption $error) {
  echo $error->getErrorMessage();
}
