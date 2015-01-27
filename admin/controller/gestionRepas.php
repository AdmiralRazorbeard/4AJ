<?php
include_once 'request/gestionRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
#######################
	/*	Vérification pour changer de semaine, si on a changer de semaine, on redirige pour l'avoir en get */
$semaineDuClairLogis = 0;
$semaineDuAnneFrank = 0;
//permet en fonction du nombre de jours avec lequel on doit reserver en avance de decaler l'affichage des semaine en conséquence
$semaineDePlus = semaineEnPlus();
if(isset($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']) && $_GET['semaineClairLogis'] >= 0)
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
	$semaineDuClairLogis -= $semaineDePlus;
}
if(isset($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']) && $_GET['semaineAnneFrank'] >= 0)
{
	$semaineDuAnneFrank = $_GET['semaineAnneFrank'];
	$semaineDuAnneFrank -= $semaineDePlus;
}
$semaineDuAnneFrank += $semaineDePlus;
$semaineDuClairLogis += $semaineDePlus;
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