<?php
include_once 'request/lostPassword.php';
if(!empty($_POST['email']) && !empty($_POST['verif_code']) && !empty($_POST['choix_forme']) && empty($_POST['name']))
{
	if (($_POST['verif_code']==$_SESSION['aleat_nbr']) && ($_POST['choix_forme']==$_SESSION['aleat_nbr_forme']))
	{
		$result = resetPassword($_POST['email']);
		/* Envoie le mail si il y a un membre avec ce mail et retourne true, sinon return false */
		if(!$result)
		{
			$error = "Le mail ne correspond à aucun membre.";
		}
		else
		{
			$error = "Un mail vous a été envoyé.";
		}
	}
	else
	{
		$error = "Erreur aux questions de securité";
	}
}
//Selection aléatoire nombre pour forme
$chiffreForme = mt_rand(1,3);
$_SESSION['aleat_nbr_forme'] = $chiffreForme;

include_once 'view/lostPassword.php';
;?>