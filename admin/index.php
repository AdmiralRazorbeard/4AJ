<?php
session_start();
include_once('../request/connectionSQL.php');
$mysqli = connection();
$isSuperAdmin = false;
if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
//Redirige si pas super admin :
{
	$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
	$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
	$tmp 	= $tmp->fetch_object();
	if($tmp->isSuperAdmin == 1)
	{
		$isSuperAdmin = true;
	}
}
if(!$isSuperAdmin)
{
	header('location:../index.html');
}
else
{
	if (!isset($_GET['section']) OR $_GET['section'] == 'index')
	{
	    include_once('controller/index.php');
	}
}
?>