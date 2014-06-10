<?php
include_once 'request/lostPassword.php';
if(!empty($_POST['email']))
{
	$result = resetPassword($mysqli->real_escape_string($_POST['email']));
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

include_once 'view/lostPassword.php';
;?>