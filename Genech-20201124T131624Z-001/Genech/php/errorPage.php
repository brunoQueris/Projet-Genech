<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Erreur</title>
    </head>
    <body>
        <?php
		public function errorsToHTML(){
			$errors = getErrors();
			foreach($errors as $error => $res){
				echo $res."\n";
			}
		}
		echo errorsToHTML(); 
        ?>
	<a href="index.html">Retour page d'acceuil</a><br>
    </body>
</html>
