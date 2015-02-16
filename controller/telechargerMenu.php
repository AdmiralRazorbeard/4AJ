<?php
include_once 'request/telechargerMenu.php';
$file = preg_replace("/[^A-Z0-9_-]/i", "0", $mysqli->real_escape_string($_GET['file']));
//Empeche l'utilisateur de pouvoir remonter l'arborescence des fichiers en modifiant l'adresse
if(file_exists('fichierPDF/menu/'.$file.'.pdf') && is_readable('fichierPDF/menu/'.$file.'.pdf'))
//On ne peut télécharger le menu que si l'on est autorisé à reserver
{
	$name=NULL;
	$tmp = explode('_', $file);
	if($tmp[2]==1){
		$name = "Menu_Anne_Frank_".$tmp[0]."_".$tmp[1];
	}
	else{
		$name = "Menu_Clair_Logis_".$tmp[0]."_".$tmp[1];
	}
	$tmp2 = run('SELECT tailleFichier FROM menusemaine WHERE semaine = '.$tmp[1].' AND annee = '.$tmp[0].' AND residence ='.$tmp[2])->fetch_object();
	$taille= $tmp2->tailleFichier;
	//On s'occupe du compteur de téléchargements
	$tmp3 = run('SELECT telechargement FROM menusemaine WHERE semaine = '.$tmp[1].' AND annee = '.$tmp[0].' AND residence ='.$tmp[2])->fetch_object();
	$tmp3 = $tmp3->telechargement;
	$tmp3 ++;
	run('UPDATE menusemaine SET telechargement = '.$tmp3);
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$name.'.pdf'); //Nom du fichier
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/menu/'.$file.'.pdf');
}
else
{
	header('location:index.php?section=index');
}
?>