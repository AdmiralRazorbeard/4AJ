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
$typeActualite = allTypeActualite();
$nbreTypeActualite = nombreTypeActualite();
$allFonction = allFonction();
if(!empty($_POST['titre']) && !empty($_POST['typeActualite']) && !empty($_POST['actualite']))
{
	if(strlen($_POST['titre']) <= 254 && strlen($_POST['actualite']) <= 64000 && !ctype_space($_POST['titre']) && !ctype_space($_POST['actualite']))
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
			########## GESTION FICHIER ##########
			$nomFichier = '';
			if ($_FILES['uploadFichier']['error'] == 0)
			{
				if($_FILES['uploadFichier']['type'] == 'application/pdf')
				// Vérifie que c'est du pdf
				{
					$nomFichier = genererCle(10).preg_replace('# #', '_', $_FILES['uploadFichier']['name']);
					$tmp = run('SELECT COUNT(*) as nbre FROM news WHERE fichierPDF="'.$nomFichier.'"')->fetch_object();
					while($tmp->nbre != 0)
					{
						$nomFichier = genererCle(10).preg_replace('# #', '_', $_FILES['uploadFichier']['name']);
						$tmp = run('SELECT COUNT(*) as nbre FROM news WHERE fichierPDF="'.$nomFichier.'"')->fetch_object();
					}
					$resultat = move_uploaded_file($_FILES['uploadFichier']['tmp_name'],'../fichierPDF/'.$nomFichier);
				}
			}
			########### FIN GESTION FICHIER ###########
			addActualite($titre, $idTypeActualite, $contenu, $idMembre, $mysqli->real_escape_string($nomFichier));
			$idLastNews = run('SELECT id FROM news ORDER BY id DESC LIMIT 0,1')->fetch_object();
			$idLastNews = $idLastNews->id;
			foreach ($allFonction as $key => $value) {
				if(isset($_POST[$key]))
				{
					run('INSERT INTO newsfonction(id, id_fonction) VALUES ('.$idLastNews.', '.$key.')');
				}
			}
			envoieMail($idLastNews);
		}

	}
}

include_once 'view/actualite.php';
?>