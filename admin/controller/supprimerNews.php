<?php
include_once 'request/supprimerNews.php';
if(!isAdminActualite())
{
	header('location:index.php?section=error');
}
else
{
	if(!empty($_GET['id']) && is_numeric($_GET['id']))
	{
		deleteNews(intval($_GET['id']));
	}
}
header('location:../index.php?section=index');

?>