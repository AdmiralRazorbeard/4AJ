<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('../request/connectionSQL.php');
$mysqli = connection();
if (empty($_GET['section']))	
{
    header('location:index.php?section=main');
}
elseif ($_GET['section'] == 'main')
{
	include_once('controller/main.php');
}
elseif ($_GET['section'] == 'error')
{
	include_once('controller/error.php');
}
elseif ($_GET['section'] == 'actualite')
{
	include_once('controller/actualite.php');
}
elseif ($_GET['section'] == 'supprimerNews')
{
	include_once('controller/supprimerNews.php');
}
elseif ($_GET['section'] == 'modifierNews')
{
	include_once('controller/modifierNews.php');
}
elseif ($_GET['section'] == 'livreOrAConfirmer')
{
	include_once('controller/livreOrAConfirmer.php');
}
elseif ($_GET['section'] == 'gestionMembres')
{
	include_once('controller/gestionMembres.php');
}
elseif ($_GET['section'] == 'deleteMembres')
{
	include_once('controller/deleteMembres.php');
}
elseif ($_GET['section'] == 'modifierMembres')
{
	include_once('controller/modifierMembres.php');
}
elseif ($_GET['section'] == 'modifierFonctionMembres')
{
	include_once('controller/modifierFonctionMembres.php');
}
elseif ($_GET['section'] == 'fonction')
{
	include_once('controller/fonction.php');
}
elseif ($_GET['section'] == 'gestionRepas')
{
	include_once('controller/gestionRepas.php');
}
elseif ($_GET['section'] == 'verrouillerRepas')
{
	include_once('controller/verouillerRepas.php');
}
elseif ($_GET['section'] == 'formulaireContact')
{
	include_once('controller/formulaireContact.php');
}
elseif ($_GET['section'] == 'menuSemaine')
{
	include_once('controller/menuSemaine.php');
}
elseif ($_GET['section'] == 'horaireLimite')
{
	include_once('controller/horaireLimite.php');
}
?>