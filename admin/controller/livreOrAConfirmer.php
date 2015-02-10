<?php
include_once 'request/livreOrAConfirmer.php';
if(!isAdminLivreOr())
{ 
	header('location:index.php?section=error'); 
}
if(!empty($_GET['confirm']) && is_numeric($_GET['confirm']))
{
	afficherLivreOr(intval($_GET['confirm']));
}
if(!empty($_GET['delete']) && is_numeric($_GET['delete']))
{
	deleteLivreOr(intval($_GET['delete']));
}
$allLivreOr = returnLivreOrAConfirmer();
$nbreLivreOrAConfirmer = nbreLivreOrAConfirmer();
include_once 'view/livreOrAConfirmer.php';
?>