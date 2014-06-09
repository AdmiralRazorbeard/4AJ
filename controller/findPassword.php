<?php
include_once 'request/findPassword.php';
if(empty($_GET['id']) && empty($_POST['password']))
{
	header('location:index.php');
}
########## PREMIERE PARTIE : AFFICHER FORMULAIRE ##############
if(!empty($_GET['id']))
{
	// Vérification qu'il y a un bien eu un reset password et récupère l'id du membre si il y a
	$id = $mysqli->real_escape_string($_GET['id']);
	$tmp = run('SELECT COUNT(*) as nbre, id_membre, securite, UNIX_TIMESTAMP(CurrentTimestamp) as timestamp 
				FROM oubliemotdepassesecurite 
				WHERE UNIX_TIMESTAMP(CurrentTimestamp) > "'.strtotime("-2 hours").'" 
				AND securite="'.$id.'"')->fetch_object();
	if($tmp->nbre == 0)
	{
		header('location:index.php');
	}
	$infoMembre = infoMembre($tmp->id_membre);
	$id = $mysqli->real_escape_string($_GET['id']);
}

######### SECONDE PARTIE : CHANGER MOT DE PASSE ###############
// Quelqu'un a rempli le formulaire, donc on change le mot de passe :
if(!empty($_POST['password']) || !empty($_POST['securite']))
{
	if(!empty($_POST['password']) && !empty($_POST['securite']))
	{
		$securite = $mysqli->real_escape_string($_POST['securite']);
		if(strlen($_POST['password']) >= 6)
		{
			$password = md5($_POST['password']);
			// On vérifie qu'il y a bien une clé de sécurité qui correspond dans la table
			$nbre = run('SELECT COUNT(*) as nbre FROM oubliemotdepassesecurite WHERE securite="'.$securite.'"')->fetch_object();
			if($nbre->nbre == 1)
			{
				// On récupère l'id du membre où il faut modifier le mot de passe :
				$idMembre = run('SELECT id_membre FROM oubliemotdepassesecurite WHERE securite="'.$securite.'"')->fetch_object();
				// On vérifie que le membre existe encore
				$tmp = run('SELECT COUNT(*) as nbre FROM membre WHERE id = '.$idMembre->id_membre)->fetch_object();
				if($tmp->nbre == 1)
				{
					// On change le mot de passe
					run('UPDATE membre SET password="'.$password.'" WHERE id='.$idMembre->id_membre);
					// On supprime l'entrée dans oubliemotdepassesecurite
					run('DELETE FROM oubliemotdepassesecurite WHERE securite="'.$securite.'"');
					$_SESSION['changerMotDePasse'] = "Le mot de passe a bien été modifié.";
					header('location:index.php');
				}
			}
		}
		else
		{
			$_SESSION['erreur'] = "Le mot de passe doit faire plus de 6 caractères.";
			$_SESSION['count'] = 2;
			header('location:index.php?section=findPassword&id='.$securite);
		}
	}
	else
	{
		header('location:index.php');
	}
}
include_once 'view/findPassword.php';

?>