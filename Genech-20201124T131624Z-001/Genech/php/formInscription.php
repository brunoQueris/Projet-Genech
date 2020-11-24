<?php

$login = $_POST["login"];
$password = $_POST["password"];
$email = $_POST["email"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];


 require_once("CheckInscription.class.php");
  $auth = new CheckInscription($login,$password,$email,$nom,$prenom);
  if($auth->checkIfUserAlreadyExist() === FALSE){
	  if($auth->addUserToDatabase() === TRUE){
		  require('../index.html');
		}
		else{
	  require('errorsPage.php');
	}
	}
  else{
	  require('errorsPage.php');
	}

 ?>
