<?php
include_once 'request/livreOr.php';
$_SESSION['backgroundBody']='#4e0105';
$admin = false;
if(isAdminLivreOr())
{	$admin = true; }
if($admin && !empty($_GET['delete']) && is_numeric($_GET['delete']))
{
	deleteLivreOr($_GET['delete']);
}

// Changer le nombre de billet par page
if($admin && !empty($_POST['nbreBilletParPage']) && is_numeric($_POST['nbreBilletParPage']))
{
	if($_POST['nbreBilletParPage']>=1 && $_POST['nbreBilletParPage']< 200)
	{
		newNombreBilletParPage(intval($_POST['nbreBilletParPage']));
	}
}

// Ajouter un nouveau billet
if(!empty($_POST['nom']) && !preg_match("#[^a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ -]#", $_POST['nom']) && !empty($_POST['mail']) && preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']) && !empty($_POST['contenu']) && !empty($_POST['verif_code']) && !empty($_POST['choix_forme']) && empty($_POST['nickname']))
{
	if (($_POST['verif_code']==$_SESSION['aleat_nbr']) && ($_POST['choix_forme']==$_SESSION['aleat_nbr_forme'])) 
	{
		if(!ctype_space($_POST['nom']) && !ctype_space($_POST['contenu']) && strlen($_POST['nom']) <= 60 && strlen($_POST['contenu']) <= 505)
		{
			$nom = $mysqli->real_escape_string($_POST['nom']);
			$contenu = $mysqli->real_escape_string($_POST['contenu']);
			$email = $mysqli->real_escape_string($_POST['mail']);
			addLivreOrAConfirmer($nom,$email,$contenu);
			$confirmationMessage= "Message envoyé en attente de validation";
		}
	}
	else
	{
		$confirmationMessage= "Erreur aux questions de securité";
	}
}
$nbreBilletParPage = returnNombreBilletParPage();
$nbrePage = nbrePage($nbreBilletParPage);
if(!empty($_GET['page']) && is_numeric($_GET['page']) && intval($_GET['page']) == $_GET['page'] && $_GET['page'] >= 1 && $_GET['page'] <= $nbrePage)
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
$livreOr = returnLivreOr($page, $nbreBilletParPage); 	// Récupére toutes les données du livre d'or
//Selection aléatoire nombre pour forme
$chiffreForme = mt_rand(1,3);
$_SESSION['aleat_nbr_forme'] = $chiffreForme;

include_once 'view/contact/livreOr.php';
?>