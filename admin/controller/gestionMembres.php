<?php
include_once 'request/gestionMembres.php';
if(!isAdminMembres())
{
	$_SESSION['message'] = 'Vous n\'êtes pas autorisé à accéder à cette partie.';
	header('location:../index.php');
}
$nbreMembreParPage = 20;
$nbrePage = nbrePage($nbreMembreParPage);
if(!empty($_GET['page']) && is_numeric($_GET['page']) && intval($_GET['page']) == $_GET['page'] && $_GET['page'] >= 1 && $_GET['page'] <= $nbrePage)
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
$listeMembre = listeMembre($page, $nbreMembreParPage); 
include_once 'view/gestionMembres.php';
?>