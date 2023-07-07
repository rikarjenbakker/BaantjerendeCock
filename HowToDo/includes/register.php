<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
// || $_SERVER['SERVER_NAME'] != '127.0.0.1' niet gebruikt omdat ik niet wist welke naam mijn server heeft
{
  die('No access');
} 

if(!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) 
{
  die('Not all required information is provided');
}

@include_once('db.php');

$username = htmlentities($_POST['username']);
$email = htmlentities($_POST['email']);

$password = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);

$sql = "INSERT INTO `user`(`username`, `email`, `password`) VALUES(:username, :email, :password)";
$placeholders = [ ':username' => $username, ':email' => $email, ':password' => $password ];

if(Database::query($sql, $placeholders))
{
  header('location: ../login.php');
  exit(0);
}

header('location: ../index.php');
exit(0);