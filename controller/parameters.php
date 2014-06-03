<?php
include_once 'request/profilMembre.php';
if(isset($_POST['modification']))
//Verification de l'utilisation du formulaire
{
	$mail = $_SESSION['mail'];
	$adresse = '';
	$dateNaissance = '';
	$telFixe = '';
	$telPortable = '';
	$newPassword = getPassword($mail);
	//récupération du mot de passe de l'utilisateur
	$messageMdp = '';
	if(!empty($_POST['adresse']))
	{
		$adresse = $mysqli->real_escape_string($_POST['adresse']);
	}
	if(!empty($_POST['telFixe']))
	{
		if(preg_match("#^[0-9]{10,11}$#", $_POST['telFixe']))
		{
			$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
		}
	}
	if(!empty($_POST['telPortable']))
	{
		if(preg_match("#^[0-9]{10,11}$#", $_POST['telPortable']))
		{
			$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
		}
	}
	if((!empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) && ((md5($_POST['password1']) == $newPassword) && ($_POST['password2'] == $_POST['password3'])))
	{
		if(strlen($_POST['password2']) > 6)
		{
			$newPassword = md5($_POST['password2']);
			$messageMdp ="Le mot de passe a été modifié avec succès.";
		}
		else
		{
			$messageMdp ="Le nouveau mot de passe doit comporter au minimum 7 caractères.";
		}
	}
	updateMembre($adresse, $telFixe, $telPortable, $newPassword, $mail);
	//Les vérifications ont été réalisées donc on peut mettre à jour le profil du membre
}
$infoMembre = infoMembre($_SESSION['mail']);
//Recuperation des infos du membre par le biais de son adresse mail
include_once 'view/membre/parameters.php';
?>