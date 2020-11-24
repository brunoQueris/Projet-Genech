<?php

	$login = $_POST["login"];
	$password = $_POST["password"];

  require_once("CheckLogin.class.php");
  $auth = new CheckLogin($login,$password);
  if($auth->authentifier() === TRUE){
    //session_start(); 
  }
  else{
	  require('errorsPage.php');
	}

 ?>
