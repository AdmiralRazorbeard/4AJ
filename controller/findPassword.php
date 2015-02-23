<?php
include_once 'request/findPassword.php';
include_once 'controller/gds.php';
if(empty($_GET['id']) && empty($_POST['password']))
{
	header('location:index.php');
}
########## PREMIERE PARTIE : RECEPTION ID ##############
if(!empty($_GET['id']))
//l'id correspond ici au mdp de 50 caractères créé lors de la demande de changement de mot de passe
{
	// Vérification qu'il y a bien eu un reset password et récupère l'id du membre si il y a
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
}

######### SECONDE PARTIE : CHANGER MOT DE PASSE ###############
// Quelqu'un a rempli le formulaire, donc on change le mot de passe :
if(!empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['securite']))
{
	$securite = $mysqli->real_escape_string($_POST['securite']);
	if((strlen($_POST['password']) > 6 && strlen($_POST['password2']) <= 100) && ($_POST['password']==($_POST['password2'])))
	{
		$password = sha1($mysqli->real_escape_string($GDS.$_POST['password']));
		$nbre = run('SELECT COUNT(*) as nbre FROM oubliemotdepassesecurite WHERE securite="'.$securite.'"')->fetch_object();
		// On vérifie qu'il y a bien une clé de sécurité qui correspond dans la table
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
				header('location:index.php');
			}
		}
	}
	else
	{
		$_SESSION['erreur'] = "Erreur: le mot de passe doit faire plus de 6 caractères et/ou les deux mots de passe n'étaient pas identiques";
		$_SESSION['count'] = 2;
		header('location:index.php?section=findPassword&id='.$securite);
	}
}
include_once 'view/findPassword.php';

?>