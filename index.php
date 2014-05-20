<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('request/connectionSQL.php');
$mysqli = connection();

if (empty($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controller/index.php');
}
elseif ($_GET['section'] == 'connection')
{
	include_once 'controller/connection.php';
}
elseif ($_GET['section'] == 'inscription')
{
	include_once 'controller/inscription.php';
}
elseif ($_GET['section'] == 'livreor')
{
	include_once 'controller/livreOr.php';
}
elseif ($_GET['section'] == 'association')
{
	include_once 'controller/association.php';
}
elseif ($_GET['section'] == 'actualite')
{
	include_once 'controller/actualite.php';
}
elseif ($_GET['section'] == 'liensutiles')
{
	include_once 'controller/liensutiles.php';
}
elseif ($_GET['section'] == 'vieenfoyer')
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
elseif ($_GET['section'] == 'devenirrasident')
{
	include_once 'controller/devenirrasident.php';
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
elseif ($_GET['section'] == 'FAQ')
{
	include_once 'controller/faq.php';
}
elseif ($_GET['section'] == 'faireundon')
{
	include_once 'controller/faireundon.php';
}
?>