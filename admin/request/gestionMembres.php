<?php
// // // // // // //
// Ce controller correspond à gestionmembre, deleteMembre, et modifierMembre
// // // // // // //
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


function nbreMembres()
// Liste des membres
{
	$tmp = run('SELECT COUNT(*) as nbre FROM membre')->fetch_object();
	return $tmp->nbre;
}


function listeMembre()
{
	$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable, mail, isSuperAdmin FROM membre ORDER BY id DESC'); 
	$listeMembre = NULL;
	while($donnees = $tmp->fetch_object())
	{
		$listeMembre[$donnees->id]['id'] = $donnees->id;
		$listeMembre[$donnees->id]['nomMembre'] = $donnees->nomMembre; 
		$listeMembre[$donnees->id]['prenomMembre'] = $donnees->prenomMembre; 
		$listeMembre[$donnees->id]['adresse'] = $donnees->adresse; 
		$listeMembre[$donnees->id]['dateNaissance'] = $donnees->dateNaissance; 
		$listeMembre[$donnees->id]['telFixe'] = $donnees->telFixe; 
		$listeMembre[$donnees->id]['telPortable'] = $donnees->telPortable; 
		$listeMembre[$donnees->id]['mail'] = $donnees->mail; 
		$fonction = run('	SELECT id_fonction, nomFonctionFR 
							FROM fonction,membrefonction 
							WHERE fonction.id = membrefonction.id_fonction
							AND membrefonction.id = '.$donnees->id.'
							ORDER BY id_fonction DESC');
		while($temp = $fonction->fetch_object())
		{
			$listeMembre[$donnees->id]['fonction'][$temp->id_fonction]['id'] = $temp->id_fonction;
			$listeMembre[$donnees->id]['fonction'][$temp->id_fonction]['nom'] = $temp->nomFonctionFR;
		}
		$listeMembre[$donnees->id]['isSuperAdmin'] = $donnees->isSuperAdmin; 
	}
	return $listeMembre;
}

function supprimerMembre($id)
{
	run('DELETE FROM membrefonction WHERE id='.$id);
	run('UPDATE news SET id_membre=NULL WHERE id_membre='.$id);
	run('DELETE FROM membre WHERE id='.$id);
}
?>