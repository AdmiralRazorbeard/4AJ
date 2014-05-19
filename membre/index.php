<?php
session_start();
include_once('../request/connectionSQL.php');
$mysqli = connection();
$accessAllow = false;
if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
//Redirige si pas super admin ou si pas jeunes :
{
	$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
	$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
	$tmp 	= $tmp->fetch_object();
	if($tmp->isSuperAdmin == 1)
	{
		$accessAllow = true;
	}
	$tmp 	= run('	SELECT fonction.isAccesJeunes
					FROM membre,membrefonction,fonction 
					WHERE membre.id = membrefonction.id 
					AND membrefonction.id_fonction = fonction.id 
					AND mail = "'.$mail.'"
				');
	$tmp = $tmp->fetch_object();
	if($tmp->isAccesJeunes == 1)
	{
		$accessAllow = true;
	}
}
if(!$accessAllow)
{
	header('location:../index.php');
}
else
{
	if (!isset($_GET['section']) OR $_GET['section'] == 'index')
	{
	    include_once('controller/index.php');
	}
}
?>