<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('request/connectionSQL.php');
$mysqli = connection();

###### LANGUAGE #######
// Cela permet de gérer la langue, on met une variable valant 1 si FR, 2 si EN.
if(empty($_SESSION['langue']) || (($_SESSION['langue'] != 1) && ($_SESSION['langue'] != 2)))
{
	$_SESSION['langue'] = 1;
}
function langue($FR, $EN)
// Cette fonction affiche, en fonction de si c'est FR ou EN, le $FR ou le $EN
{
	if($_SESSION['langue'] == 2) 
		{ echo $EN; }
	else 
		{ echo $FR; }
}
####### FIN GESTION LANGUAGE #######

//Ce fichier permet de gerer la section à afficher en appellant ensuite le controleur
if(isset($_GET['typeActualite']) && empty($_GET['section']))
// Au cas où on vient d'actualite
{
	if(is_numeric($_GET['typeActualite']) || $_GET['typeActualite'] == 'all')
	{
		header('location:index.php?section=actualites&typeActualite='.$_GET['typeActualite']);
	}
	else
	{
		header('location:index.php?index=index');
	}	
}
// Si on ne vient pas d'actualité, on fait comme d'hab
elseif (empty($_GET['section']))	
{
    header('location:index.php?section=index');
}
elseif ($_GET['section'] == 'FR')
{
	include_once 'controller/FR.php';
}
elseif ($_GET['section'] == 'EN')
{
	include_once 'controller/EN.php';
}
elseif ($_GET['section'] == 'index')
{
	include_once 'controller/index.php';
}
elseif ($_GET['section'] == 'inscription')
{
	include_once 'controller/inscription.php';
}
elseif ($_GET['section'] == 'association')
{
	include_once 'controller/association.php';
}
elseif ($_GET['section'] == '3FJT')
{
	include_once 'controller/3FJT.php';
}
elseif ($_GET['section'] == 'quiSommesNous')
{
	include_once 'controller/quiSommesNous.php';
}
elseif ($_GET['section'] == 'actualites')
{
	include_once 'controller/actualites.php';
}
elseif ($_GET['section'] == 'plateformeLogement' || ($_GET['section'] == 'plateformeLogement' && !empty($_GET['subSection'])))
{
	include_once 'controller/plateformeLogement.php';
}
elseif ($_GET['section'] == 'liensUtiles')
{
	include_once 'controller/liensUtiles.php';
}
elseif ($_GET['section'] == 'vieEnFoyer')
{
	include_once 'controller/vieEnFoyer.php';
}
elseif ($_GET['section'] == 'services')
{
	include_once 'controller/services.php';
}
elseif ($_GET['section'] == 'repas')
{
	include_once 'controller/repas.php';
}
elseif ($_GET['section'] == 'livreOr')
{
	include_once 'controller/livreOr.php';
}
elseif ($_GET['section'] == 'devenirResident')
{
	include_once 'controller/devenirResident.php';
}
elseif ($_GET['section'] == 'conditions')
{
	include_once 'controller/conditions.php';
}
elseif ($_GET['section'] == 'logements')
{
	include_once 'controller/logements.php';
}
elseif ($_GET['section'] == 'contact')
{
	include_once 'controller/contact.php';
}
elseif ($_GET['section'] == 'faq')
{
	include_once 'controller/faq.php';
}
elseif ($_GET['section'] == 'memento')
{
	include_once 'controller/memento.php';
}
elseif ($_GET['section'] == 'faireUnDon')
{
	include_once 'controller/faireUnDon.php';
}
elseif ($_GET['section'] == 'lostPassword')
{
	include_once 'controller/lostPassword.php';
}
//paramètres membres 
elseif ($_GET['section'] == 'parameters')
{
	include_once('controller/parameters.php');
}
elseif ($_GET['section'] == 'deleteAccount')
{
	include_once('controller/deleteAccount.php');
}
elseif ($_GET['section'] == 'findPassword')
{
	include_once('controller/findPassword.php');
}
?>