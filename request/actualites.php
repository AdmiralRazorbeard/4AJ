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
function listeActualite()
{
	 $actu = run('	SELECT news.id AS idNews, news.titreNewsFR, news.contenuNewsFR, news.id_Type_d_actualite, news.timestampNews 
			 		FROM news,fonction,newsfonction,membre,membrefonction 
			 		WHERE news.id 	= newsfonction.id 
			 		AND fonction.id = newsfonction.id_fonction 
			 		AND membre.id 	= membrefonction.id 
			 		AND fonction.id = membrefonction.id_fonction
			 		AND membre.mail = "'.$_SESSION["mail"].'"');
	 while($tmp = $actu->fetch_object())
	 {
	 	$liste[$tmp->idNews]['id'] = $tmp->idNews;
		$liste[$tmp->idNews]['titre'] = $tmp->titreNewsFR;
		$liste[$tmp->idNews]['contenu']	 = $tmp->contenuNewsFR;
		$liste[$tmp->idNews]['id_Type_d_actualite']	= $tmp->id_Type_d_actualite;
		$liste[$tmp->idNews]['timestamp'] = $tmp->timestampNews;
	 }
	 return $liste;
}

?>