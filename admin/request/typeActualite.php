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

function deleteTypeActualite($id)
// Supprime l'actualité
{
	if($id != 1)
	{
		$tmp = run('SELECT id FROM news WHERE id_Type_d_actualite = '.$id);
		while($donnees = $tmp->fetch_object())
		{
			run('UPDATE news SET id_Type_d_actualite = 1 WHERE id='.$donnees->id);
		}
		run('DELETE FROM type_d_actualite WHERE id='.$id);
	}
}

function addTypeActualite($nom)
{
	$count = run('SELECT COUNT(*) AS nbre FROM type_d_actualite WHERE nom = "'.$nom.'"')->fetch_object();
	$count = $count->nbre;
	if($count >= 1)
	{
		return false;
	}
	run('INSERT INTO type_d_actualite(`nom`) VALUES("'.$nom.'")');
	return true;
}
?>