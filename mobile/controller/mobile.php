<?php
include_once '../request/restauration.php';
include_once('../controller/gds.php');
/*---------------------------------*/
/* PARTIE CONNEXION - DECONNEXION */
/*---------------------------------*/
/*IL faudra changer cet arrangement de fonctions*/
function countMembers($mail, $password)
//Retourne 1 si valide, 1.5 si seulement mail valide
{
	$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'"');
	$nbre = $nbre->fetch_object();
	if($nbre->nbre == 1)
	{
		$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'" AND password = "'.$password.'"');
		$nbre = $nbre->fetch_object();
		if($nbre->nbre == 1)
			return 1;
		else
			return 1.5;
	}
	return 0;
}
if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
// Pour se déconnecter
{
	if(!empty($_GET['dislog']) && $_GET['dislog'] == 'true')
	{	
		session_unset();
		session_destroy();
	} 
}

if(!empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['choixResidence']))	
//Connexion
{
	if(preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']) && (!(strlen($_POST['password']) <= 6) && !(strlen($_POST['password']) > 100) && !(ctype_space($_POST['password'])) ))
	{
		usleep(500000);
		//permet de faire une pause d'une demi seconde pour se proteger des attaques de type force brute
		$mail = $mysqli->real_escape_string($_POST['mail']);
		$choixResidence=(int)$mysqli->real_escape_string($_POST['choixResidence']); 
		$password = sha1($mysqli->real_escape_string($GDS.$_POST['password']));
		$nbreMembre = countMembers($mail, $password);	
		// Count membre retourne 1 si valide
		// 1,5 si le mail est valide mais pas le password
		if($nbreMembre == 1)
		{
			$_SESSION['log'] = 1;
			$_SESSION['mail'] = $mail;
			$_SESSION['residenceMobile'] = $choixResidence;
		}
	}
}
/*---------------------------------*/
/* PARTIE RESTAURATION MOBILE */
/*---------------------------------*/
$accessRepas = false;
$blocageReservation = false;
$raisonBlocage=NULL;
if(accesRepas())
{
	$accessRepas = true;
	if(blocageReservation())
	{
		$blocageReservation= true;
		$raisonBlocage=raisonBlocage();
	}
}
####################
	/* Vérification si on change de semaine */
$semaineDuClairLogis = 0;
$semaineDuAnneFrank = 0;
//permet en fonction du nombre de jours avec lequel on doit reserver en avance de decaler l'affichage des semaine en conséquence
$semaineDePlus = semaineEnPlus();
if(isset($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']))
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
	$semaineDuClairLogis -= $semaineDePlus;
}
if(isset($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']))
{
	$semaineDuAnneFrank = $_GET['semaineAnneFrank'];
	$semaineDuAnneFrank -= $semaineDePlus;
}
$semaineDuAnneFrank += $semaineDePlus;
$semaineDuClairLogis += $semaineDePlus;
	/* Fin vérification */
####################
	/* Initialisation variable */
if(!isset($_POST['jour']))
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineAnneFrank = semaine($semaineDuAnneFrank);
	$semaineClairLogis = semaine($semaineDuClairLogis);
}
if(!empty($_POST['jour']) && (intval($_POST['jour'])==$_POST['jour']) && !empty($_POST['mois']) && (intval($_POST['mois'])==$_POST['mois']) && !empty($_POST['annee']) && (intval($_POST['annee'])==$_POST['annee']) && isset($_POST['midi']) && is_numeric($_POST['midi']) && !empty($_POST['residence']) && (intval($_POST['residence'])==$_POST['residence']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
	if(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']) == 1)
		// Si il a l'autorisation de réserver, on réserve
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('INSERT INTO reserverepas(dateReserve, midi, id_membre, residence) VALUES("'.$date.'", '.$_POST['midi'].', '.$id_membre->id.', '.$_POST['residence'].')');
		//Les echos servent ici à retourner les data dans la fonction jquery
		echo 1;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']) == 2)
		// On a déjà reserver, on veut donc se annulé
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('DELETE FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$_POST['midi'].' AND id_membre = '.$id_membre->id.' AND residence = '.$_POST['residence']);
		echo 1;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']) == 3)
		// si reservation invalide
	{
		echo 0;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']) >= 4)
		// si reservation block
	{
		break;
	}
}
if(!isset($_POST['jour']))
{
	include_once 'view/mobile.php';
}
?>