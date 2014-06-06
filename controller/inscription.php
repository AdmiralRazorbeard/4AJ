<?php
include_once 'request/inscription.php';
if(!empty($_POST['nom']) || !empty($_POST['prenom']) || !empty($_POST['mail']) || !empty($_POST['password1']) || !empty($_POST['password2']))
// Si quelqu'un a complété le formulaire : 
{
	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['password1']) && !empty($_POST['password2']))
	// Et si il a bien complété le formulaire :
	{		
			// INITIALISATION
		$errorPassword = false;
		$errorMail = false;
		$errorGlobalName = false;
		$error = 0;
		$adresse = "NULL";
		$telFixe = "NULL";
		$telPortable = "NULL";
		$dateNaissance = "NULL";
		$recevoirMailQuandNews = 0;
			// NOM
		$nom = $mysqli->real_escape_string($_POST['nom']);
		if(preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['nom']))
		{
			$errorGlobalName=true;
			$error ++;
		}

			// PRENOM
		$prenom = $mysqli->real_escape_string($_POST['prenom']);
		if(preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['prenom']))
		{
			$errorGlobalName=true;
			$error ++;
		}

			// MAIL
		if(!preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']))
		{
			$error ++;
		}
		if (mailExist($_POST['mail']))
		{
			$errorMail=true;
			$error ++;
		}
		$mail = $mysqli->real_escape_string($_POST['mail']);
			// recevoirMailQuandNews
		if(!empty($_POST['recevoirMail']))
		{
			$recevoirMailQuandNews = 1;
		}
			// PASSWORD
		if($_POST['password1'] == $_POST['password2'])
		{
			if(strlen($_POST['password1']) <= 6)
			{
				$errorPassword = true;
				$error ++;
			}
			else
			{ 
				$password = md5($_POST['password1']);
			}
		}
		else
		{
			$error ++;
		}

			// ADRESSE
		if(!empty($_POST['adresse']))
		{
			$adresse = $mysqli->real_escape_string($_POST['adresse']);
		}

			// TEL FIXE
		if(!empty($_POST['telFixe']))
		{
			if(preg_match("#^[0-9]{10,11}$#", $_POST['telFixe']))
			{
				$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
			}
		}

			// TEL PORTABLE
		if(!empty($_POST['telPortable']))
		{
			if(preg_match("#^[0-9]{10,11}$#", $_POST['telPortable']))
			{
				$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
			}
		}
		if(!empty($_POST['anneDateNaissance']) && !empty($_POST['moisDateNaissance']) && !empty($_POST['jourDateNaissance']))
		{
			if(is_numeric($_POST['anneDateNaissance']) && $_POST['anneDateNaissance'] <= date('Y') && $_POST['anneDateNaissance'] >= 1920 && !empty($_POST['moisDateNaissance']) && is_numeric($_POST['moisDateNaissance']) && $_POST['moisDateNaissance'] >= 1 && $_POST['moisDateNaissance'] <= 12 && !empty($_POST['jourDateNaissance']) && is_numeric($_POST['jourDateNaissance']) && $_POST['jourDateNaissance'] >= 1 && $_POST['jourDateNaissance'] <= 31)
			{
				$dateNaissance = $_POST['anneDateNaissance'].'-'.$_POST['moisDateNaissance'].'-'.$_POST['jourDateNaissance'];
			}
		}
		if($error == 0)
		{
			addMembers($nom, $prenom, $adresse, $telFixe, $telPortable, $mail, $dateNaissance, $recevoirMailQuandNews, $password);
			$message ="<br />L'inscription est réussie, vous pouvez désormais vous connecter sur la page d'accueil<br />";
		}
		else
		{
			$message = "Il y a ".$error." erreur(s).";
			if($errorPassword)
			{
				$message = $message."<br />Le mot de passe doit comporté plus de 6 caractères.";
			}
			if($errorGlobalName)
			{
				$message2 ="<br />Veuillez vérifier la validité de vos données (Nom et/ou Prénom)";
			}
			if($errorMail)
			{
				$message3 ="<br />Ce mail est déjà utilisé pour un autre compte";
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