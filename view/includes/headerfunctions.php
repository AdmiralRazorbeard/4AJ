<?php
function isConnected()
// Return true si connecté, false sinon
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		return true;
	}
	return false;
}
?>
<?php
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
?>
<?php
function openSection($page)
//permet de regarder quelle section est ouverte et creer un classe active pour les boutons du menu
{
	if($_GET['section'] == $page)
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_vieEnFoyer()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'vieEnFoyer' || $_GET['section'] == 'services' || $_GET['section'] == 'repas' || $_GET['section'] == 'livreOr')
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_devenirResidant()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'devenirResidant' || $_GET['section'] == 'conditions' || $_GET['section'] == 'logements')
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_contact()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'contact' || $_GET['section'] == 'faq' || $_GET['section'] == 'memento' || $_GET['section'] == 'faireUnDon')
	{
		return true;
	}
	return false;
}
?>
<?php
function openSubSection($page)
//permet de regarder quelle section est ouverte et creer un classe active pour les boutons du menu
{
	if($_GET['subSection'] == $page)
	{
		return true;
	}
	return false;
}
?>
<?php
if(isConnected()) 
// Pour se déconnecter
{
	if(!empty($_GET['dislog']) && $_GET['dislog'] == true)
	{	
		unset($_SESSION['mail']);
		unset($_SESSION['log']);
		$_SESSION['message'] = "Vous êtes déconnecté.";
	} 
}
if(!empty($_POST['mail']) && !empty($_POST['password']))	
//Connexion
{
	$mail = $mysqli->real_escape_string($_POST['mail']); 
	$password = md5($_POST['password']);
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
		$message = "Le mot de passe est invalide.";
	}
	else
	{
		$message = "L'utilisateur n'existe pas.";
	}
}
if(isConnected())
{
	if(!empty($message))
	{
		$_SESSION['message'] = $message;
	}
}
?>
<?php
if(!empty($_SESSION['message']))
{
	$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
	unset($_SESSION['message']);
}
?>