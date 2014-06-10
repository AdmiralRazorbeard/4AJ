<?php
include_once 'request/verouillerRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
####################
	/* CLEAN VERROUILLER REPAS */
cleanVerrouillerRepas();
	/* Vérification si on change de semaine */
if(!empty($_POST['semaineClairLogis']) && is_numeric($_POST['semaineClairLogis']))
{
	header('location:index.php?section=verrouillerRepas&semaineClairLogis='.$_POST['semaineClairLogis']);
}
if(!empty($_POST['semaineAnneFrank']) && is_numeric($_POST['semaineAnneFrank']))
{
	header('location:index.php?section=verrouillerRepas&semaineAnneFrank='.$_POST['semaineAnneFrank']);
}
if(!empty($_POST['semaineNobel']) && is_numeric($_POST['semaineNobel']))
{
	header('location:index.php?section=verrouillerRepas&semaineNobel='.$_POST['semaineNobel']);
}
$semaineDuClairLogis = 0;
$semaineDuNobel = 0;
$semaineDuAnneFrank = 0;
if(!empty($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']) && $_GET['semaineClairLogis'] >= 0)
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
}
if(!empty($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']) && $_GET['semaineAnneFrank'] >= 0)
{
	$semaineDuAnneFrank = $_GET['semaineAnneFrank'];
}
if(!empty($_GET['semaineNobel']) && is_numeric($_GET['semaineNobel']) && $_GET['semaineNobel'] >= 0)
{
	$semaineDuNobel = $_GET['semaineNobel'];
}
	/* Fin vérification */
####################
	/* Initialisation variable */
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$semaineAnneFrank = semaine($semaineDuAnneFrank);
$semaineClairLogis = semaine($semaineDuClairLogis);
$semaineNobel = semaine($semaineDuNobel);

if(!empty($_GET['jour']) && is_numeric($_GET['jour']) && !empty($_GET['mois']) && is_numeric($_GET['mois']) && !empty($_GET['annee']) && is_numeric($_GET['annee']) && isset($_GET['midi']) && is_numeric($_GET['midi']) && !empty($_GET['residence']) && is_numeric($_GET['residence']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_GET['annee'].'-'.$_GET['mois'].'-'.$_GET['jour'];
	$midi = $_GET['midi'];
	$residence = $_GET['residence'];
	if(boutonVerrouiller($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi'], $_GET['residence']))
	{
		run('DELETE FROM verrouillerjourrepas WHERE dateVerouiller="'.$date.'" AND midi='.$midi.' AND residence='.$residence);
		if($residence == 1)
		{
			header('location:index.php?section=verrouillerRepas&semaineAnneFrank='.$semaineDuAnneFrank);
		}
		elseif($residence == 2)
		{
			header('location:index.php?section=verrouillerRepas&semaineClairLogis='.$semaineDuClairLogis);
		}
	}
	else
	{
		run('INSERT INTO verrouillerjourrepas(dateVerouiller, midi, residence) VALUES("'.$date.'", '.$midi.', '.$residence.')');
		if($residence == 1)
		{
			header('location:index.php?section=verrouillerRepas&semaineAnneFrank='.$semaineDuAnneFrank);
		}
		elseif($residence == 2)
		{
			header('location:index.php?section=verrouillerRepas&semaineClairLogis='.$semaineDuClairLogis);
		}
	}
}
include_once 'view/verouillerRepas.php';
?>