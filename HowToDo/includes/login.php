<?php

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
  die('No access');
}
// || $_SERVER['SERVER_NAME'] != '' 

if(!isset($_POST['email']) || !isset($_POST['password']))
{
  die('Required information not provided');
}

@include_once('db.php');

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

$sql = "SELECT * FROM `user` WHERE `email` = :email";
$placeholders = [ ':email' => $email ];

$user = [];

if(Database::query($sql, $placeholders))
{
  $user = Database::get();
}

if(empty($user))
{
  header('location: ../login.php');
  exit(0);
}

if(password_verify($password, $user['password']))
{
  $_SESSION['email'] = $user['email'];
  $_SESSION['name'] = $user['name'];

  header('location: ../index.php');
  exit(0);
}

header('location: ../login.php');
exit(0);