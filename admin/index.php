<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('../request/connectionSQL.php');
$mysqli = connection();
if (empty($_GET['section']) OR $_GET['section'] == 'index')
{
	include_once('controller/index.php');
}
elseif ($_GET['section'] == 'actualite')
{
	include_once('controller/actualite.php');
}
elseif ($_GET['section'] == 'typeActualite')
{
	include_once('controller/typeActualite.php');
}
elseif ($_GET['section'] == 'supprimerNews')
{
	include_once('controller/supprimerNews.php');
}
elseif ($_GET['section'] == 'modifierNews')
{
	include_once('controller/modifierNews.php');
}
?>