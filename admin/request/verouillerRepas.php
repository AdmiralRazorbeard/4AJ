<?php
function isAdminRepas()
// Fonction pour savoir si le membre est admin des repas
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
						AND fonction.isAdminRepas = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si il a une des fonctions dont il fait parti qui est admin sur les repas
		{
			return true;
		}
	}
	return false;
}

function supprimerAnciensJoursBloques()
/* Supprime les jours verrouiller datant des semaines précédentes pour éviter de surcharger la bdd */
{
	$date = date('Y-m-d', strtotime('sunday last week'));
	run('DELETE FROM bloquerjourrepas WHERE dateBlocage<"'.$date.'"');
}

function semaine($nbreWeekPlus=0) 
// Retourne un tableau, du lundi au dimanche, contenant numéro, nom du mois, et année
{
	$semaine['lundi']['numero'] = date('d', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['mois'] = date('n', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['annee'] = date('Y', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['numero'] = date('d', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['mois'] = date('n', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['annee'] = date('Y', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['numero'] = date('d', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['mois'] = date('n', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['annee'] = date('Y', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['numero'] = date('d', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['mois'] = date('n', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['annee'] = date('Y', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['numero'] = date('d', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['mois'] = date('n', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['annee'] = date('Y', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['numero'] = date('d', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['mois'] = date('n', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['annee'] = date('Y', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['numero'] = date('d', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['mois'] = date('n', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['annee'] = date('Y', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	return $semaine;	
}

function boutonVerrouiller($jour, $mois, $annee, $midi, $residence)
/* Retourne true si le jour est verrouiller, false sinon */
{
	$date = $annee.'-'.$mois.'-'.$jour;
	$tmp = run('SELECT COUNT(*) as nbre FROM verrouillerjourrepas WHERE dateVerouiller = "'.$date.'" AND midi = '.$midi.' AND residence = '.$residence)->fetch_object();
	if($tmp->nbre >= 1)
	{
		return true;
	}
	return false;
}

function boutonBloquer($jour, $mois, $annee, $midi, $residence, $fonction)
/* Retourne true si le jour est verrouiller, false sinon */
{
	$date = $annee.'-'.$mois.'-'.$jour;
	$tmp = run('SELECT COUNT(*) as nbre FROM bloquerjourrepas WHERE fonction = "'.$fonction.'" AND dateBlocage = "'.$date.'" AND midi = '.$midi.' AND residence = '.$residence)->fetch_object();
	if($tmp->nbre >= 1)
	{
		return true;
	}
	return false;
}

function membreFonction()
{
	$tmp = run('SELECT id, nomFonctionFR as nom FROM fonction');
	while($donnees = $tmp->fetch_object())
	{
		$fonction[$donnees->id]['id'] = $donnees->id;
		$fonction[$donnees->id]['nom'] = htmlspecialchars($donnees->nom);
	}
	return $fonction;
}
?>