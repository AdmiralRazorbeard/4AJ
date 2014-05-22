<?php
include_once 'request/actualites.php';
$admin = false;
if(isAdminActualite())
{	$admin = true; }
$typeChoisi = 0;
if(!empty($_GET['typeActualite']) && is_numeric($_GET['typeActualite']))
{
	$typeChoisi = $_GET['typeActualite'];
	if($typeChoisi == 0.5)
	{
		$typeChoisi = 0;
	}
}
	// Changer le nombre de billet par page
if($admin && !empty($_POST['nbreBilletParPage']) && is_numeric($_POST['nbreBilletParPage']))
{
	newNombreBilletParPage(intval($_POST['nbreBilletParPage']));
}
	// Initialisation des actualités
$nbreBilletParPage = returnNombreBilletParPage();
$nbrePage = nbrePage($nbreBilletParPage, $typeChoisi);
if(!empty($_GET['page']) && is_numeric($_GET['page']) && intval($_GET['page']) == $_GET['page'] && $_GET['page'] >= 1 && $_GET['page'] <= $nbrePage)
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
$listeActualite = listeActualite($page, $nbreBilletParPage, $typeChoisi);
$listeTypeActualite = allTypeActualite();
	// Fin initialisation
include_once 'view/actualites/actualites.php';
?>