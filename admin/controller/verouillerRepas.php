<?php
include_once 'request/verouillerRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
####################
	/* CLEAN VERROUILLER REPAS */
//cleanVerrouillerRepas();
	/* Vérification si on change de semaine */
$semaineDuClairLogis = 0;
$semaineDuAnneFrank = 0;
if(!empty($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']) && $_GET['semaineClairLogis'] >= 0)
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
}
if(!empty($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']) && $_GET['semaineAnneFrank'] >= 0)
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
if(!empty($_POST['jour']) && is_numeric($_POST['jour']) && !empty($_POST['mois']) && is_numeric($_POST['mois']) && !empty($_POST['annee']) && is_numeric($_POST['annee']) && isset($_POST['midi']) && is_numeric($_POST['midi']) && !empty($_POST['residence']) && is_numeric($_POST['residence']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
	$midi = $_POST['midi'];
	$residence = $_POST['residence'];
	if(boutonVerrouiller($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']))
	{
		run('DELETE FROM verrouillerjourrepas WHERE dateVerouiller="'.$date.'" AND midi='.$midi.' AND residence='.$residence);
	}
	else
	{
		run('INSERT INTO verrouillerjourrepas(dateVerouiller, midi, residence) VALUES("'.$date.'", '.$midi.', '.$residence.')');
	}
}
if(!isset($_POST['jour']))
{
	include_once 'view/verouillerRepas.php';
}
?>