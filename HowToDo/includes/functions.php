<?php 

if(session_status() === PHP_SESSION_NONE) session_start();

function isLoggedIn()
{

}

function getLoggedInUserEmail() 
{

}

function getLoggedInUserName()
{

}

function logout()
{
  if(session_status() === PHP_SESSION_ACTIVE) {
    if(isset($_SESSION['email']))
      unset($_SESSION['email']);
    if(isset($_SESSION['name']))
      unset($_SESSION['name']);

    session_destroy();
  }
}

function login()
{

}