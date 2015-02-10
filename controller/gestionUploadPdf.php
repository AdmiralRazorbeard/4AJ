<?php
if(!empty($_SESSION['superAdminOn']) && superAdmin())
{
	//Extensions autorisées
	$extensionsOk = 'pdf';
	if(!empty($_GET['delete']) && !empty($_GET['section']))
	{
		//si l'utilisateur supprime un fichier pdf
		$nomFichier = preg_replace("/[^A-Z0-9_-]/i", "0", $mysqli->real_escape_string($_GET['delete']));
		$page = preg_replace("/[^A-Z0-9_-]/i", "0", $mysqli->real_escape_string($_GET['section']));
		deletePdf($nomFichier, $page);
	}
	if(!empty($_POST['page']) && !empty($_POST['nomFichier']) && strlen($_POST['nomFichier']) < 40 && !ctype_space($_POST['nomFichier']))
	// Si l'utilisateur a choisi une variable ainsi qu'a mis un fichier
	{
		if ($_FILES['fichier']['error'] == 0 && $_FILES['fichier']['size'] <= 5242880 && (substr(strrchr($_FILES['fichier']['name'], '.'), 1) == $extensionsOk))
		{
			//On récupère l'extension d'une autre manière
			$extension_fichier = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
			if($extension_fichier==$extensionsOk)
			{
				$nomFichier = preg_replace("/[^A-Z0-9_-]/i", "_", $_POST['nomFichier']);
				$nomFichierComplet = $nomFichier.'.'.$extension_fichier;
				$page=$mysqli->real_escape_string($_POST['page']);
				$nbre = run('SELECT COUNT(*) as nbre FROM autresfichierspdf WHERE page = "'.$page.'" AND nomFichier = "'.$nomFichier.'"')->fetch_object();
				while($nbre->nbre >= 1)
				{
					unlink('fichierPDF/'.$page.'/'.$nomFichier.'.pdf');
					run('DELETE FROM autresfichierspdf WHERE page = "'.$page.'" AND nomFichier = "'.$nomFichier.'"');
					$nbre = run('SELECT COUNT(*) as nbre FROM autresfichierspdf WHERE page = "'.$page.'" AND nomFichier = "'.$nomFichier.'"')->fetch_object();
				}
				//insertion du nouveau fichier
				$resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],'fichierPDF/'.$page.'/'.$nomFichier.'.pdf');
				run('INSERT INTO autresfichierspdf(nomFichier, page, tailleFichier) VALUES("'.$nomFichier.'", "'.$page.'" , '.$_FILES['fichier']['size'].')');
			}
		
		}
		########### FIN GESTION FICHIER ###########
	}
}
?>