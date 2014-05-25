<?php
include_once 'request/gestionMembres.php';
if(!isAdminMembres())
{
	$_SESSION['message'] = 'Vous n\'êtes pas autorisé à accéder à cette partie.';
	header('location:../index.php');
}
$listeMembre = listeMembre();

include_once 'view/gestionMembres.php';
?>