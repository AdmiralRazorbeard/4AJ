<?php
include_once 'request/fonction.php';
if(!isAdminFonction())
{
	header('location:../index.php');
}
$allFonction = allFonction();
if(!empty($_GET['type']) && !empty($_GET['id']) && is_numeric($_GET['id']) && is_numeric($_GET['type']))
{
	changerPouvoir($_GET['type'], $_GET['id']);
	header('location:index.php?section=fonction');
}
include_once 'view/fonction.php';
?>