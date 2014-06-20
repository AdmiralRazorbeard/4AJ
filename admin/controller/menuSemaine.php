<?php
include_once 'request/menuSemaine.php';
if(!isAdminRepas())
{
	header('location:index.php');
}
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

cleanBDDSemaine();
if(!empty($_POST['semaine']) && is_numeric($_POST['semaine']) && !empty($_POST['weekFile']) && is_numeric($_POST['weekFile']))
	// Si l'utilisateur a choisi une variable ainsi qu'a mis un fichier
{
	$weekNow = date('W');
	$jusque = $weekNow + 4;
	if($jusque >= 52)
		{ $jusque = $jusque - 52; }
	if(
		($weekNow < $jusque && $_POST['semaine'] >= $weekNow && $_POST['semaine'] <= $jusque) 
		|| 
		($weekNow > $jusque && (($_POST['semaine'] >= $weekNow && $_POST['semaine'] <= 52))
							|| (($_POST['semaine']) <= $jusque && $_POST['semaine'] > 0)))
	########## GESTION FICHIER ##########
	$nomFichier = '';
	$maxsize = 41943040;
	if ($_FILES['uploadFichier']['error'] == 0)
	{
		if($_FILES['uploadFichier']['type'] == 'application/pdf')
		// Vérifie que c'est du pdf
		{
			if ($_FILES['uploadFichier']['size'] <= $maxsize);
			{


				// Upload le fichier dans fichierPDF/
/*				$resultat = move_uploaded_file($_FILES['uploadFichier']['tmp_name'],'../fichierPDF/'.$nomFichier);*/
			}
		}
	}
	########### FIN GESTION FICHIER ###########
}


include_once 'view/menuSemaine.php';
?>