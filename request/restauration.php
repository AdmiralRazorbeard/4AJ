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

{
	//Cette fonction a 5 possibilités de retour:
	//Retour 1: Correspond à la couleur verte claire CAD non-réservé
	//Retour 2: Correspond à la couleur orange claire CAD réservé
	//Retour 3: Correspond à la couleur grise CAD verrouillé
	//Retour 4: Correspond à la couleur verte foncé CAD non-réservé et bloqué
	//Retour 5: Correspond à la couleur orange foncé CAD réservé et bloqué
	if(!empty($_SESSION['log']) && !empty($_SESSION['mail'])){
		$horaireLimite = horaireLimite();
		$heureMidi = $horaireLimite[0][0].':'.$horaireLimite[0][1];
		$heureSoir = $horaireLimite[1][0].':'.$horaireLimite[1][1];
		$jourEnPlus = $horaireLimite[2];
		if(strtotime($numero.'-'.$mois.'-'.$annee.' '.$heureMidi) <= strtotime("now + ".(string)$jourEnPlus." days") && $midi){
		// Si on ne peut plus s'inscrire à un repas pour le midi car on se trouve avant la periode définie dans la partie administration
			$tmp = run('SELECT COUNT(*) as nbre 	
			FROM verrouillerjourrepas 
			WHERE dateVerouiller="'.$annee.'-'.$mois.'-'.$numero.'" 
			AND midi = '.$midi.' 
			AND residence = '.$residence)->fetch_object();
			# requete: Pour voir si la journée est verrouillée #
			$tmp2=1;
			if(date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 6 || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 7){

				$tmp2 = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
							WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
							AND membre.mail = "'.$_SESSION['mail'].'"
							AND autorisationMangerSoir = 1')->fetch_object(); #requete trompeuse car autorisationMangerSoir devrait plutot s'appeler autorisationMangerSoirOuWeekEnd
				# requete: Pour voir si on est autorisé à manger le midi (ici le week end)#
				$tmp2=$tmp2->allowed;
			}
			if($tmp->nbre != 0 || ($tmp2 != 1)){
			//Si le midi est verrouillée OU si on est pas autorisé à manger à midi (le Week end) alors on met la journée en gris
				return 3;
			}
			else{
			//Si non verrouillé et si autorisation à manger le midi le Week End
				$tmp3 = run('SELECT COUNT(*) as inscrit
				FROM membre, reserverepas
				WHERE membre.id = reserverepas.id_membre
				AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
				AND midi = '.$midi.'
				AND residence = '.$residence.'
				AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
				# requete: Si on avait réservé un repas ou non#
				if($tmp3->inscrit == 0){
				//Si non-reservé (et ici, bloqué en plus)
					return 4;
				}
				else{
				//Si reservé (et ici, bloqué en plus)
					return 5;
				}
			}
		}
		if(strtotime($numero.'-'.$mois.'-'.$annee.' '.$heureSoir) <= strtotime("now + ".(string)$jourEnPlus." days") && !$midi){
		// Si on ne peut plus s'inscrire à un repas pour le soir car on se trouve avant la periode définie dans la partie administration
			$tmp = run('SELECT COUNT(*) as nbre 	
			FROM verrouillerjourrepas 
			WHERE dateVerouiller="'.$annee.'-'.$mois.'-'.$numero.'" 
			AND midi = '.$midi.' 
			AND residence = '.$residence)->fetch_object();
			# requete: Pour voir si la journée est verrouillée #
			$tmp2 = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
			WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
			AND membre.mail = "'.$_SESSION['mail'].'"
			AND autorisationMangerSoir = 1')->fetch_object();#C'est le soir que l'on recherche ici, le week end n'a pas d'importance#
			# requete: Pour voir si on est autorisé à manger le soir#
			if(($tmp->nbre != 0) ||($tmp2->allowed != 1)){
			//Si le soir est verrouillée OU si on est pas autorisé à manger le soir alors on met la journée en gris
				return 3;
			}
			else{
			//Si non verrouillé et si autorisation à manger le soir
				$tmp3 = run('SELECT COUNT(*) as inscrit
				FROM membre, reserverepas
				WHERE membre.id = reserverepas.id_membre
				AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
				AND midi = '.$midi.'
				AND residence = '.$residence.'
				AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
				# requete: Si on avait réservé un repas ou non#
				if($tmp3->inscrit == 0){
				//Si non-reservé (et ici, bloqué en plus)
					return 4;
				}
				else{
				//Si reservé (et ici, bloqué en plus)
					return 5;
				}
				
			}
		}
		if(!$midi || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 6 || date('N', strtotime($numero.'-'.$mois.'-'.$annee)) == 7){
		//Si on est soit le soir, soit le week end, pour ensuite tester les autorisations
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerSoir = 1')->fetch_object();
			# requete: Pour voir si on est autorisé à manger le soir et week end#
		}
		else{
			//si midi
			$tmp = run('SELECT COUNT(*) as allowed FROM membre,membrefonction,fonction
						WHERE membre.id = membrefonction.id AND fonction.id = membrefonction.id_fonction
						AND membre.mail = "'.$_SESSION['mail'].'"
						AND autorisationMangerMidi = 1')->fetch_object();
			# requete: Pour voir si on est autorisé à manger le midi#
		}
		if($tmp->allowed >= 1){
		//Si autorisé à manger soir et week and/autorisé à manger midi
			$tmp = run('SELECT COUNT(*) as nbre 	
						FROM verrouillerjourrepas 
						WHERE dateVerouiller="'.$annee.'-'.$mois.'-'.$numero.'" 
						AND midi = '.$midi.' 
						AND residence = '.$residence)->fetch_object();
			# requete: Pour voir si la partie de la journée (midi ou soir) est verrouillée#
			if($tmp->nbre == 0){
			//Si non verrouillé on va regarder s'il est bloqué quelque part
				$tmp2 = run('SELECT COUNT(*) as blocked
							FROM bloquerjourrepas
							WHERE dateBlocage = "'.$annee.'-'.$mois.'-'.$numero.'"
							AND midi = '.$midi.'
							AND residence = '.$residence)->fetch_object();
				# requete: Pour voir si la partie de la journée (midi ou soir) est bloquée#
				if($tmp2->blocked == 0){
				//Si aucun blocage on regarde si la personne est inscrite ou non
					$tmp3 = run('SELECT COUNT(*) as inscrit
					FROM membre, reserverepas
					WHERE membre.id = reserverepas.id_membre
					AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
					AND midi = '.$midi.'
					AND residence = '.$residence.'
					AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
					# requete: Pour voir si la personne s'est inscrite#
					if($tmp3->inscrit == 0){
					//non-reservé
						return 1;
					}
					else{
					//reservé
						return 2;
					}
				}
				else{
				//S'il y a blocage, il faut regarder si c'est blocage correspondent bien aux fonctions du membre
					$listeFonctionMembre=NULL;
					//On recupère les fonctions du membre dans une variable qui s'appelle $listeFonctionMembre
					$tmpFonctionMembre = run('SELECT membrefonction.id_fonction AS fonction FROM membre, membrefonction
										    WHERE membre.id = membrefonction.id
										    AND membre.mail = "'.$_SESSION['mail'].'"');
					if($tmpFonctionMembre){
						$y=0;
						while($temp = $tmpFonctionMembre->fetch_object()) {
							$listeFonctionMembre[$y]['fonction'] = $temp->fonction;
							$y++;
						}
					}
					$z=0;
					//variable de test
					foreach($listeFonctionMembre as $key => $value) {
					//Si un blocage qui correspond à l'une des fonctions du membre alors on incrémente un compteur qui s'appelle z
						$tmp = run('SELECT COUNT(*) as blocked
									FROM membre, membrefonction, bloquerjourrepas
									WHERE membre.id = membrefonction.id AND membrefonction.id_fonction=bloquerjourrepas.fonction AND bloquerjourrepas.fonction='.$value['fonction'].'
									AND dateBlocage = "'.$annee.'-'.$mois.'-'.$numero.'"
									AND midi = '.$midi.'
									AND residence = '.$residence.'
									AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
						# requete: Pour voir si le blocage correspond bien aux fonctions du membre#
						$z+=($tmp->blocked);
					}
					if($z==0){
					//Si le blocage qui existe ne concerne finalement pas le membre alors on procède comme avant
						$tmp3 = run('SELECT COUNT(*) as inscrit
						FROM membre, reserverepas
						WHERE membre.id = reserverepas.id_membre
						AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
						AND midi = '.$midi.'
						AND residence = '.$residence.'
						AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
						# requete: Pour voir si le membre a reservé#
						if($tmp3->inscrit == 0){
						//non-reservé
							return 1;
						}
						else{
						//reservé
							return 2;
						}
					}
					else{
					//le blocage nous concerne
						$tmp3 = run('SELECT COUNT(*) as inscrit
						FROM membre, reserverepas
						WHERE membre.id = reserverepas.id_membre
						AND dateReserve = "'.$annee.'-'.$mois.'-'.$numero.'"
						AND midi = '.$midi.'
						AND residence = '.$residence.'
						AND membre.mail = "'.$_SESSION['mail'].'"')->fetch_object();
						# requete: Pour voir si le membre a reservé en sachant qu'il ne pourra plus par la suite réaliser d'action sur cette case du tableau#
						if($tmp3->inscrit == 0){
						//non-reservé et bloqué
							return 4;
						}
						else{
						//reservé et bloqué
							return 5;
						}
					}
				}
			}
		}
		//invalide
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
function menuExiste(Array $info, $residence)
{
	$tmp = run('SELECT COUNT(*) as nbre FROM menusemaine WHERE semaine = '.$info[0].' AND annee = '.$info[1].' AND residence ='.$residence)->fetch_object();
	if($tmp->nbre==0)
	{
		return NULL;
	}
	else
	{
		if($info[0]<10){
			return "&amp;file=".$info[1]."_0".$info[0]."_".$residence;
		}
		else{
			return "&amp;file=".$info[1]."_".$info[0]."_".$residence;
		}
	}
}
?>
