<?php

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

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$sql = "INSERT INTO `users`(`username`, `email`, `password`)
        VALUES(:username, :email, :password)";

$placeholders = [
   ':username' => $username,
   ':email' => $email,
   ':password' => $password
];

$dbStatement = $dbConnection->prepare($sql);
$dbStatement->execute($placeholders);

header('location: ../../login.php');
exit();