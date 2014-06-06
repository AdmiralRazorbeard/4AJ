<?php
// // // // // // //
// Ce controller permet de verifier si l'utilisateur possède au moins une fonction administrateur 
// // // // // // //
function isAdminSomewhere()
// Cette fonction détermine si l'utilisateur à des pouvoirs au niveau de la partie admin
{
	if(!empty($_SESSION['mail']))
	{
		$mysqli = connection();
		$mail = $mysqli->real_escape_string($_SESSION['mail']);
		$isSuperAdmin = run('SELECT isSuperAdmin FROM membre WHERE mail="'.$mail.'"')->fetch_object();
		if($isSuperAdmin->isSuperAdmin == 1)
			{ return true; }
		$tmp = run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id  
						AND membre.mail="'.$mail.'" 
						AND (isAdminLivreOr = 1 OR isAdminActualite=1)')->fetch_object();
		if($tmp->nbre >= 1)
		{
			return true;
		}
	}
	return false;
}