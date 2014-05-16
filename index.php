<?php
session_start();
include_once('request/connectionSQL.php');
$mysqli = connection();

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controller/index.php');
}
elseif ($_GET['section'] == 'connection')
{
	include_once 'controller/connection.php';
}
?>