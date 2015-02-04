<?php
function superAdmin()
// Fonction pour savoir si le membre est super admin (seul eux ont accès à la liste des membres)
{
	$mysqli = connection();
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$tmp 	= $tmp->fetch_object();
		if($tmp->isSuperAdmin == 1)
		// Si super admin, il a le pouvoir
		{
			return true;
		}
	}
	return false;
}

function getPdf($page)
//fonction qui permet de recuperer la liste des menus
{
	$tmp = run('SELECT nomFichier, page 
				FROM autresfichierspdf WHERE page = "'.$page.'"'); 
	$listePdf = NULL;
	if($tmp)
	{
		$i=0;
		while($donnees = $tmp->fetch_object())
		{
			$listePdf[$i]['nomFichier'] = $donnees->nomFichier;
			$listePdf[$i]['page'] = $donnees->page;
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