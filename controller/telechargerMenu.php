<?php
/*Après avoir vérifié que le fichier existe (l'id est bien dans la BDD) et
après avoir sélectionné les informations sur le fichier dans la BDD (dans $bdd_infos) */
if(file_exists('fichierPDF/'.$_GET['file'].'.pdf'))
{
	$name=NULL;
	$tmp = explode('_', $_GET['file']);
	if($tmp[2]==1){
		$name = "Menu_Anne_Frank_".$tmp[0]."_".$tmp[1];
	}
	else{
		$name = "Menu_Clair_Logis_".$tmp[0]."_".$tmp[1];
	}
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$name.'.pdf'); //Nom du fichier
	//header('Content-Length: 1000'); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/'.$_GET['file'].'.pdf');
}
else
{
	header('location:index.php?section=restauration');
}
?>