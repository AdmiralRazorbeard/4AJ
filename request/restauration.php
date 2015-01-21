<?php
function semaine($nbreWeekPlus=0) 
// Retourne un tableau, du lundi au dimanche, contenant numéro, nom du mois, et année
{
	$semaine['lundi']['numero'] = date('d', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['jourEN'] = date('l', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['mois'] = date('n', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['moisEN'] = date('F', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['annee'] = date('Y', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['lundi']['suffixe'] = date('S', strtotime('Monday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['numero'] = date('d', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['jourEN'] = date('l', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['mois'] = date('n', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['moisEN'] = date('F', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['annee'] = date('Y', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mardi']['suffixe'] = date('S', strtotime('Tuesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['numero'] = date('d', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['jourEN'] = date('l', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['mois'] = date('n', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['moisEN'] = date('F', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['annee'] = date('Y', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['mercredi']['suffixe'] = date('S', strtotime('Wednesday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['numero'] = date('d', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['jourEN'] = date('l', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['mois'] = date('n', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['moisEN'] = date('F', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['annee'] = date('Y', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['jeudi']['suffixe'] = date('S', strtotime('Thursday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['numero'] = date('d', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['jourEN'] = date('l', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['mois'] = date('n', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['moisEN'] = date('F', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['annee'] = date('Y', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['vendredi']['suffixe'] = date('S', strtotime('Friday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['numero'] = date('d', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['jourEN'] = date('l', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['mois'] = date('n', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['moisEN'] = date('F', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['annee'] = date('Y', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['samedi']['suffixe'] = date('S', strtotime('Saturday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['numero'] = date('d', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['jourEN'] = date('l', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['mois'] = date('n', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['moisEN'] = date('F', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['annee'] = date('Y', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	$semaine['dimanche']['suffixe'] = date('S', strtotime('Sunday this week', strtotime('+'.$nbreWeekPlus.' week')));
	return $semaine;	
}

function horaireLimite()
{
	// Retourne un tableau, de 2 dimension, la première étant midi ou soir, la seconde heure ou minute

	$tmp = run('SELECT midi, soir, jour FROM horairelimite WHERE id=1')->fetch_object();
	$midiTMP = $tmp->midi;
	$soirTMP = $tmp->soir;
	$jourTMP = $tmp->jour;
	$midi = array($midiTMP[0]*10 + $midiTMP[1], $midiTMP[3]*10 + $midiTMP[4]);
	$soir = array($soirTMP[0]*10 + $soirTMP[1], $soirTMP[3]*10 + $soirTMP[4]);
	return array($midi, $soir, $jourTMP);
}
function semaineEnPlus()
{
	$tmp = run('SELECT jour FROM horairelimite WHERE id=1')->fetch_object();
	$jourTMP = $tmp->jour;
	$semaineEnPlus = floor($jourTMP/7);
	return $semaineEnPlus;
}
function boutonReserver($numero, $mois, $annee, $midi, $residence)
	// Retourne 1 si il a le droit de s'incrire, 2 si il est déjà inscrit, et 3 sinon
	// midi = 1, soir = 0
{
	if(!empty($_SESSION['log']) && !empty($_SESSION['mail']))
	{
		$horaireLimite = horaireLimite();
		$heureMidi = $horaireLimite[0][0].':'.$horaireLimite[0][1];
		$heureSoir = $horaireLimite[1][0].':'.$horaireLimite[1][1];
		$jourEnPlus = $horaireLimite[2];

			// On ne peut plus s'inscrire à un repas pour le midi après l'heure choisi
		if(strtotime($numero.'-'.$mois.'-'.$annee.' '.$heureMidi) <= strtotime("now + ".(string)$jourEnPlus." days") && $midi)
		{
			return 3;
		}

			// On ne peut plus s'inscrire à un repas pour le soir après l'heure choisi
		if(strtotime($numero.'-'.$mois.'-'.$annee.' '.$heureSoir) <= strtotime("now + ".(string)$jourEnPlus." days") && !$midi)
		{
			return 3;
		}
		if(!$midi || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 6 || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 7)	// Si on est le soir ou le week end
			// Test si on est soit le soir, soit le week end, pour ensuite tester les autorisations
		{
			//si soir
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerSoir = 1')->fetch_object();
		}
		else
		{
			//si midi
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerMidi = 1')->fetch_object();
		}
		if($tmp->allowed >= 1)
		{
			// Vérification que le jour n'est pas verrouillé
			$tmp = run('SELECT COUNT(*) as nbre 	
						FROM verrouillerjourrepas 
						WHERE dateVerouiller="'.$annee.'-'.$mois.'-'.$numero.'" 
						AND midi = '.$midi.' 
						AND residence = '.$residence)->fetch_object();
			if($tmp->nbre == 0)
			{
				$tmp = run('SELECT COUNT(*) as inscrit
							FROM membre, reserverepas
							WHERE membre.id = reserverepas.id_membre
							AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
							AND midi = '.$midi.'
							AND residence = '.$residence.'
							AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
					// Vérifie que le membre ne s'est pas déjà inscrit
				if($tmp->inscrit == 0)
				{
					return 1;
				}
				else
				{
					return 2;
				}
			}
		}
		return 3;
	}
}

function accesRepas()
{
	if(!empty($_SESSION['mail']))
	{
		$mysqli = connection();
		$tmp = run('SELECT COUNT(*) as nbre 
					FROM fonction, membrefonction, membre
					WHERE fonction.id = membrefonction.id_fonction
					AND membre.id = membrefonction.id
					AND mail = "'.$mysqli->real_escape_string($_SESSION['mail']).'"
					AND ((
					    autorisationMangerMidi = 1 OR
					    autorisationMangerSoir = 1)
					OR isSuperAdmin=1)')->fetch_object();
		if($tmp->nbre >= 1)
		{
			return true;
		}
	}
	return false;
}

function blocageReservation()
{
	$tmp = run('SELECT blocage FROM bloquerreservations WHERE id=1')->fetch_object();
	$blocage = $tmp->blocage;
	if($blocage==1)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function raisonBlocage()
{
	$tmp = run('SELECT raison FROM bloquerreservations WHERE id=1')->fetch_object();
	$raison = htmlspecialchars($tmp->raison);
	return $raison;
}
?>
