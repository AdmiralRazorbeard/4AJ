<?php
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

function changerHoraire($isMidi, $heure, $minute = 0)
{
	switch ($isMidi) {
		case 0:
			$champ = "soir";
			break;

		case 1:
			$champ = "midi";
			break;
		
		default:
			return;
	}
	$hour = intval($heure).':'.intval($minute);
	run('UPDATE horairelimite SET '.$champ.' = "'.$hour.'" WHERE id=1');
}
function reserverJourAvance($jourEnPlus)
//permet d'ajouter un certain nombre de jours où la reservation est impossible ce qui a pour consequence de rendre possible la reservation plus loin dans le calendrier
{
	run('UPDATE horairelimite SET jour = "'.$jourEnPlus.'" WHERE id=1');
}
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
?>