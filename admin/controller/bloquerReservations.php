<?php
include_once 'request/gestionRepas.php';
if(!isAdminRepas())
{ header('location:index.php?section=error'); }
if(!empty($_POST['choix']))
{
	//Pour gerer le blocage temporaire des reservations
	$raison=NULL;
	if(!empty($_POST['raison']) && strlen($_POST['raison']) <= 254 && !ctype_space($_POST['raison']))
	{
		$raison = $mysqli->real_escape_string($_POST['raison']);
	}
	$choix = ($_POST['choix']);
	run('UPDATE bloquerreservations SET blocage='.$choix.', raison="'.$raison.'" WHERE id=1');
}
$tmp = run('SELECT blocage, raison FROM bloquerreservations WHERE id=1')->fetch_object();
$blocage = $tmp->blocage;
$raison = htmlspecialchars($tmp->raison);
include_once 'view/bloquerReservations.php';
?>