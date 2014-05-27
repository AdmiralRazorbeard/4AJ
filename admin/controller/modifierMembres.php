<?php
include_once 'request/modifierMembres.php';
if(!isAdminMembres() || empty($_GET['modif']) || !is_numeric($_GET['modif']))
{
	header('location:index.php');
}

if(!empty($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
{
	$id = $_POST['id'];
	$nom = $mysqli->real_escape_string($_POST['nom']);
	$prenom = $mysqli->real_escape_string($_POST['prenom']);
	$adresse = '';
	$dateNaissance = '';
	$telFixe = '';
	$telPortable = '';
	$password = '0';
	$isSuperAdmin = '0';
	if(!empty($_POST['adresse']))
	{
		$adresse = $mysqli->real_escape_string($_POST['adresse']);
	}
	if(!empty($_POST['dateNaissance']))
	{
		$date = $mysqli->real_escape_string($_POST['dateNaissance']);
		$date = explode('/', $date);
		$dateNaissance = $date[2].'-'.$date[1].'-'.$date[0];
	}
	if(!empty($_POST['telFixe']))
	{
		$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
	}
	if(!empty($_POST['telPortable']))
	{
		$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
	}
	if(!empty($_POST['password']))
	{
		$password = md5($_POST['password']);
	}
	if(!empty($_POST['isSuperAdmin']))
	{
		$isSuperAdmin = '1';
	}
	updateMembre($id, $nom, $prenom, $adresse, $dateNaissance, $telFixe, $telPortable, $isSuperAdmin, $password);
}
$infoMembre = infoMembres($_GET['modif']);


include_once 'view/modifierMembres.php';
?>