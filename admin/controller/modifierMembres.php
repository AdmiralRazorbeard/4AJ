<?php
include_once 'request/modifierMembres.php';
include_once 'controller/gds.php';

if(!isAdminMembres() || empty($_GET['modif']) || !is_numeric($_GET['modif']))
{
	header('location:index.php?section=main');
}

if(!empty($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['nom']) && !ctype_space($_POST['nom']) && !empty($_POST['prenom']) && !ctype_space($_POST['prenom']))
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
	if(!empty($_POST['adresse']) && strlen($_POST['adresse']) <= 254 && !ctype_space($_POST['adresse']))
	{
		$adresse = $mysqli->real_escape_string($_POST['adresse']);
	}
	if(!empty($_POST['dateNaissance']) && preg_match('#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#', $_POST['dateNaissance']))
	{
		// Remplace les / en . pour correspondre au format français jj-mm-yyyy
		$date = preg_replace('#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#', '$1.$2.$3', $_POST['dateNaissance']);
		if(date('j.n.Y', strtotime($date)) == $date || date('d.m.Y', strtotime($date)) == $date || date('j.m.Y', strtotime($date)) == $date || date('d.n.Y', strtotime($date)) == $date)
		{

			$date = explode('.', $date);
			$dateNaissance = $date[2].'-'.$date[1].'-'.$date[0];
		}
	}
	if(!empty($_POST['telFixe']))
	{
		if(preg_match("#^[0-9]{10,11}$#", $_POST['telFixe']))
		{
			$telFixe = $mysqli->real_escape_string($_POST['telFixe']);
		}
	}
	if(!empty($_POST['telPortable']))
	{
		if(preg_match("#^[0-9]{10,11}$#", $_POST['telPortable']))
		{
			$telPortable = $mysqli->real_escape_string($_POST['telPortable']);
		}
	}
	if(!empty($_POST['password']) && !empty($_POST['password2']))
	{
		if((strlen($_POST['password']) >= 7 && strlen($_POST['password']) <= 100 && !ctype_space($_POST['password'])) && ($_POST['password'] == $_POST['password2']))
		{
			$password = sha1($mysqli->real_escape_string($GDS.$_POST['password']));
		}
		else
		{
			$message = "Erreur: Le mot de passe doit avoir plus de 6 caractères et/ou les deux mots de passe n'étaient pas identiques. \nLe mot de passe n'a donc pas été modifié.";
		}
	}
	if(!empty($_POST['isSuperAdmin']))
	{
		$isSuperAdmin = 1;
	}
	else {
		// Ceci permet de vérifier qu'il y aura toujours au moins un super admin dans la bdd
		// Tout d'abord il faut vérifier que le membre était super admin avant
		// Ensuite compter le nombre de super admin
		$tmp = run('SELECT isSuperAdmin FROM membre WHERE id='.$id)->fetch_object();
		if($tmp->isSuperAdmin == 1)
		{
			$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE isSuperAdmin=1')->fetch_object();
			if($nbre->nbre == 1)
			{
				$isSuperAdmin = 1;
				$message = 'Ce membre ne peut pas être rétrogradé tant qu\'il n\'y a pas un autre super administrateur';
			}
		}
	}
	updateMembre($id, $nom, $prenom, $adresse, $dateNaissance, $telFixe, $telPortable, $isSuperAdmin, $password);
}
$infoMembre = infoMembres($_GET['modif']);


include_once 'view/modifierMembres.php';
?>