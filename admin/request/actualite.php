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
function allTypeActualite()
// Retourne la liste de toutes les actualités
{
	$tmp = run('SELECT id, nom FROM type_d_actualite ORDER BY id');
	$typeActualite = NULL;
	while ($donnees = $tmp->fetch_object())
	{
		$typeActualite[$donnees->id]['id'] = $donnees->id;
		$typeActualite[$donnees->id]['nom'] = $donnees->nom;
	}
	return $typeActualite;
}
function nombreTypeActualite()
// Retourne le nombre d'actualité
{
	$tmp = run('SELECT COUNT(*) AS nbre FROM type_d_actualite')->fetch_object();
	$tmp = $tmp->nbre;
	return $tmp;
}

function allFonction()
// Retourne toutes les fonctions
{
	$tmp = run('SELECT id, nomFonctionFR as nom FROM fonction');
	while($donnees = $tmp->fetch_object())
	{
		$fonction[$donnees->id]['id'] = $donnees->id;
		$fonction[$donnees->id]['nom'] = $donnees->nom;
	}
	return $fonction;
}

function addActualite($titre, $typeActualite, $contenu, $idMembre)
// Ajoute une actualité
{
	run('INSERT INTO news(id_membre, titreNewsFR, contenuNewsFR, id_Type_d_actualite) VALUES ('.$idMembre.', "'.$titre.'", "'.$contenu.'", '.$typeActualite.')');
	verifNombreActualite();
}

function nbreActualite()
// Nombre total d'actualite
{
	$nbreActualite = run('SELECT COUNT(*) as nbre FROM news')->fetch_object();
	$nbreActualite = $nbreActualite->nbre;	
	return $nbreActualite;
}
function deleteNews($id)
{

	// Supprime la news ainsi que toute les Foreign Keys
	run('DELETE FROM newsfonction WHERE id='.$id);
	run('DELETE FROM news WHERE id='.$id);
}
function verifNombreActualite()
// Cela supprimer au fur et à mesure les anciennes news pour éviter de surcharger la base
{
	$nbreTotalAdmis = run('SELECT nombreTotalBilletActualite FROM infolivreoractualite')->fetch_object();
	$nbreTotalAdmis = $nbreTotalAdmis->nombreTotalBilletActualite;
	$nbreActualite = nbreActualite();
	while($nbreActualite > $nbreTotalAdmis)
	{
		$dernierIdActualite = run('SELECT id FROM news ORDER BY id LIMIT 0,1')->fetch_object();
		$dernierIdActualite = $dernierIdActualite->id;
		deleteNews($dernierIdActualite);
		$nbreActualite--;
	}
}

?>