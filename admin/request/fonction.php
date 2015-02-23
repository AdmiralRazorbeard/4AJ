<?php
function allFonction()
// Retourne toutes les fonctions
{
	$tmp = run('SELECT id, nomFonctionFR as nom, isAdminLivreOr, isAdminActualite, isAdminRepas, autorisationMangerMidi, autorisationMangerSoir FROM fonction');
	while($donnees = $tmp->fetch_object())
	{
		$fonction[$donnees->id]['id'] 						= $donnees->id;
		$fonction[$donnees->id]['nom'] 						= htmlspecialchars($donnees->nom);
		$fonction[$donnees->id]['isAdminLivreOr'] 			= $donnees->isAdminLivreOr;
		$fonction[$donnees->id]['isAdminActualite'] 		= $donnees->isAdminActualite;
		$fonction[$donnees->id]['isAdminRepas'] 			= $donnees->isAdminRepas;
		$fonction[$donnees->id]['autorisationMangerMidi'] 	= $donnees->autorisationMangerMidi;
		$fonction[$donnees->id]['autorisationMangerSoir'] 	= $donnees->autorisationMangerSoir;
	}
	return $fonction;
}

function isAdminFonction()
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

function changerPouvoir($type, $id)
{
	/* En fonction du pouvoir, inverse (true => false, false => true)*/
	switch ($type) {		
		case '2':
			$type = 'isAdminLivreOr';
			break;

		case '3':
			$type = 'isAdminActualite';
			break;

		case '4':
			$type = 'isAdminRepas';
			break;

		case '5':
			$type = 'autorisationMangerMidi';
			break;

		case '6':
			$type = 'autorisationMangerSoir';
			break;

		default:
			return;
			break;
	}
	$tmp = run('SELECT '.$type.' AS type FROM fonction WHERE id='.$id)->fetch_object();
	if($tmp->type == 0)
	{
		run('UPDATE fonction SET '.$type.' = 1 WHERE id='.$id);
	}
	else
	{
		run('UPDATE fonction SET '.$type.' = 0 WHERE id='.$id);
	}
}

function ajouterFonction($nom)
{
	run('INSERT INTO fonction(nomFonctionFR) VALUES("'.$nom.'")');
}

function supprimerFonction($id)
{
	run('DELETE FROM newsfonction WHERE id_fonction='.$id);
	run('DELETE FROM membrefonction WHERE id_fonction='.$id);
	run('DELETE FROM bloquerjourrepas WHERE fonction='.$id);
	run('DELETE FROM fonction WHERE id='.$id);
}

function allMembre($id, $membreParPage, $page)
// récupere les membres d'un fonction
{
	$limitMax = $membreParPage*$page;
	$limitMin = $limitMax-$membreParPage;
	$allMembre = NULL;
	$tmp = run('SELECT membre.id as id, nomMembre, prenomMembre, mail
				FROM membre,membrefonction 
				WHERE membre.id = membrefonction.id
				AND membrefonction.id_fonction='.$id.'
				ORDER BY membre.nomMembre
				LIMIT '.$limitMin.', '.$membreParPage);
	while($donnees = $tmp->fetch_object())
	{
		$allMembre[$donnees->id]['id'] = $donnees->id;
		$allMembre[$donnees->id]['nom'] = htmlspecialchars($donnees->nomMembre);
		$allMembre[$donnees->id]['prenom'] = htmlspecialchars($donnees->prenomMembre);
		$allMembre[$donnees->id]['mail'] = $donnees->mail;
	}
	return $allMembre;
}

function supprimerFonctionMembre($idMembre, $idFonction, $membreParPage, $page)
{
	run('DELETE FROM membrefonction WHERE id='.$idMembre.' AND id_fonction='.$idFonction);
}

function allMembreNotIn($idFonction, $membreParPage, $page)
{
	$limitMax = $membreParPage*$page;
	$limitMin = $limitMax-$membreParPage;
	$allMembreNotIn = NULL;
	$tmp = run('	SELECT membre.id as id, nomMembre, prenomMembre, mail FROM membre
					WHERE (id, nomMembre, prenomMembre)
					NOT IN (
					    SELECT membre.id, nomMembre, prenomMembre FROM membre,membrefonction
					    WHERE membre.id = membrefonction.id
					    AND membrefonction.id_fonction = '.$idFonction.' )
					ORDER BY membre.nomMembre 
					LIMIT '.$limitMin.', '.$membreParPage);
	while ($donnees = $tmp->fetch_object())
	{
		$allMembreNotIn[$donnees->id]['id'] = $donnees->id;
		$allMembreNotIn[$donnees->id]['nom'] = htmlspecialchars($donnees->nomMembre);
		$allMembreNotIn[$donnees->id]['prenom'] = htmlspecialchars($donnees->prenomMembre);
		$allMembreNotIn[$donnees->id]['mail'] = $donnees->mail;
	}
	return $allMembreNotIn;
}

function ajouterMembreAFonction($idMembre, $idFonction)
{
	run('INSERT INTO membrefonction(id,id_fonction) VALUES('.$idMembre.', '.$idFonction.')');
}

function nbrePage($in, $membreParPage, $fonction)
{
	if($in == 1)
	{
		$nbre = run('SELECT COUNT(*) as nbre
			FROM membre,membrefonction 
			WHERE membre.id = membrefonction.id
			AND membrefonction.id_fonction='.$fonction)->fetch_object();
		return ceil($nbre->nbre/$membreParPage);
	}
	else
	{
		$nbre = run('	SELECT COUNT(*) as nbre FROM membre
						WHERE (id, nomMembre)
						NOT IN (
					    	SELECT membre.id, nomMembre FROM membre,membrefonction
					   		WHERE membre.id = membrefonction.id
					    	AND membrefonction.id_fonction = '.$fonction.' )')->fetch_object();
		return ceil($nbre->nbre/$membreParPage);
	}
}
?>