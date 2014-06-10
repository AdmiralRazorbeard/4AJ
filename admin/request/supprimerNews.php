<?php
function isAdminActualite()
// Fonction pour savoir si le membre est admin d'actualite
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
		$tmp 	= run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id 
						AND mail = "'.$mail.'" 
						AND fonction.isAdminActualite = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si il a une des fonctions dont il fait parti qui est admin sur le livre d'or
		{
			return true;
		}
	}
	return false;
}

function deleteNews($id)
{
	// Test si il y a un pdf
	$isPDF = run('SELECT fichierPDF FROM news WHERE id='.$id)->fetch_object();
	if($isPDF->fichierPDF != '')
	{	
		// Supprime le pdf
		unlink('../fichierPDF/'.$isPDF->fichierPDF);
	}
	// Supprime la news ainsi que toute les Foreign Keys
	run('DELETE FROM newsfonction WHERE id='.$id);
	run('DELETE FROM news WHERE id='.$id);
}
?>