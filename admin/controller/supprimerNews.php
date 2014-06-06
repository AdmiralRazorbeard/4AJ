<?php
include_once 'request/supprimerNews.php';
if(!isAdminActualite())
{
	$_SESSION['message'] = 'Vous n\'êtes pas autorisé à accéder à cette partie du site.';
	header('location:index.php?section=main');
}
else
{
	if(!empty($_GET['id']) && is_numeric($_GET['id']))
	{
		deleteNews($_GET['id']);
	}
}
header('location:../index.php?section=actualites');

?>