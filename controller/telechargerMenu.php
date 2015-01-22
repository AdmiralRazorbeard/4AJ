<?php
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
	$tmp2 = run('SELECT tailleFichier FROM menusemaine WHERE semaine = '.$tmp[1].' AND annee = '.$tmp[0].' AND residence ='.$tmp[2])->fetch_object();
	$taille= $tmp2->tailleFichier;
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$name.'.pdf'); //Nom du fichier
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/'.$_GET['file'].'.pdf');
}
else
{
	header('location:index.php?section=restauration');
}
?>