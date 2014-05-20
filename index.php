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
?>