<?php
include_once 'request/actualites.php';
$admin = false;
if(isAdminActualite())
{	$admin = true; }
$typeChoisi = 0;
if(!empty($_POST['typeActualite']) && is_numeric($_POST['typeActualite']))
{
	$typeChoisi = $_POST['typeActualite'];
}
$listeActualite = listeActualite($typeChoisi);
$listeTypeActualite = allTypeActualite();
include_once 'view/actualites/actualites.php';
?>