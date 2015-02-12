<?php
include_once('/controller/gds.php');
function isConnected()
// Return true si connecté, false sinon
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		return true;
	}
	return false;
}
function countMembers($mail, $password)
//Retourne 1 si valide, 1.5 si seulement mail valide
{
	$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'"');
	$nbre = $nbre->fetch_object();
	if($nbre->nbre == 1)
	{
		$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'" AND password = "'.$password.'"');
		$nbre = $nbre->fetch_object();
		if($nbre->nbre == 1)
			return 1;
		else
			return 1.5;
	}
	return 0;
}
function openSection($page)
//permet de regarder quelle section est ouverte et creer un classe active pour les boutons du menu
{
	if($_GET['section'] == $page)
	{
		return true;
	}
	return false;
}
function openSous_Section_association()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'association' || $_GET['section'] == 'quiSommesNous' || $_GET['section'] == 'plateformeLogement')
	{
		return true;
	}
	return false;
}
function openSous_Section_nosResidences()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'nosResidences' || $_GET['section'] == 'residenceAnneFrank' || $_GET['section'] == 'residenceClairLogis' || $_GET['section'] == 'residenceNobel')
	{
		return true;
	}
	return false;
}
function openSous_Section_contact()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'contact' || $_GET['section'] == 'faq' || $_GET['section'] == 'memento' || $_GET['section'] == 'liensUtiles' || $_GET['section'] == 'livreOr')
	{
		return true;
	}
	return false;
}
function openSubSection($page)
//permet de regarder quelle section est ouverte et creer un classe active pour les boutons du menu
{
	if($_GET['subSection'] == $page)
	{
		return true;
	}
	return false;
}

function isAdminSomewhere()
// Cette fonction détermine si l'utilisateur à des pouvoirs au niveau de la partie admin
{
	if(!empty($_SESSION['mail']))
	{
		$mysqli = connection();
		$mail = $mysqli->real_escape_string($_SESSION['mail']);
		$isSuperAdmin = run('SELECT isSuperAdmin FROM membre WHERE mail="'.$mail.'"')->fetch_object();
		if($isSuperAdmin->isSuperAdmin == 1)
			{ return true; }
		$tmp = run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id  
						AND membre.mail="'.$mail.'" 
						AND (isAdminLivreOr = 1 OR isAdminActualite=1 OR isAdminRepas=1)')->fetch_object();
		if($tmp->nbre >= 1)
		{
			return true;
		}
	}
	return false;
}

function isSuperAdmin()
// Vérifie si l'utilisateur est super admin
{	
	if(!empty($_SESSION['mail']))
	{
		$mysqli = connection();
		$mail = $mysqli->real_escape_string($_SESSION['mail']);
		$isSuperAdmin = run('SELECT isSuperAdmin FROM membre WHERE mail="'.$mail.'"')->fetch_object();
		if($isSuperAdmin->isSuperAdmin == 1)
		{
			return true;
		}
	}
	return false;	
}

if(!empty($_GET['superAdminOn']) && $_GET['superAdminOn'])
{
	if(isSuperAdmin())
	{
		$_SESSION['superAdminOn'] = true;
	}
	if(!empty($_GET['get']))
	{
		header('location:index.php?section='.$_GET['get']);
	}
}
if(!empty($_GET['finSuperAdminOn']))
{
	unset($_SESSION['superAdminOn']);
	if(!empty($_GET['get']))
	{
		header('location:index.php?section='.$_GET['get']);
	}
}
if(!empty($_SESSION['superAdminOn']))
{
	if(!isSuperAdmin())
	{
		unset($_SESSION['superAdminOn']);
	}
}
if(isConnected()) 
// Pour se déconnecter
{
	if(!empty($_GET['dislog']) && $_GET['dislog'] == 'true')
	{	
		session_unset();
		session_destroy();
		header('location:index.php?section='.$_GET['section']);
	} 
}
if(!empty($_POST['mail']) && !empty($_POST['password']))	
//Connexion
{
	if(preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']) && (!(strlen($_POST['password']) <= 6) && !(strlen($_POST['password']) > 100) && !(ctype_space($_POST['password'])) ))
	{
		usleep(1000000);
		//permet de faire une pause d'une demi seconde pour se proteger des attaques de type force brute
		$mail = $mysqli->real_escape_string($_POST['mail']); 
		$password = sha1($mysqli->real_escape_string($GDS.$_POST['password']));
		$nbreMembre = countMembers($mail, $password);	
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
			$message = "Mot de passe invalide.";
		}
		else
		{
			$message = "L'utilisateur n'existe pas.";
		}
	}
}
if(isConnected())
{
	if(!empty($message))
	{
		$_SESSION['message'] = $message;
	}
}

if(!empty($_SESSION['message']))
{
	$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
	unset($_SESSION['message']);
}
?>