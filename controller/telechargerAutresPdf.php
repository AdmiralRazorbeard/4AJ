<?php
if(file_exists('fichierPDF/'.$_GET['page'].'/'.$_GET['file'].'.pdf'))
{
	$file=$mysqli->real_escape_string($_GET['file']);
	$page=$mysqli->real_escape_string($_GET['page']);
	$tmp = run('SELECT tailleFichier FROM autresfichierspdf WHERE nomFichier = "'.$file.'" AND page = "'.$page.'"')->fetch_object();
	$taille= $tmp->tailleFichier;
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$file.'.pdf'); //Nom du fichier
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/'.$page.'/'.$file.'.pdf');
}
else
{
	header('location:index.php?section=index');
}
?>