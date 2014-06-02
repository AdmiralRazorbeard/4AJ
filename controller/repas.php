<?php
include_once 'request/repas.php';
if(!empty($_POST['semaine']) && is_numeric($_POST['semaine']))
{
	header('location:index.php?section=repas&semaine='.$_POST['semaine']);
}
$semaineDu = 0;
if(!empty($_GET['semaine']) && is_numeric($_GET['semaine']) && $_GET['semaine'] >= 0)
{
	$semaineDu = $_GET['semaine'];
}
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$semaine = semaine($semaineDu);
if(!empty($_GET['jour']) && is_numeric($_GET['jour']) && !empty($_GET['mois']) && is_numeric($_GET['mois']) && !empty($_GET['annee']) && is_numeric($_GET['annee']) && isset($_GET['midi']) && is_numeric($_GET['midi']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_GET['annee'].'-'.$_GET['mois'].'-'.$_GET['jour'];
	if(boutonReserver($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi']) == 1)
		// Si il a l'autorisation de réserver, on réserve
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('INSERT INTO reserverepas(dateReserve, midi, id_membre) VALUES("'.$date.'", '.$_GET['midi'].', '.$id_membre->id.')');
		header('location:index.php?section=repas&semaine='.$semaineDu);
	}
	elseif(boutonReserver($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi']) == 2)
		// On a déjà reserver, on veut donc se annulé
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('DELETE FROM reserverepas WHERE dateReserve="'.$date.'" AND id_membre = '.$id_membre->id);
		header('location:index.php?section=repas&semaine='.$semaineDu);
	}
}


include_once 'view/vieEnFoyer/repas.php';

?>