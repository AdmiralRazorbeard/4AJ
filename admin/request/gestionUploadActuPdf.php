<?php
function getPdf($page)
//fonction qui permet de recuperer la liste des fichiersPDF
{
	$tmp = run('SELECT nomFichier, page, telechargement, protectHash
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
			$listePdf[$i]['protectHash'] = $donnees->protectHash;
			$i++;
		}
	}
	return $listePdf;
}

function deletePdf($nomFichier, $page)
//fonction qui permet de recuperer la liste des menus
{
	if(file_exists('../fichierPDF/'.$page.'/'.$nomFichier.'.pdf'))
	{
		unlink('../fichierPDF/'.$page.'/'.$nomFichier.'.pdf');
		run('DELETE FROM autresfichierspdf WHERE page = "'.$page.'" AND nomFichier = "'.$nomFichier.'"');
	}
}
function protectHash($nb_car, $chaine = 'AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn')
// Générer un mot de passe aléatoire.
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for($i=0; $i < $nb_car; $i++)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}
?>