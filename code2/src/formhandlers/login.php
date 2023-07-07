<?php
session_start();

// Globale variabelen nodig om een connectie te maken
// met de databaseserver
$dbHost = '127.0.0.1';
$dbName = 'wittekip';
$dbUser = 'root';
$dbPassword = 'root';

// Globale variabelen om te kunnen werken met de database
// via PDO
$dbConnection = null; // NUL, 0, ''
$dbStatement = null;

try {
   $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
} catch(PDOException $error) {
   header('location: ../../index.php');
   exit();
}

$email = htmlentities( $_POST['email'] );
$password = $_POST['password'];

$sql = "SELECT * FROM `users` WHERE `users`.`email` = :email";
$placeholders = [ ':email' => $email ];

$dbStatement = $dbConnection->prepare($sql);
$dbStatement->execute($placeholders);

$user = $dbStatement->fetch(PDO::FETCH_ASSOC);

if(password_verify($password, $user['password'])) {
   // Login is succesvol
   $_SESSION['user_id'] = $user['id'];
   $_SESSION['username'] = $user['username'];
   header('location: ../../index.php');
   exit();
} 

header('location: ../../login.php');
exit();

