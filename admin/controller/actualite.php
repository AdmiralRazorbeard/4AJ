<?php
include_once 'request/actualite.php';
include_once '../textToolBox.php';
$admin = false;
if(isAdminActualite())
{ $admin = true; }
if(!$admin)
{	
	header('location:index.php?section=error');
}
$allFonction = allFonction();
if(!empty($_POST['titre']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 254 && strlen($_POST['actualite']) <= 5000 && !ctype_space($_POST['titre']) && !ctype_space($_POST['actualite']))
	{
		$titre = $mysqli->real_escape_string($_POST['titre']);
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
			addActualite($titre, $contenu, $idMembre);
			$idLastNews = run('SELECT id FROM news ORDER BY id DESC LIMIT 0,1')->fetch_object();
			$idLastNews = $idLastNews->id;
			foreach ($allFonction as $key => $value) 
			{
				if(isset($_POST[$key]))
				{
					run('INSERT INTO newsfonction(id, id_fonction) VALUES ('.$idLastNews.', '.$key.')');
					//relier news aux fonctions
				}
			}
			envoieMail($idLastNews);
		}

	}
}

include_once 'view/actualite.php';
?>