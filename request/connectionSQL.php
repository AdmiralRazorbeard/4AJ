<?php
function connection()
{
	$serveur	= 'localhost';
	$user 		= 'root';
	$password 	= 'root';
	$BDD 		= '4aj';
	$cnx = @new mysqli($serveur, $user, $password, $BDD);
	if ($cnx->connect_errno) {
    	die('Erreur de connexion : ' . $cnx->connect_errno);
	}
	return $cnx;
}
function run($sql)
{
	$mysqli = connection();
	$result = $mysqli -> query($sql);
	return $result;
}
?>