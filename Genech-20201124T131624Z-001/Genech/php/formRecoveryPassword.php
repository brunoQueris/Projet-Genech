<?php

	$email = $_POST["email"];

  require_once("CheckRecoveryPassword.class.php");
  $auth = new CheckRecoveryPassword($email);
  if($auth->checkMail() === TRUE){
    require('../changePassword.html');
  }
  else{
	  require('errorsPage.php');
	}

 ?>
