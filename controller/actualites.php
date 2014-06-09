<?php
include_once 'request/actualites.php';
include_once 'textToolBox.php';
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
	if($_POST['nbreBilletParPage']>=1 && $_POST['nbreBilletParPage']< 200)
	//une valeur négative fait crasher le site
	{
		newNombreBilletParPage(intval($_POST['nbreBilletParPage']));
	}

}

// Changer le nombre total d'acutalite
if($admin && !empty($_POST['nbreTotalActualite']) && is_numeric($_POST['nbreTotalActualite']))
{
	if($_POST['nbreTotalActualite']>=1 && $_POST['nbreBilletParPage']< 10000)
	{
		newNombreTotalActualite(intval($_POST['nbreTotalActualite']));
	}
}

// Initialisation des actualités
$nbreBilletParPage = returnNombreBilletParPage();
$nbreTotalActualite = returnNombreTotalActualite();
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