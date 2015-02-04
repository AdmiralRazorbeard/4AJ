<?php
if(file_exists('fichierPDF/'.$_GET['page'].'/'.$_GET['file'].'.pdf'))
{
	$tmp = run('SELECT tailleFichier FROM autresfichierspdf WHERE nomFichier = "'.$_GET['file'].'" AND page = "'.$_GET['page'].'"')->fetch_object();
	$taille= $tmp->tailleFichier;
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$_GET['file'].'.pdf'); //Nom du fichier
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/'.$_GET['page'].'/'.$_GET['file'].'.pdf');
}
else
{
	header('location:index.php?section=index');
}
?>