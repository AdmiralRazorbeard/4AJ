<?php
include_once 'request/modifierNews.php';
include_once '../textToolBox.php';
if(!isAdminActualite())
{
	$_SESSION['message'] = "Vous n'avez pas accès à cette page.";
	header('location:../index.php');
}
elseif(empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location:../index.php?section=actualites');
}
if(!empty($_POST['titre']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 4 && strlen($_POST['actualite']) <= 64000)
	{
		updateNews($_GET['id'], $_POST['titre'], $_POST['actualite']);
	}
}
$_GET['id'];
$infoNews = infoNews($_GET['id']);
if(empty($infoNews))
	// Vérifie que info n'est pas vide
	{ header('location:../index.php?section=actualites'); }

include_once 'view/modifierNews.php'
?>