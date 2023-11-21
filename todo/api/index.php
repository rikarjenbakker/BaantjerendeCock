<?php

@include_once('app/apifunctions.php'); 
@include_once('app/Database.php');
@include_once('app/HttpStatus.php');

$cmd = '';

if(! isset($_GET['cmd'])){
  $cmd = 'all';
} elseif($_GET['cmd']){
  $cmd = strtolower($_GET['cmd']);
} else {
  HttpStatus::http_return(400, 'Er is iets fout gegaan');
}

switch($cmd){
  case 'all':
    getAllTodos();
    break;
  case 'toggle':
    if(!empty($_GET['id'])){
      $id = $_GET['id'];
      echo toggleTodo($id);
    } else{
      echo "kan de status niet uit de get halen";
    }
    break;
  case 'add':
    $todo = $_GET['text'];
    echo addTodo($todo);
    break;
  default:
    HttpStatus::http_return(400, 'Er is iets fout gegaan');
}