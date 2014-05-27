<?php
include_once 'request/connection.php';
include_once 'request/deleteAccount.php';
if(isset($_POST['deleteAccount']))
{
	if(isConnect())
	//Il faut s'assurer que l'utilisateur est vraiment connecté
	{
		if(deleteAccount() == true)
		{
			$_SESSION['message'] = "Suppression du compte réussie.";
		}
		else
		{
			$_SESSION['message'] = "Suppression du compte impossible.";
		}
		if(!empty($_SESSION['message']))
		{
			//permet l'affichage du message
			$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
			unset($_SESSION['message']);
		}
		header('location:../index.php');
	}
	else
	{
		header('location:../index.php');
	}
}
?>