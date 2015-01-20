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
if(!empty($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']))
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
}
if(!empty($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']))
{
	$semaineDuAnneFrank = $_GET['semaineAnneFrank'];
}
	/* Fin vérification */
####################
	/* Initialisation variable */
if(!isset($_POST['jour']))
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineAnneFrank = semaine($semaineDuAnneFrank);
	$semaineClairLogis = semaine($semaineDuClairLogis);
}
$validChange=1;
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
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) == 2)
		// On a déjà reserver, on veut donc se annulé
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('DELETE FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$_POST['midi'].' AND id_membre = '.$id_membre->id.' AND residence = '.$residence);
	}
	elseif(boutonReserver($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $residence) == 3)
		// si reservation invalide
	{
		$validChange=0;
	}
}
if(!isset($_POST['jour']))
{
	include_once 'view/restauration/restauration.php';
}
?>