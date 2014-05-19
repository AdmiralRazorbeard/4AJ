<?php
include_once 'request/connection.php';
if(isConnect()) 
// Pour se déconnecter
{
	if(!empty($_GET['dislog']) && $_GET['dislog'] == true)
	{
		unset($_SESSION['mail']);
		unset($_SESSION['log']);
		$_SESSION['message'] = "Vous êtes déconnecté.";
		header('location:index.php');
	} 
}
if(!empty($_POST['mail']) && !empty($_POST['password']))	
//Connexion
{
	$mail = $mysqli->real_escape_string($_POST['mail']); 
	$password = md5($_POST['password']);
	$nbreMembre = countMember($mail, $password);	
	// Count membre retourne 1 si valide
	// 1,5 si le mail est valide mais pas le password
	if($nbreMembre == 1)
	{
		$message = "Vous êtes connecté.";
		$_SESSION['log'] = 1;
		$_SESSION['mail'] = $mail;
	}
	elseif($nbreMembre == 1.5)
	{
		$message = "Le mot de passe est invalide.";
	}
	else
	{
		$message = "L'utilisateur n'existe pas.";
	}
}
if(isConnect())
{
	if(!empty($message))
	{
		$_SESSION['message'] = $message;
	}
	header('location:index.php');
}
include_once 'view/connection.php';
?>