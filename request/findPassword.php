<?php
function infoMembre($id)
// Récupère les infos du membre
{
	$tmp = run('SELECT id, nomMembre, prenomMembre FROM membre WHERE id='.$id); 
	$infoMembre = NULL;
	while($donnees = $tmp->fetch_object())
	{
		$infoMembre['id'] = $donnees->id;
		$infoMembre['nomMembre'] = $donnees->nomMembre; 
		$infoMembre['prenomMembre'] = $donnees->prenomMembre; 
	}
	return $infoMembre;
}
?>