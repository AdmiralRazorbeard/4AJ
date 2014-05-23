<?php
function addLivreOr($nom, $email, $contenu)
// Insertion dans le livre d'or
{
	run('INSERT INTO livreor(nom,mail,contenu) VALUES ("'.$nom.'", "'.$email.'", "'.$contenu.'")');
}
function nbrePage($nbreBilletParPage)
// Compte le nombre de page qu'il doit y avoir, le nombre passé en paramètre et le nombre de billet par page.
{
	$tmp = run('SELECT COUNT(*) as nbre FROM livreOr')->fetch_object();
	$tmp = $tmp->nbre;
	return ceil($tmp/$nbreBilletParPage);
}
function returnLivreOr($page, $nbreBilletParPage)
{
// Retourne un tableau contenant toutes les données du livre d'or
	$nbreLivreOr = run('SELECT COUNT(*) AS nbre FROM livreor')->fetch_object();
	$nbreLivreOr = $nbreLivreOr->nbre;
	$livreOr = NULL;

	// Si on est à la page n° $page, alors les entrés commence à partir de :
	$premierLivreorASortir = ($page-1)*$nbreBilletParPage;
	if($nbreLivreOr >= 1)
	// Vérifie qu'il y ai bien des entrées
	{
		$SQLLivreOr = run('SELECT id,nom,mail,contenu, DATE_FORMAT(timestampLivreOr, "%d/%m/%y à %H:%i") AS timeLivreOr FROM livreor ORDER BY timestampLivreOr DESC LIMIT '.$premierLivreorASortir.','.$nbreBilletParPage);
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
function deleteLivreOr($id)
{
	//verification si l'element existe
	$tmp = run('SELECT COUNT(*) AS nbre FROM livreor WHERE id='.$id)->fetch_object();
	$tmp = $tmp->nbre;
	if($tmp == 1)
	{
		run('DELETE FROM livreor WHERE id='.$id);
	}
}
function returnNombreBilletParPage()
{
	$tmp = run('SELECT nombreBilletLivreOrParPage FROM infolivreoractualite WHERE id=1')->fetch_object();
	$tmp = $tmp->nombreBilletLivreOrParPage;
	return $tmp;
}

function newNombreBilletParPage($nombreBilletParPage)
{
	run ('UPDATE infolivreoractualite SET nombreBilletLivreOrParPage = '.$nombreBilletParPage.' WHERE id=1');
}
?>