<?php
$file = preg_replace("/[^A-Z0-9_-]/i", "0", $mysqli->real_escape_string($_GET['file']));
$page = preg_replace("/[^A-Z0-9_-]/i", "0", $mysqli->real_escape_string($_GET['page']));
//Empeche l'utilisateur de pouvoir remonter l'arborescence des fichiers en modifiant l'adresse
if(file_exists('fichierPDF/'.$page.'/'.$file.'.pdf') && is_readable('fichierPDF/'.$page.'/'.$file.'.pdf'))
{
	$tmp = run('SELECT tailleFichier FROM autresfichierspdf WHERE nomFichier = "'.$file.'" AND page = "'.$page.'"')->fetch_object();
	$taille= $tmp->tailleFichier;
	//On s'occupe du compteur de téléchargements
	$tmp2 = run('SELECT telechargement FROM autresfichierspdf WHERE nomFichier = "'.$file.'" AND page = "'.$page.'"')->fetch_object();
	$tmp2 = $tmp2->telechargement;
	$tmp2 ++;
	run('UPDATE autresfichierspdf SET telechargement = '.$tmp2);
	//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	header('Content-Disposition: attachment; filename='.$file.'.pdf'); //Nom du fichier
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '.$taille); //Taille du fichier
	//Envoi du fichier dont le chemin est passé en paramètre
	readfile('fichierPDF/'.$page.'/'.$file.'.pdf');
}
else
{
	header('location:index.php?section=index');
}
?>