<?php
include_once 'request/menuSemaine.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
//Extensions autorisées
$extensionsOk = 'pdf';
if(!empty($_POST['semaine']) && !empty($_POST['residenceChoisie']))
// Si l'utilisateur a choisi une variable ainsi qu'a mis un fichier
{
	if ($_FILES['weekFile']['error'] == 0 && $_FILES['weekFile']['size'] <= 5242880 && (substr(strrchr($_FILES['weekFile']['name'], '.'), 1) == $extensionsOk))
	{
		//On récupère l'extension d'une autre manière
		$extension_fichier = pathinfo($_FILES['weekFile']['name'], PATHINFO_EXTENSION);
		if($extension_fichier==$extensionsOk)
		{
			// Upload le fichier dans fichierPDF/
			$tmp = explode('-', $_POST['semaine']);
			// tmp[0] c'est les semaines et tmp[1] c'est l'année
			if(!empty($tmp[0]) && is_numeric($tmp[0]) && $tmp[0] >= 0 && $tmp[0] <= 53 && !empty($tmp[1]) && is_numeric($tmp[1]) && $tmp[1] >= 2015 && $tmp[1] <= 2500)
			{
				$nomFichier = $tmp[1].'_'.$tmp[0].'_'.$_POST['residenceChoisie'].'.'.$extension_fichier;
				$nbre = run('SELECT COUNT(*) as nbre FROM menusemaine WHERE semaine = '.$tmp[0].' AND annee = '.$tmp[1].' AND residence ='.$_POST['residenceChoisie'])->fetch_object();
				while($nbre->nbre >= 1)
				{
					unlink('../fichierPDF/'.$nomFichier);
					run('DELETE FROM menusemaine WHERE semaine = '.$tmp[0].' AND annee='.$tmp[1].' AND residence ='.$_POST['residenceChoisie']);
					$nbre = run('SELECT COUNT(*) as nbre FROM menusemaine WHERE semaine = '.$tmp[0].' AND annee = '.$tmp[1].' AND residence ='.$_POST['residenceChoisie'])->fetch_object();
				}
				//insertion du nouveau fichier
				$resultat = move_uploaded_file($_FILES['weekFile']['tmp_name'],'../fichierPDF/'.$nomFichier);
				run('INSERT INTO menusemaine(semaine, annee, residence, tailleFichier) VALUES('.$tmp[0].', '.$tmp[1].', '.$_POST['residenceChoisie'].', '.$_FILES['weekFile']['size'].')');
				//suppression des anciens fichiers
				$thisWeek = (int)date('W', strtotime('Monday this week'));
				$thisYear = (int)date('o', strtotime('Monday this week'));
				run('DELETE FROM menusemaine WHERE annee <'.$thisYear);
				run('DELETE FROM menusemaine WHERE annee ='.$thisYear.' AND semaine <'.$thisWeek);
			}
		}
	
	}
	########### FIN GESTION FICHIER ###########
}
if(!empty($_GET['delete'])){
	//si l'utilisateur supprime un menu
	$delete = $mysqli->real_escape_string($_GET['delete']);
	$tmp2 =explode('_', $delete);
	deleteMenu($tmp2);
}
//on récupère la liste des menus
$listeMenu = getMenu();
include_once 'view/menuSemaine.php';
?>