<?php
include_once 'request/gestionRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
#######################
	/*	Vérification pour changer de semaine, si on a changer de semaine, on redirige pour l'avoir en get */
if(!empty($_POST['semaineClairLogis']) && is_numeric($_POST['semaineClairLogis']))
{
	header('location:index.php?section=gestionRepas&semaineClairLogis='.$_POST['semaineClairLogis']);
}
if(!empty($_POST['semaineAnneFrank']) && is_numeric($_POST['semaineAnneFrank']))
{
	header('location:index.php?section=gestionRepas&semaineAnneFrank='.$_POST['semaineAnneFrank']);
}
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
	/* 	Fin vérification */
#######################
	/*	INITIALISATION VARIABLE */
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$semaineClairLogis = semaine($semaineDuClairLogis);
$semaineAnneFrank = semaine($semaineDuAnneFrank);
	/* Fin initialisation */
#######################
include_once 'view/gestionRepas.php';
?>