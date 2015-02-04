<?php
include_once 'tinymcetxt.php';
$_SESSION['backgroundBody']='#4e0105';

function isAdminMembres()
// Fonction pour savoir si le membre est super admin (seul eux ont accès à la liste des membres)
{
	$mysqli = connection();
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$tmp 	= $tmp->fetch_object();
		if($tmp->isSuperAdmin == 1)
		// Si super admin, il a le pouvoir
		{
			return true;
		}
	}
	return false;
}

function getPdf()
//fonction qui permet de recuperer la liste des menus
{
	$tmp = run('SELECT nomFichier 
				FROM autresfichierspdf WHERE page = "nousSoutenir"'); 
	$listePdf = NULL;
	if($tmp)
	{
		$i=0;
		while($donnees = $tmp->fetch_object())
		{
			$listePdf[$i]['nomFichier'] = $donnees->nomFichier;
			$i++;
		}
	}
	return $listePdf;
}

function deletePdf($tmp)
//fonction qui permet de recuperer la liste des menus
{
	if(file_exists('fichierPDF/'.$tmp.'.pdf'))
	{
		unlink('fichierPDF/'.$tmp.'.pdf');
		run('DELETE FROM autresfichierspdf WHERE page = "nousSoutenir" AND nomFichier = "'.$tmp.'"');
	}
}


if(!empty($_SESSION['superAdminOn']) && isAdminMembres())
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	//Extensions autorisées
	$extensionsOk = 'pdf';
	if(!empty($_POST['nomFichier']) && strlen($_POST['nomFichier']) < 40 && !ctype_space($_POST['nomFichier']))
	// Si l'utilisateur a choisi une variable ainsi qu'a mis un fichier
	{
		if ($_FILES['fichierNousSoutenir']['error'] == 0 && $_FILES['fichierNousSoutenir']['size'] <= 5242880 && (substr(strrchr($_FILES['fichierNousSoutenir']['name'], '.'), 1) == $extensionsOk))
		{
			//On récupère l'extension d'une autre manière
			$extension_fichier = pathinfo($_FILES['fichierNousSoutenir']['name'], PATHINFO_EXTENSION);
			if($extension_fichier==$extensionsOk)
			{
				$nomFichier = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['nomFichier']);
				$nomFichierComplet = $nomFichier.'.'.$extension_fichier;
				$test="nousSoutenir";
				$nbre = run('SELECT COUNT(*) as nbre FROM autresfichierspdf WHERE page = "'.$test.'" AND nomFichier = "'.$nomFichier.'"')->fetch_object();
				while($nbre->nbre >= 1)
				{
					unlink('fichierPDF/'.$nomFichierComplet);
					run('DELETE FROM autresfichierspdf WHERE page = "nousSoutenir" AND nomFichier = "'.$nomFichier.'"');
					$nbre = run('SELECT COUNT(*) as nbre FROM autresfichierspdf WHERE page = "'.$test.'" AND nomFichier = "'.$nomFichier.'"')->fetch_object();
				}
				//insertion du nouveau fichier
				$resultat = move_uploaded_file($_FILES['fichierNousSoutenir']['tmp_name'],'fichierPDF/'.$nomFichierComplet);
				run('INSERT INTO autresfichierspdf(nomFichier, page, tailleFichier) VALUES("'.$nomFichier.'", "nousSoutenir" , '.$_FILES['fichierNousSoutenir']['size'].')');
			}
		
		}
		########### FIN GESTION FICHIER ###########
	}
	if(!empty($_GET['delete'])){
		//si l'utilisateur supprime un menu
		$delete = $mysqli->real_escape_string($_GET['delete']);
		deletePdf($delete);
	}
}
//on récupère la liste des menus
$listePdf = getPdf("nousSoutenir");
include_once '/view/contact/nousSoutenir.php';
?>