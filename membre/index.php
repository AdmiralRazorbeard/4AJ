<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('../request/connectionSQL.php');
$mysqli = connection();
if ($_GET['deleteAccount'] == 'true')
{
	include_once('controller/deleteAccount.php');
}
?>