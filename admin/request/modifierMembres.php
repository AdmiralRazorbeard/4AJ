<?php
/* ---------------
// Request de modifierMembres.php & modifierFonctionMembres.php
----------------*/

function isAdminMembres()
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

function formatDate($date)
// Formate la date retourner par sql en jj/mm/aaaa
{
	$date = explode('-', $date);
	return $date[2].'/'.$date[1].'/'.$date[0];
}
function infoMembres($id)
// Récupère toutes les infos du membre
{
	$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable, mail, isSuperAdmin FROM membre WHERE id='.$id); 
	$infoMembres = NULL;
	while($donnees = $tmp->fetch_object())
	{
		$infoMembres['id'] = $donnees->id;
		$infoMembres['nomMembre'] = $donnees->nomMembre; 
		$infoMembres['prenomMembre'] = $donnees->prenomMembre; 
		$infoMembres['adresse'] = $donnees->adresse; 
		$infoMembres['dateNaissance'] = formatDate($donnees->dateNaissance); 
		$infoMembres['telFixe'] = $donnees->telFixe; 
		$infoMembres['telPortable'] = $donnees->telPortable; 
		$infoMembres['mail'] = $donnees->mail; 
		$fonction = run('	SELECT id_fonction, nomFonctionFR 
							FROM fonction,membrefonction 
							WHERE fonction.id = membrefonction.id_fonction
							AND membrefonction.id = '.$id.'
							ORDER BY id_fonction DESC');
		while($temp = $fonction->fetch_object())
		{
			$infoMembres['fonction'][$temp->id_fonction]['id'] = $temp->id_fonction;
			$infoMembres['fonction'][$temp->id_fonction]['nom'] = $temp->nomFonctionFR;
		}
		$infoMembres['isSuperAdmin'] = $donnees->isSuperAdmin; 
	}
	return $infoMembres;
}

function FonctionNotMembre($id)
// Retourne toutes les fonctions dont le membre ne fait pas partie
{
	$fonction = NULL;
	$tmp = run('SELECT id, fonction.nomFonctionFR AS nom
				FROM fonction
				WHERE (
					fonction.id, fonction.nomFonctionFR
				) NOT IN (
				SELECT fonction.id AS id, fonction.nomFonctionFR AS nom
				FROM fonction, membrefonction
					WHERE fonction.id = membrefonction.id_fonction
				    AND membrefonction.id = '.$id.'
				)');
	while($donnees = $tmp->fetch_object())
	{
		$fonction[$donnees->id]['id'] = $donnees->id;
		$fonction[$donnees->id]['nom'] = $donnees->nom;
	}
	return $fonction;
}

function updateMembre($id, $nom, $prenom, $adresse, $dateNaissance, $telFixe, $telPortable, $isSuperAdmin, $password = '0')
{
	run('UPDATE membre SET nomMembre="'.$nom.'", prenomMembre="'.$prenom.'", adresse ="'.$adresse.'", dateNaissance="'.$dateNaissance.'", telFixe="'.$telFixe.'", telPortable="'.$telPortable.'", isSuperAdmin='.$isSuperAdmin.' WHERE id='.$id);
	if($password != 0)
	{
		run('UPDATE membre SET password="'.$password.'" WHERE id='.$id);
	}
}
?>