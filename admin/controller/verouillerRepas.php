<?php
include_once 'request/verouillerRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }

$semaineDuClairLogis = 0;
$semaineDuAnneFrank = 0;
$fonctionChoisieAnneFrank = 1;
$fonctionChoisieClairLogis = 1;
if(!empty($_GET['semaineClairLogis']) && is_numeric($_GET['semaineClairLogis']) && $_GET['semaineClairLogis'] >= 0)
//Si l'utilisateur change de semaine chez Clair Logis
{
	$semaineDuClairLogis = $_GET['semaineClairLogis'];
}
if(!empty($_GET['semaineAnneFrank']) && is_numeric($_GET['semaineAnneFrank']) && $_GET['semaineAnneFrank'] >= 0)
//Si l'utilisateur change de semaine chez Anne Frank
{
	$semaineDuAnneFrank = $_GET['semaineAnneFrank'];
}
if(!empty($_GET['fonctionAnneFrank']) && is_numeric($_GET['fonctionAnneFrank']) && $_GET['fonctionAnneFrank'] > 0)
{
	$fonctionChoisieAnneFrank = $_GET['fonctionAnneFrank'];
}
if(!empty($_GET['fonctionClairLogis']) && is_numeric($_GET['fonctionClairLogis']) && $_GET['fonctionClairLogis'] > 0)
{
	$fonctionChoisieAnneFrank = $_GET['fonctionClairLogis'];
}

if(!isset($_POST['jour']))
//Si on change de semaine ou que l'on rafraichi simplement la page alors on calcule ce qui permet de creer une nouvelle semaine
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineAnneFrank = semaine($semaineDuAnneFrank);
	$semaineClairLogis = semaine($semaineDuClairLogis);
}
if(!empty($_POST['jour']) && is_numeric($_POST['jour']) && !empty($_POST['mois']) && is_numeric($_POST['mois']) && !empty($_POST['annee']) && is_numeric($_POST['annee']) && isset($_POST['midi']) && is_numeric($_POST['midi']) && !empty($_POST['residence']) && is_numeric($_POST['residence']))
	// Si l'utilisateur a bien cliqué sur le bouton
{
	$date = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
	$midi = $_POST['midi'];
	$residence = $_POST['residence'];
	if(!isset($_POST['fonction']))
	//Si c'est une interdiction et non un verrouillage
	{
		if(boutonVerrouiller($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence']))
		{
			run('DELETE FROM verrouillerjourrepas WHERE dateVerouiller="'.$date.'" AND midi='.$midi.' AND residence='.$residence);
		}
		else
		{
			//on supprime d'abord tous les repas bloqués  pour ce moment car si les repas bloqués concernent seulement une fonction particulière, les repas verrouillés (ou interdits) s'adressent eux à tout le monde
			run('DELETE FROM bloquerjourrepas WHERE dateBlocage="'.$date.'" AND midi='.$midi.' AND residence='.$residence);
			run('INSERT INTO verrouillerjourrepas(dateVerouiller, midi, residence) VALUES("'.$date.'", '.$midi.', '.$residence.')');
		}
	}
	else
	{
	//Si c'est un blocage
		$fonction = $_POST['fonction']; 
		if(boutonBloquer($_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['midi'], $_POST['residence'], $_POST['fonction']))
		{
			run('DELETE FROM bloquerjourrepas WHERE dateBlocage="'.$date.'" AND midi='.$midi.' AND residence='.$residence.' AND fonction='.$fonction);
		}
		else
		{
			run('INSERT INTO bloquerjourrepas(dateBlocage, midi, residence, fonction) VALUES("'.$date.'", '.$midi.', '.$residence.', '.$fonction.')');
		}
	}
}

//permet ensuite de generer dans la vue les fonctions qui existent
$membreFonction = membreFonction();
if(!isset($_POST['jour']))
//le contenu n'est pas rafraichi si l'on clique sur les bouton pour verrouiller les jours, c'est jquery qui permet de gerer tout cela
{
	include_once 'view/verouillerRepas.php';
}
?>