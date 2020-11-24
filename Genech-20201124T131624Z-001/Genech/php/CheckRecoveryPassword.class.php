<?php

require('db_params.php'); // contient les constantes de connexion à la base de donnée.

/**
 * Class to check
 */
class CheckRecoveryPassword{

// Attributs

  private $connexion;
  private $email;

// Constructeur

  public function __construct($email){
    $this->email = $email;
    $this->connexion = new PDO(
            DB_DSN, DB_USER, DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
          );
  }

  /**
  * renvoie TRUE si le mail existe dans la base de donnée ,
  * sinon FALSE
  */
  public function checkMail(){
    $sql = "SELECT email,login FROM users WHERE email = :email" ;
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(":email", $this->email);
    $stmt->execute();
    $user = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($user === FALSE){
        return FALSE;
	}
	else{
		return TRUE;
	}
 }

/**
* change le mot de passe dans la base de donnée
* renvoie TRUE si le mot de passe a été changé,
* sinon FALSE
*/

  public function changePassword($password){
    $this->hashed_password = hash("sha256",$password);
    $sql = "UPDATE users set password = ':password' WHERE users.email= ':email'";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':email', $this->email);
    $stmt->bindValue(':password', $password);
    $stmtres = $stmt->execute();
    if ($stmtres === FALSE)
        return FALSE;
    return TRUE;
  }
}


 ?>
