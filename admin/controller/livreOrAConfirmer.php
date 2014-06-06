<?php
include_once 'request/livreOrAConfirmer.php';
if(!isAdminLivreOr())
{ 
	$_SESSION['message'] = "Vous n'avez pas accès à cette partie du forum";
	header('location:index.php?section=main'); 
}
if(!empty($_GET['confirm']) && is_numeric($_GET['confirm']))
{
	afficherLivreOr($_GET['confirm']);
}
if(!empty($_GET['delete']) && is_numeric($_GET['delete']))
{
	deleteLivreOr($_GET['delete']);
}
$allLivreOr = returnLivreOrAConfirmer();
$nbreLivreOrAConfirmer = nbreLivreOrAConfirmer();
include_once 'view/livreOrAConfirmer.php';
?>