<?php
function isAdminLivreOr()
// Fonction pour savoir si le membre est admin de livre d'or
{
	$mysqli = connection();
	$accessAllow = false;
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$tmp 	= $tmp->fetch_object();
		if($tmp->isSuperAdmin == 1)
		// Si admin, il a le pouvoir
		{
			return true;
		}
		$tmp 	= run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id 
						AND mail = "'.$mail.'" 
						AND fonction.isAdminLivreOr = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si une des fonctions dont il fait parti est: admin sur le livre d'or
		{
			return true;
		}
	}
	return $accessAllow;
}
function nbreLivreOrAConfirmer()
{
	$nbreLivreOr = run('SELECT COUNT(*) AS nbre FROM livreor WHERE afficher=0')->fetch_object();
	$nbreLivreOr = $nbreLivreOr->nbre;
	return $nbreLivreOr;
}
function returnLivreOrAConfirmer()
{
// Retourne un tableau contenant toutes les données du livre d'or
	$nbreLivreOr = run('SELECT COUNT(*) AS nbre FROM livreor WHERE afficher=0')->fetch_object();
	$nbreLivreOr = $nbreLivreOr->nbre;
	$livreOr = NULL;

	if($nbreLivreOr >= 1)
	// Vérifie qu'il y ai bien des entrées
	{
		$SQLLivreOr = run('	SELECT id,nom,mail,contenu, DATE_FORMAT(timestampLivreOr, "%d/%m/%y à %H:%i") AS timeLivreOr 
							FROM livreor
							WHERE afficher=0
							ORDER BY timestampLivreOr DESC');
		while($tmp = $SQLLivreOr->fetch_object())
		{
			$livreOr[$tmp->id]['id'] = $tmp->id;
			$livreOr[$tmp->id]['nom'] = htmlspecialchars($tmp->nom);
			$livreOr[$tmp->id]['mail'] = htmlspecialchars($tmp->mail);
			$livreOr[$tmp->id]['timeLivreOr'] = $tmp->timeLivreOr;
			$livreOr[$tmp->id]['contenu'] = nl2br(htmlspecialchars($tmp->contenu));
		}
	}
	return $livreOr;
}

function afficherLivreOr($id)
// Permet d'autoriser la visibilité du $id de livreOr
{
	run('UPDATE livreor SET afficher=1 WHERE id='.$id);
}

function deleteLivreOr($id)
// Supprime
{
	run('DELETE FROM livreor WHERE id = '.$id);
}
?>