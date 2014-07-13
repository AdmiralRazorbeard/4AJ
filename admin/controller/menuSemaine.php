<?php
include_once 'request/menuSemaine.php';
if(!isAdminRepas())
{
	header('location:index.php');
}
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

cleanBDDSemaine();
if(!empty($_POST['semaine']))
	// Si l'utilisateur a choisi une variable ainsi qu'a mis un fichier
{
	if ($_FILES['weekFile']['error'] == 0)
	{
		if($_FILES['weekFile']['type'] == 'application/pdf')
		// Vérifie que c'est du pdf
		{


			// Upload le fichier dans fichierPDF/
			$tmp = explode('-', $_POST['semaine']);
			echo $tmp[1];
			if(!empty($tmp[0]) && is_numeric($tmp[0]) && $tmp[0] >= 0 && $tmp[0] <= 43 && !empty($tmp[1]) && is_numeric($tmp[1]) && $tmp[1] >= 2014 && $tmp[1] <= 2500)
			{
				$nomFichier = $tmp[1].'_'.$tmp[0];
				$nbre = run('SELECT COUNT(*) as nbre FROM menusemaine WHERE numeroSemaine = '.$tmp[0].' AND annee = '.$tmp[1])->fetch_object();
				while($nbre->nbre >= 1)
				{
					unlink('../fichierPDF/'.$nomFichier.'.pdf');
					run('DELETE FROM menusemaine WHERE numeroSemaine = '.$tmp[0].' AND annee='.$tmp[1]);
					$nbre = run('SELECT COUNT(*) as nbre FROM menusemaine WHERE numeroSemaine = '.$tmp[0].' AND annee = '.$tmp[1])->fetch_object();
				}
				$resultat = move_uploaded_file($_FILES['weekFile']['tmp_name'],'../fichierPDF/'.$nomFichier.'.pdf');
				run('INSERT INTO menusemaine(numeroSemaine, annee) VALUES('.$tmp[0].', '.$tmp[1].')');
			}
		
		}
	}
	########### FIN GESTION FICHIER ###########
}


include_once 'view/menuSemaine.php';
?>