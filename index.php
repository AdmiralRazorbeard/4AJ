<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('request/connectionSQL.php');
$mysqli = connection();

if (empty($_GET['section']))
{
    header('location:index.php?section=index');
}
elseif ($_GET['section'] == 'index')
{
	include_once 'controller/index.php';
}
elseif ($_GET['section'] == 'accueil')
{
	include_once 'controller/index.php';
}
elseif ($_GET['section'] == 'connection')
{
	include_once 'controller/connection.php';
}
elseif ($_GET['section'] == 'inscription')
{
	include_once 'controller/inscription.php';
}
elseif ($_GET['section'] == 'accueil')
{
	include_once 'controller/accueil.php';
}
elseif ($_GET['section'] == 'association')
{
	include_once 'controller/association.php';
}
elseif ($_GET['section'] == 'actualites')
{
	include_once 'controller/actualites.php';
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
elseif ($_GET['section'] == 'devenirResidant')
{
	include_once 'controller/devenirResidant.php';
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
?>