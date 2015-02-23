<?php
function isAdminRepas()
// Fonction pour savoir si le membre est admin des repas
{
	$mysqli = connection();
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$tmp 	= $tmp->fetch_object();
		if($tmp->isSuperAdmin == 1)
		// Si super admin, il a le pouvoir
		{
			return true;
		}
		$tmp 	= run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id 
						AND mail = "'.$mail.'" 
						AND fonction.isAdminRepas = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si il a une des fonctions dont il fait parti qui est admin sur les repas
		{
			return true;
		}
	}
	return false;
}
function supprimerAnciennesReservations()
/* Supprime les jours verrouiller datant des semaines précédentes pour éviter de surcharger la bdd */
{
	$date = date('Y-m-d', strtotime('first day of 3 months ago'));
	run('DELETE FROM verrouillerjourrepas WHERE dateVerouiller<"'.$date.'"');
	run('DELETE FROM reserverepas WHERE dateReserve<"'.$date.'"');
}
?>