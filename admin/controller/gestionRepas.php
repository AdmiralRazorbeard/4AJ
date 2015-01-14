<?php
include_once 'request/gestionRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
#######################
	/*	Vérification pour changer de semaine, si on a changer de semaine, on redirige pour l'avoir en get */
$semaineDuClairLogis = 0;
$semaineDuAnneFrank = 0;
if(!empty($_POST['semaineClairLogis']) && is_numeric($_POST['semaineClairLogis']) && $_POST['semaineClairLogis'] >= 0)
{
	$semaineDuClairLogis = $_POST['semaineClairLogis'];
}
if(!empty($_POST['semaineAnneFrank']) && is_numeric($_POST['semaineAnneFrank']) && $_POST['semaineAnneFrank'] >= 0)
{
	$semaineDuAnneFrank = $_POST['semaineAnneFrank'];
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