<?php
function formatDate($date)
// Formate la date retourner par sql en jj/mm/aaaa
{
	$date = explode('-', $date);
	return $date[2].'/'.$date[1].'/'.$date[0];
}
function infoMembre($mail)
// Récupère les infos du membre
{
	$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable, recevoirMailQuandNews FROM membre WHERE mail="'.$mail.'"'); 
	$infoMembre = NULL;
	while($donnees = $tmp->fetch_object())
	{
		$infoMembre['id'] = $donnees->id;
		$infoMembre['nomMembre'] = $donnees->nomMembre; 
		$infoMembre['prenomMembre'] = $donnees->prenomMembre; 
		$infoMembre['adresse'] = $donnees->adresse; 
		$infoMembre['dateNaissance'] = formatDate($donnees->dateNaissance); 
		$infoMembre['telFixe'] = $donnees->telFixe; 
		$infoMembre['telPortable'] = $donnees->telPortable; 
		$infoMembre['recevoirMailQuandNews'] = $donnees->recevoirMailQuandNews;
		$fonction = run('	SELECT id_fonction, nomFonctionFR 
							FROM fonction,membrefonction 
							WHERE fonction.id = membrefonction.id_fonction
							AND membrefonction.id = '.$infoMembre['id'].'
							ORDER BY id_fonction DESC');
		while($temp = $fonction->fetch_object())
		{
			$infoMembre['fonction'][$temp->id_fonction]['id'] = $temp->id_fonction;
			$infoMembre['fonction'][$temp->id_fonction]['nom'] = $temp->nomFonctionFR;
		}
	}
	return $infoMembre;
}
function getPassword($mail)
// Récupère le mot de passe du membre
{
	$pass = run('SELECT password FROM membre WHERE mail = "'.$mail.'"'); 
	$pass = $pass->fetch_object();
	return $pass->password;
}
function updateMembre($adresse, $telFixe, $telPortable, $password, $mail)
// mets à jour le profil
{
	run('UPDATE membre SET adresse="'.$adresse.'", telFixe="'.$telFixe.'", telPortable="'.$telPortable.'", password="'.$password.'" WHERE mail="'.$mail.'"');
}
?>