<?php
include_once 'request/modifierNews.php';
include_once '../textToolBox.php';
if(!isAdminActualite())
{
	header('location:index.php?section=error');
}
elseif(empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location:../index.php?section=actualites');
}
$infoNews = infoNews($_GET['id']);
if(empty($infoNews))
	// Vérifie que info n'est pas vide
	{ header('location:../index.php?section=actualites'); }

if(!empty($_POST['titre']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 254 && strlen($_POST['actualite']) <= 64000 && !ctype_space($_POST['titre']) && !ctype_space($_POST['actualite']))
	{
		$nomFichier = 1;
		if($_FILES['uploadFile']['error'] == 0)
		{
			if($_FILES['uploadFichier']['type'] == 'application/pdf')
			// Vérifie que c'est du pdf
			{
				// Remplace les espaces par des underscores
				$nomFichier = genererCle(10).preg_replace('# #', '_', $_FILES['uploadFile']['name']);
				$tmp = run('SELECT COUNT(*) as nbre FROM news WHERE fichierPDF="'.$nomFichier.'"')->fetch_object();
				while($tmp->nbre != 0)
				{	// Génère la clé, cette boucle permet d'éviter d'avoir des doublons du même nom de fichier
					$nomFichier = genererCle(10).preg_replace('# #', '_', $_FILES['uploadFile']['name']);
					$tmp = run('SELECT COUNT(*) as nbre FROM news WHERE fichierPDF="'.$nomFichier.'"')->fetch_object();
				}
				$resultat = move_uploaded_file($_FILES['uploadFile']['tmp_name'],'../fichierPDF/'.$nomFichier);
			}
		}
		elseif(!empty($_POST['deleteFile']))
		{
			// Si on souhaite supprimer la news, on passe le nomFichier à -1
			$nomFichier = -1;
		}
		updateNews($_GET['id'], $_POST['titre'], $_POST['actualite'], $nomFichier);
	}
}
$infoNews = infoNews($_GET['id']);
include_once 'view/modifierNews.php'
?>