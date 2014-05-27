<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('../request/connectionSQL.php');
$mysqli = connection();
if ($_GET['section'] == 'parameters')
{
	include_once('controller/parameters.php');
}
elseif ($_GET['section'] == 'deleteAccount')
{
	include_once('controller/deleteAccount.php');
}
?>
