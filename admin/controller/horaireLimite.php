<?php
include_once 'request/horaireLimite.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
if(isset($_POST['midiHeure']) 
	&& isset($_POST['midiMinute']) 
	&& (empty($_POST['midiHeure'])
		XOR (intval($_POST['midiHeure'])<=23 
		&& intval($_POST['midiHeure']) > 0))
	&& (empty($_POST['midiMinute']) 
		XOR (intval($_POST['midiMinute']) == 15 
			|| intval($_POST['midiMinute']) == 30 
			|| intval($_POST['midiMinute']) == 45)))
{
	changerHoraire(1, intval($_POST['midiHeure']), intval($_POST['midiMinute']));
}
if(isset($_POST['soirHeure']) 
	&& isset($_POST['soirMinute']) 
	&& (empty($_POST['soirHeure'])
		XOR (intval($_POST['soirHeure'])<=23 
		&& intval($_POST['soirHeure']) > 0))
	&& (empty($_POST['soirMinute']) 
		XOR (intval($_POST['soirMinute']) == 15 
			|| intval($_POST['soirMinute']) == 30 
			|| intval($_POST['soirMinute']) == 45)))
{
	changerHoraire(0, intval($_POST['soirHeure']), intval($_POST['soirMinute']));
}
if(isset($_POST['jourEnPlus']) && is_numeric($_POST['jourEnPlus']) && ($_POST['jourEnPlus']>=0) && ($_POST['jourEnPlus']<1000))
{
	reserverJourAvance(intval($_POST['jourEnPlus']));
} 
$horaireLimite = horaireLimite();


include_once 'view/horaireLimite.php';
?>