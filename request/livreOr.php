<?php
function addLivreOr($nom, $email, $contenu)
{
	run('INSERT INTO livreor(nom,mail,contenu) VALUES ("'.$nom.'", "'.$email.'", "'.$contenu.'")');
}
function returnLivreOr()
{
	run('SELECT nom,mail,contenu, DATE_FORMAT(timestamp, "%d/%m/%y à %H:%i") AS timeLivreor FROM livreor ORDER BY timestamp');
}

?>