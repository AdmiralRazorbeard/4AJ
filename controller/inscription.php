<?php
include_once 'request/inscription.php';
if(!empty($_POST['nom']) || !empty($_POST['prenom']) || !empty($_POST['mail']) || !empty($_POST['password']))
// Si quelqu'un a complété le formulaire : 
{
	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['password']))
	// Et si il a bien complété le formulaire :
	{
		$errorPassword = false;
		$error = 0;
			// NOM
		$nom = $mysqli->real_escape_string($_POST['nom']);
		if(preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['nom']))
		{
			$error ++;
		}

			// PRENOM
		$prenom = $mysqli->real_escape_string($_POST['prenom']);
		if(preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['prenom']))
		{
			$error ++;
		}

			// MAIL
		if(!preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']))
		{
			$error ++;
		}
		$mail = $mysqli->real_escape_string($_POST['mail']);

			// PASSWORD
		if(strlen($_POST['password']) <= 6)
		{
			$errorPassword = true;
			$error ++;
		}
		else
		{ 
			echo $password;
			$password = md5($_POST['password']);
		}

			// ADRESSE
		if(!empty($_POST['adresse']))
		{
			$adresse = $mysqli->real_escape_string($_POST['adresse']);
		}
		else
		{
			$adresse = "NULL";
		}

			// TEL FIXE
		if(!empty($_POST['telFixe']))
		{
			if(preg_match("#^[0-9]{10}$#", $_POST['telFixe']))
			{
				$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
			}
			else
			{
				$telFixe = "NULL";
			}
		}
		else
		{
			$telFixe = "NULL";
		}

			// TEL PORTABLE
		if(!empty($_POST['telPortable']))
		{
			if(preg_match("#^[0-9]{10}$#", $_POST['telPortable']))
			{
				$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
			}
			else
			{
				$telPortable = "NULL";
			}
		}
		else
		{
			$telPortable = "NULL";
		}
		echo $error;
		if($error == 0)
		{
			addMembers($nom, $prenom, $adresse, $telFixe, $telPortable, $mail, $password);
		}
		else
		{
			$message = "Il y a ".$error." erreur(s).";
			if($errorPassword)
			{
				$message = $message."<br />Le mot de passe doit comporté plus de 6 caractères.";
			}
		}
	}
	else
	// Si il a mal complété le formulaire :
	{
		$message = "Vous n'avez pas rempli tous les champs obligatoires.";
	}
}


include_once 'view/inscription.php';
?>