<?php
include_once 'connection.php';
// Ajoute pour avoir la fonction isConnect()
include_once 'textToolBox.php';
// Ajoute pour la regexTextBox

 ## SYSTEME D'ACTUALITE ##
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
		// Ou si il a une des fonctions dont il fait parti qui est admin sur les actualités
		{
			return true;
		}
	}
	return false;
}

function listeActualite()
// Liste toutes les actualités (tout si admin, sinon seulement ce à quoi ta fonction t'autorise, sinon seulement le public)
{
	if(!empty($_SESSION['mail']))
	{
		$superAdmin = run('SELECT COUNT(*) as admin FROM membre WHERE mail="'.$_SESSION['mail'].'" AND isSuperAdmin = 1')->fetch_object();
		if($superAdmin->admin == 1)
		{	// Tout car superAdmin
			$actu = run('	SELECT DISTINCT news.id AS idNews,  news.titreNewsFR, news.contenuNewsFR, DATE_FORMAT(news.timestampNews, "%d/%m/%y") AS timestampNews
					 		FROM news 
					 		ORDER BY news.timestampNews DESC
							LIMIT 6');
		}
		else
		{	// seulement la fonction du membre
			$actu = run('	SELECT DISTINCT news.id AS idNews, news.titreNewsFR, news.contenuNewsFR, DATE_FORMAT(news.timestampNews, "%d/%m/%y") AS timestampNews
					 		FROM news,fonction,newsfonction,membre,membrefonction 
					 		WHERE news.id 	= newsfonction.id 
					 		AND fonction.id = newsfonction.id_fonction 
					 		AND membre.id 	= membrefonction.id 
					 		AND fonction.id = membrefonction.id_fonction
					 		AND membre.mail = "'.$_SESSION["mail"].'"
					 		ORDER BY news.timestampNews DESC
							LIMIT 6');
		}
	}
	else
	{	// Pour public
		$actu = run('	SELECT DISTINCT news.id AS idNews, news.titreNewsFR, news.contenuNewsFR, DATE_FORMAT(news.timestampNews, "%d/%m/%y") AS timestampNews
				 		FROM news,fonction,newsfonction
				 		WHERE news.id 	= newsfonction.id 
				 		AND fonction.id = newsfonction.id_fonction 
				 		AND newsfonction.id_fonction = 1
				 		ORDER BY news.timestampNews DESC
						LIMIT 6');		
	}
	while($tmp = $actu->fetch_object())
	{
		$liste[$tmp->idNews]['id'] = $tmp->idNews;
		$liste[$tmp->idNews]['titre'] = $tmp->titreNewsFR;
		$liste[$tmp->idNews]['contenu']	 = $tmp->contenuNewsFR;
		$liste[$tmp->idNews]['timestamp'] = $tmp->timestampNews;
	}
	if(!empty($liste))	
		// Ceci est pour s'assurer de ne rien retourner si il n'y a aucune liste.
	{
		return $liste;
	}
	else
	{ 
		// Ceci est pour contrer si il n'y a plus de news.
		return array();
	}
}
function deleteNews($id)
// Supprime la news ainsi que toute les Foreign Keys
{
	run('DELETE FROM newsfonction WHERE id='.$id);
	run('DELETE FROM news WHERE id='.$id);
}
?>