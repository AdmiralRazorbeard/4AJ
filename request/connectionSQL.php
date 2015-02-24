<?php
function connection()
{
	$serveur	= 'ajeudysvim4aj.mysql.db';
	$user 		= 'ajeudysvim4aj';
	$password 	= '4w2bGuV4';
	$BDD 		= 'ajeudysvim4aj';
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