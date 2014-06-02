<?php
include_once 'request/repas.php';
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$semaine = semaine(0);
if(!empty($_GET['jour']) && is_numeric($_GET['jour']) && !empty($_GET['mois']) && is_numeric($_GET['mois']) && !empty($_GET['annee']) && is_numeric($_GET['annee']) && isset($_GET['midi']) && is_numeric($_GET['midi']))
	// Si l'utilisateur a saisi des variables
{
	if(boutonReserver($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi']))
		// Si il a l'autorisation de s'incrire
	{
		
	}
	else
	{
		$message = "Vous ne pouvez pas vous inscrire à cette date.";
	}
}


include_once 'view/vieEnFoyer/repas.php';

?>