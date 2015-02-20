<?php
function getPdf($page)
//fonction qui permet de recuperer la liste des fichiersPDF
{
	$tmp = run('SELECT nomFichier, page, telechargement 
				FROM autresfichierspdf WHERE page = "'.$page.'"'); 
	$listePdf = NULL;
	if($tmp)
	{
		$i=0;
		while($donnees = $tmp->fetch_object())
		{
			$listePdf[$i]['nomFichier'] = $donnees->nomFichier;
			$listePdf[$i]['page'] = $donnees->page;
			$listePdf[$i]['telechargement'] = $donnees->telechargement;
			$i++;
		}
	}
	return $listePdf;
}

function deletePdf($nomFichier, $page)
//fonction qui permet de recuperer la liste des menus
{
	if(file_exists('fichierPDF/'.$page.'/'.$nomFichier.'.pdf'))
	{
		unlink('fichierPDF/'.$page.'/'.$nomFichier.'.pdf');
		run('DELETE FROM autresfichierspdf WHERE page = "'.$page.'" AND nomFichier = "'.$nomFichier.'"');
	}
}
?>