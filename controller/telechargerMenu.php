<?php
include_once 'request/telechargerMenu.php';
if(file_exists('fichierPDF/menu/'.$_GET['file'].'.pdf') && accesRepas())
//On ne peut télécharger le menu que si l'on est autorisé à reserver
{
	$name=NULL;
	$tmp = explode('_', $_GET['file']);
	if($tmp[2]==1){
		$name = "Menu_Anne_Frank_".$tmp[0]."_".$tmp[1];
	}
	else{
		$name = "Menu_Clair_Logis_".$tmp[0]."_".$tmp[1];
	}
	$tmp2 = run('SELECT tailleFichier FROM menusemaine WHERE semaine = '.$tmp[1].' AND annee = '.$tmp[0].' AND residence ='.$tmp[2])->fetch_object();
	$taille= $tmp2->tailleFichier;
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$name.'.pdf'); //Nom du fichier
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/menu/'.$_GET['file'].'.pdf');
}
else
{
	header('location:index.php?section=index');
}
?>