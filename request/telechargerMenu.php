<?php
function accesRepas()
{
	if(!empty($_SESSION['mail']))
	{
		$mysqli = connection();
		$tmp = run('SELECT COUNT(*) as nbre 
					FROM fonction, membrefonction, membre
					WHERE fonction.id = membrefonction.id_fonction
					AND membre.id = membrefonction.id
					AND mail = "'.$mysqli->real_escape_string($_SESSION['mail']).'"
					AND ((
					    autorisationMangerMidi = 1 OR
					    autorisationMangerSoir = 1)
					OR isSuperAdmin=1)')->fetch_object();
		if($tmp->nbre >= 1)
		{
			return true;
		}
	}
	return false;
}
?>