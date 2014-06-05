<?php
function infoMembre($id)
// Récupère les infos du membre
{
	$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable FROM membre WHERE id='.$id); 
	$infoMembre = NULL;
	while($donnees = $tmp->fetch_object())
	{
		$infoMembre['id'] = $donnees->id;
		$infoMembre['nomMembre'] = $donnees->nomMembre; 
		$infoMembre['prenomMembre'] = $donnees->prenomMembre; 
		$infoMembre['adresse'] = $donnees->adresse; 
		$infoMembre['telFixe'] = $donnees->telFixe; 
		$infoMembre['telPortable'] = $donnees->telPortable; 
	}
	return $infoMembre;
}
?>