<?php
include_once 'request/viderReservations.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
$message=NULL;
if(isset($_GET['delete']) && $_GET['delete']=="true")
{
	supprimerAnciennesReservations();
	$message="Les anciens enregistrements ont bien été vidés";
}
include_once 'view/viderReservations.php';
?>