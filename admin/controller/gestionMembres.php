<?php
include_once 'request/gestionMembres.php';
if(!isAdminMembres())
//la fonction est identique à isSuperAdmin()
{
	header('location:index.php?section=error');
}
$orderBy="nomMembre";
$selected=1;
//selection par défaut
if(isset($_POST['orderBy'])){
//le résultat envoyé par la méthode post est "prioritaire" sur la méthode GET
	if ($_POST['orderBy'] == 1){
		$orderBy="nomMembre";
	}
	elseif ($_POST['orderBy'] == 2){
		$orderBy="prenomMembre";
	}
	else{
		$orderBy="id";
	}
}
if(isset($_GET['orderBy']) && !isset($_POST['orderBy']))
//permet de suivre le orderBy entre les differentes pages
{
	if 	($_GET['orderBy'] == 'nomMembre'){
		$orderBy="nomMembre";
	}
	elseif ($_GET['orderBy'] == 'prenomMembre'){
		$orderBy="prenomMembre";
	}
	else{
		$orderBy="id";
	}
}
if($orderBy=="nomMembre"){
//permet d'afficher l'element correspondant dans le select en html
	$selected=1;
}
elseif($orderBy=="prenomMembre"){
	$selected=2;
}
else{
	$selected=3;
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
$listeMembre = listeMembre($page, $nbreMembreParPage, $orderBy); 
include_once 'view/gestionMembres.php';
?>