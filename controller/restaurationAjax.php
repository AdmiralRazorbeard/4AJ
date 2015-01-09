<?php
include_once 'request/restauration.php';
$_SESSION['backgroundBody']='#92a224';
include_once 'tinymcetxt.php';
$accessRepas = false;
if(accesRepas())
{
	$accessRepas = true;
}
####################
	/* Vérification si on change de semaine */
if(!empty($_POST['semaineClairLogis']) && is_numeric($_POST['semaineClairLogis']))
{
	header('location:index.php?section=restauration&semaineClairLogis='.$_POST['semaineClairLogis']);
}
if(!empty($_POST['semaineAnneFrank']) && is_numeric($_POST['semaineAnneFrank']))
{
	header('location:index.php?section=restauration&semaineAnneFrank='.$_POST['semaineAnneFrank']);
}
if(!empty($_POST['semaineNobel']) && is_numeric($_POST['semaineNobel']))
{
	header('location:index.php?section=restauration&semaineNobel='.$_POST['semaineNobel']);
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
	/* Fin vérification */
####################
	/* Initialisation variable */
$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$semaineAnneFrank = semaine($semaineDuAnneFrank);
$semaineClairLogis = semaine($semaineDuClairLogis);

if(!empty($_GET['jour']) && is_numeric($_GET['jour']) && !empty($_GET['mois']) && is_numeric($_GET['mois']) && !empty($_GET['annee']) && is_numeric($_GET['annee']) && isset($_GET['midi']) && is_numeric($_GET['midi']) && !empty($_GET['residence']) && is_numeric($_GET['residence']))
	// Si l'utilisateur a saisi des variables
{
	$date = $_GET['annee'].'-'.$_GET['mois'].'-'.$_GET['jour'];
	$residence = $_GET['residence'];
	if(boutonReserver($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi'], $residence) == 1)
		// Si il a l'autorisation de réserver, on réserve
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('INSERT INTO reserverepas(dateReserve, midi, id_membre, residence) VALUES("'.$date.'", '.$_GET['midi'].', '.$id_membre->id.', '.$residence.')');
		if($residence == 1)
		{ ?>
		<script type="text/javascript">
			$(function() {
			$('#repasAnneFrank').load('index.php?section=restaurationAjax&semaineAnneFrank=<?php echo $semaineDuAnneFrank; ?>#repasAnneFrank #partie1');							         
			});
		</script>
		<?php }
		elseif($residence == 2)
		{ ?>
		<script type="text/javascript">
			$(function() {
			$('#repasClairLogis').load('index.php?section=restaurationAjax&semaineClairLogis=<?php echo $semaineDuClairLogis; ?>#repasAnneFrank #partie2');							         
			});
		</script>
		<?php }
	}
	elseif(boutonReserver($_GET['jour'], $_GET['mois'], $_GET['annee'], $_GET['midi'], $residence) == 2)
		// On a déjà reserver, on veut donc se annulé
	{
		$id_membre = run('SELECT id FROM membre WHERE mail="'.$_SESSION['mail'].'"')->fetch_object();
		run('DELETE FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$_GET['midi'].' AND id_membre = '.$id_membre->id.' AND residence = '.$residence);
		if($residence == 1)
		{ ?>
		<script type="text/javascript">
			$(function() {
			$('#repasAnneFrank').load('index.php?section=restaurationAjax&semaineAnneFrank=<?php echo $semaineDuAnneFrank; ?>#repasAnneFrank #partie1');							         
			});
		</script>
		<?php }
		elseif($residence == 2)
		{ ?>
		<script type="text/javascript">
			$(function() {
			$('#repasClairLogis').load('index.php?section=restaurationAjax&semaineClairLogis=<?php echo $semaineDuClairLogis; ?>#repasAnneFrank #partie2');							         
			});
		</script>
		<?php }
	}
}
include_once 'view/restauration/restaurationAjax.php';
?>