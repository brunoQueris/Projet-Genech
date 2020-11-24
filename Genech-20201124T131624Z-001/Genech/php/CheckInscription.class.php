<?php

require('db_params.php');

/**
 *
 */
class CheckInscription{

  // Attributs

  private $connexion;
  private $login;
  private $hashed_password;
  private $email;
  private $nom;
  private $prenom;
  private $errors;

// Méthodes

// Constructeur

  public function __construct($login,$password,$email,$nom,$prenom){
    $this->errors = array();
    $this->login = $login;
    $this->hashed_password = hash("sha256",$password);
    $this->email = $email;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->connexion = new PDO(
            DB_DSN, DB_USER, DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
          );
  }

  /**
  *renvoie TRUE si l'utilisateur a été enregistré
  * sinon FALSE
  */

  public function addUserToDatabase(){
    $sql = "insert into users (nom,prenom,email,login,password) values (:nom, :prenom, :email, :login, :password)";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':nom', $this->nom);
    $stmt->bindValue(':prenom',$this->prenom);
    $stmt->bindValue(':email',$this->email);
    $stmt->bindValue(':login',$this->login);
    $stmt->bindValue(':password', $this->hashed_password);
    $stmtres = $stmt->execute();
    if ($stmtres === FALSE){
      $this->errors['user'] = "user not registered";
        return FALSE;
	}
    return TRUE;
  }

  /**
  * Vérifie si l'utilisateur existe déja dans la base de donnée
  * renvoie TRUE si l'utilisateur existe dans la base de donnée
  * sinon FALSE
  */
  public function checkIfUserAlreadyExist(){
	$sql = "SELECT email FROM users WHERE email = :email" ;
	$stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':email',$this->email);
    $stmtres = $stmt->execute();
    if ($stmtres === FALSE){
        return FALSE;
	}
	else{
		$this->errors['user'] = "user already exists";
		return TRUE;
	}
  }

   /**
	 *	return associative array of errors
	 */
	public function getErrors(){
		return $this->errors;
	}
}


 ?>
