<?php
include_once 'request/actualite.php';
include_once '../textToolBox.php';
//Gestions des pdf (si superAdmin)
include_once 'request/gestionUploadActuPdf.php';
include_once 'controller/gestionUploadActuPdf.php';
$listePdf = getPdf("actualite");

$admin = false;
if(isAdminActualite())
{ $admin = true; }
if(!$admin)
{	
	header('location:index.php?section=error');
}
$allFonction = allFonction();
$message=NULL;
if(!empty($_POST['titre']) && !empty($_POST['actualite']) && !empty($_POST['destination']))
{
	if(strlen($_POST['titre']) <= 200 && strlen($_POST['actualite']) <= 20000 && !ctype_space($_POST['titre']) && !ctype_space($_POST['actualite']) && (intval($_POST['destination'])==$_POST['destination']))
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
			//On ajoute d'abord l'actualité
			addActualite($titre, $contenu, $idMembre);
			//On récupère l'id de la dernière actualité
			$idLastNews = run('SELECT id FROM news ORDER BY id DESC LIMIT 0,1')->fetch_object();
			$idLastNews = $idLastNews->id;
			foreach ($allFonction as $key => $value) 
			{
				if(isset($_POST[$key]))
				{
					//On relie les news aux fonctions
					run('INSERT INTO newsfonction(id, id_fonction) VALUES ('.$idLastNews.', '.$key.')');
				}
			}
			$message="Message envoyé";
			if($_POST['destination'] == 2)
			//On envoie un mail et on supprime la news
			{
				envoieMail($idLastNews);
				deleteNews($idLastNews);
			}
			if($_POST['destination'] == 3)
			//On envoie un mail si on l'a autorisé
			{
				envoieMail($idLastNews);
			}
		}
	}
}
include_once 'view/actualite.php';
?>