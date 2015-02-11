<?php
include_once 'request/profilMembre.php';
include_once 'controller/gds.php';
if(!empty($_POST['recevoirMail']))
{
	$recevoirMailQuandNews = false;
	$mail = $mysqli->real_escape_string($_SESSION['mail']);
	if(!empty($_POST['recevoirMailQuandNews']))
	{
		$recevoirMailQuandNews = true;
	}
	if($recevoirMailQuandNews)
	{
		run('UPDATE membre SET recevoirMailQuandNews = 1 WHERE mail="'.$mail.'"');
	}
	else
	{
		run('UPDATE membre SET recevoirMailQuandNews = 0 WHERE mail="'.$mail.'"');
	}

}
if(!empty($_POST['supprimerMembre']))
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail = $mysqli->real_escape_string($_SESSION['mail']);
		$resultat=supprimerMembre($mail);
		if($resultat==1){
			session_unset();
			session_destroy();
			header('location:index.php');
		}
		else if($resultat==2){
			$messageSuppressionCompte="Suppression impossible. Vous avez réalisé des réservation de repas, contactez l'administrateur du site pour supprimer votre compte ou attendez que les réservations soient enregistrées pour pouvoir supprimer votre compte.";
		}
		else if($resultat==3){
			$messageSuppressionCompte="Suppression impossible car vous êtes Super Administrateur";
		}
	}
}
if(isset($_POST['modification']))
//Verification de l'utilisation du formulaire
{
	$mail = $mysqli->real_escape_string($_SESSION['mail']);
	$adresse = '';
	$dateNaissance = '';
	$telFixe = '';
	$telPortable = '';
	$oldPassword = getPassword($mail);
	$newPassword = getPassword($mail); // Au cas où que l'utilisateur saisit un mauvais mdp
	//récupération du mot de passe de l'utilisateur
	$messageMdp = '';
	if(!empty($_POST['adresse']) && strlen($_POST['adresse']) <= 110 && !preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['adresse']) && !ctype_space($_POST['adresse']))
	{
		$adresse = $mysqli->real_escape_string($_POST['adresse']);
	}
	if(!empty($_POST['telFixe']))
	{
		if(preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telFixe']))
		{
			$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
		}
	}
	if(!empty($_POST['telPortable']))
	{
		if(preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telPortable']))
		{
			$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
		}
	}
	if((!empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) && ((sha1($mysqli->real_escape_string($GDS.$_POST['password1'])) == $oldPassword) && ($_POST['password2'] == $_POST['password3'])))
	{
		if(strlen($_POST['password2']) > 6 && strlen($_POST['password2']) <= 100 && !ctype_space($_POST['password2']))
		{
			$newPassword = sha1($mysqli->real_escape_string($GDS.$_POST['password2']));
			$messageMdp ="Le mot de passe a été modifié avec succès.";
		}
		else
		{
			$messageMdp ="Le nouveau mot de passe doit comporter au minimum 7 caractères.";
		}
	}	// Traitement d'erreur
	elseif((!empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) && (sha1($mysqli->real_escape_string($GDS.$_POST['password1'])) != $oldPassword))
	{
		$messageMdp = "L'ancien mot de passe ne correspond pas.";
	}
	elseif((!empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) && ($_POST['password2'] != $_POST['password3']))
	{
		$messageMdp= "Vous n'avez pas bien répété le mot de passe.";
	}
	updateMembre($adresse, $telFixe, $telPortable, $newPassword, $mail);
	//Les vérifications ont été réalisées donc on peut mettre à jour le profil du membre
}
$infoMembre = infoMembre($mysqli->real_escape_string($_SESSION['mail']));
//Recuperation des infos du membre par le biais de son adresse mail
include_once 'view/membre/parameters.php';
?>