<?php
include_once 'request/modifierNews.php';
include_once '../textToolBox.php';
if(!isAdminActualite())
{
	header('location:index.php?section=error');
}
elseif(empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location:../index.php?section=actualites');
}
$infoNews = infoNews(intval($_GET['id']));
if(empty($infoNews))
	// Vérifie que info n'est pas vide
	{ header('location:../index.php?section=actualites'); }

if(!empty($_POST['titre']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 254 && strlen($_POST['actualite']) <= 5000 && !ctype_space($_POST['titre']) && !ctype_space($_POST['actualite']))
	{
		updateNews(intval($_GET['id']), $_POST['titre'], $_POST['actualite']);
	}
}
$infoNews = infoNews(intval($_GET['id']));
include_once 'view/modifierNews.php'
?>