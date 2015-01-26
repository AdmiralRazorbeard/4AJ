<?php
include_once 'request/restauration.php';
$_SESSION['backgroundBody']='#92a224';
include_once 'tinymcetxt.php';
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
	//Pour trouver le bon lien de menu à télécharger
	$weekAnneFrank = array((int)date('W', strtotime('Monday this week', strtotime('+'.$semaineDuAnneFrank.' week'))), (int)date('o', strtotime('Monday this week', strtotime('+'.$semaineDuAnneFrank.' week'))));
	$weekClairLogis = array((int)date('W', strtotime('Monday this week', strtotime('+'.$semaineDuClairLogis.' week'))), (int)date('o', strtotime('Monday this week', strtotime('+'.$semaineDuClairLogis.' week'))));
	$linkAnneFrank=menuExiste($weekAnneFrank, 1);
	$linkClairLogis=menuExiste($weekClairLogis, 2);
}
if(!empty($_POST['jour']) && is_numeric($_POST['jour']) && !empty($_POST['mois']) && is_numeric($_POST['mois']) && !empty($_POST['annee']) && is_numeric($_POST['annee']) && isset($_POST['midi']) && is_numeric($_POST['midi']) && !empty($_POST['residence']) && is_numeric($_POST['residence']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
	$residence = $_POST['residence'];
	if(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) == 1)
		// Si il a l'autorisation de réserver, on réserve
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('INSERT INTO reserverepas(dateReserve, midi, id_membre, residence) VALUES("'.$date.'", '.$_POST['midi'].', '.$id_membre->id.', '.$residence.')');
		//Les echos servent ici à retourner les data dans la fonction jquery
		echo 1;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) == 2)
		// On a déjà reserver, on veut donc se annulé
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('DELETE FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$_POST['midi'].' AND id_membre = '.$id_membre->id.' AND residence = '.$residence);
		echo 1;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) == 3)
		// si reservation invalide
	{
		echo 0;
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) >= 4)
		// si reservation block
	{
		break;
	}
}
if(!isset($_POST['jour']))
{
	include_once 'view/restauration/restauration.php';
}
?>