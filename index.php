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
		{ echo htmlspecialchars($EN); }
	else 
		{ echo htmlspecialchars($FR); }
}
####### FIN GESTION LANGUAGE #######


if (empty($_GET['section']))	
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
//section association
elseif ($_GET['section'] == 'association')
{
	include_once 'controller/association.php';
}
elseif ($_GET['section'] == 'quiSommesNous')
{
	include_once 'controller/quiSommesNous.php';
}
elseif ($_GET['section'] == 'plateformeLogement' || ($_GET['section'] == 'plateformeLogement' && !empty($_GET['subSection'])))
{
	include_once 'controller/plateformeLogement.php';
}
//section nos residence
elseif ($_GET['section'] == 'nosResidences')
{
	include_once 'controller/nosResidences.php';
}
elseif ($_GET['section'] == 'residenceAnneFrank')
{
	include_once 'controller/residenceAnneFrank.php';
}
elseif ($_GET['section'] == 'residenceClairLogis')
{
	include_once 'controller/residenceClairLogis.php';
}
elseif ($_GET['section'] == 'residenceNobel')
{
	include_once 'controller/residenceNobel.php';
}
//section restauration
elseif ($_GET['section'] == 'restauration')
{
	include_once 'controller/restauration.php';
}
elseif ($_GET['section'] == 'restaurationAjax')
{
	include_once 'controller/restaurationAjax.php';
}
//section services
elseif ($_GET['section'] == 'services')
{
	include_once 'controller/services.php';
}
//section contact
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
elseif ($_GET['section'] == 'liensUtiles')
{
	include_once 'controller/liensUtiles.php';
}
elseif ($_GET['section'] == 'livreOr')
{
	include_once 'controller/livreOr.php';
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