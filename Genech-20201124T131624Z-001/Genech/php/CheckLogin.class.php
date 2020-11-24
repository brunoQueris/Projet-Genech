<?php

require('db_params.php'); // contient les constante de connexion à la base de donnée

  Class CheckLogin{
    // Attributs

    private $connexion;
    private $login;
    private $errors;
    private $password;

    //Constructeur

    public function __construct($login,$password){
      $this->errors = array();
      $this->login = $login;
      $this->password = $password;
      $this->connexion = new PDO(
              DB_DSN, DB_USER, DB_PASSWORD,
              [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
              ]
            );
    }

	/**
	 * return TRUE if the login and the passwords are correct
	 * otherwise FALSE and enter the error in the array of errors.
	 */

    public function authentifier(){
      $sql = "SELECT password FROM users WHERE login = ':login'" ;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':login', $this->login);
      $stmt->execute();
      $user = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      if ($user === TRUE){
		  if(hash_equals($user['password'],crypt($this->password, $user['password']))){
			return TRUE;
        }
		  else{
			$this->errors['password'] = "error in password";
			return FALSE;
		}
		}
        else{
        $this->errors['user'] = "user not found";
        return FALSE;
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
