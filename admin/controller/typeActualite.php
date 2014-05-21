<?php
include_once 'request/typeActualite.php';
$admin = false;
if(isAdminActualite())
{ $admin = true; }
if(!$admin)
{	
	$_SESSION['message'] = 'Vous n\'êtes pas autorisé à accéder à cette partie du site.';
	header('location:../index.php');
}
if(!empty($_POST['delete']) && is_numeric($_POST['delete']))
{
	deleteTypeActualite($_POST['delete']);
}
if(!empty($_POST['add']) && $_POST['add'])
{
	$fonctionne = addTypeActualite($mysqli->real_escape_string($_POST['add']));
}
$typeActualite = allTypeActualite();
$tmp = run('SELECT id_Type_d_actualite FROM news WHERE id=2')->fetch_object();
include_once 'view/typeActualite.php';
?>