<?php
include_once 'connection.php';
// Ajoute pour avoir la fonction isConnect()

function addMembers($nomMembre, $prenomMembre, $adresse, $telFixe, $telPortable, $mail, $password)
// Ajoute un membre
{	
	run('INSERT INTO `membre`(`nomMembre`,`prenomMembre`,`adresse`,`telFixe`,`telPortable`,`mail`,`password`) VALUES ("'.$nomMembre.'", "'.$prenomMembre.'", "'.$adresse.'", "'.$telFixe.'", "'.$telPortable.'", "'.$mail.'", "'.$password.'");');
	$lastId = run('SELECT id FROM membre ORDER BY id DESC LIMIT 0,1')->fetch_object();
	run('INSERT INTO `membrefonction`(`id`, `id_fonction`) VALUES ('.$lastId->id.', 2)');

}

?>