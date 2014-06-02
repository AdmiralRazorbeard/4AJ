<?php
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

function boutonReserver($numero, $mois, $annee, $midi)
	// Retourne true si il a le droit de s'incrire, false sinon
{
	if(empty($_SESSION['log']))
	{
		echo 'class="invalide" ';
		return; 
	}
	if(!empty($_SESSION['log']) && !empty($_SESSION['mail']))
	{
		if(!$midi || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 6 || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 7)	// Si on est le soir ou le week end
		{
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerSoir = 1')->fetch_object();
		}
		else
		{
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerMidi = 1')->fetch_object();
		}
		if($tmp->allowed >= 1)
		{
			$tmp = run('SELECT COUNT(*) as inscrit
						FROM membre, reserverepas
						WHERE membre.id = reserverepas.id_membre
						AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
						AND midi = '.$midi)->fetch_object();
				// Vérifie que le membre ne s'est pas déjà inscrit
			if($tmp->inscrit == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		echo $midi;
		return;
	}
}
?>