<?php
include_once 'request/actualite.php';
include_once '../textToolBox.php';
$admin = false;
if(isAdminActualite())
{ $admin = true; }
if(!$admin)
{	
	$_SESSION['message'] = 'Vous n\'êtes pas autorisé à accéder à cette partie du site.';
	header('location:../index.php');
}
$typeActualite = allTypeActualite();
$nbreTypeActualite = nombreTypeActualite();
$allFonction = allFonction();
if(!empty($_POST['titre']) && !empty($_POST['typeActualite']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 254 && strlen($_POST['actualite']) <= 64000)
	{
		$titre = $mysqli->real_escape_string($_POST['titre']);
		$idTypeActualite = $mysqli->real_escape_string($_POST['typeActualite']);
		$contenu = $mysqli->real_escape_string($_POST['actualite']);
		$idMembre = run('SELECT id FROM membre WHERE mail = "'.$mysqli->real_escape_string($_SESSION['mail']).'"')->fetch_object();
		$idMembre = $idMembre->id;
		// Est-ce que l'utilisateur a sélectionné une fonction :
		$issetFonctionChoisi = false;
		foreach ($allFonction as $key => $value) {
			if(isset($_POST[$key]))
			{
				$issetFonctionChoisi = true;
			}
		}
		if($issetFonctionChoisi)
		{
			addActualite($titre, $idTypeActualite, $contenu, $idMembre);
			$idLastNews = run('SELECT id FROM news ORDER BY id DESC LIMIT 0,1')->fetch_object();
			$idLastNews = $idLastNews->id;
			foreach ($allFonction as $key => $value) {
				if(isset($_POST[$key]))
				{
					run('INSERT INTO newsfonction(id, id_fonction) VALUES ('.$idLastNews.', '.$key.')');
				}
			}
		}
	}
}

include_once 'view/actualite.php';
?>