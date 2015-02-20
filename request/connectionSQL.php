<?php
function connection()
{
	$serveur	= 'ajeudysvim4aj.mysql.db';
	$user 		= 'ajeudysvim4aj';
	$password 	= '4w2bGuV4';
	$BDD 		= 'ajeudysvim4aj';
	return $cnx = new mysqli($serveur, $user, $password, $BDD);
}
function run($sql)
{
	$mysqli = connection();
	$result = $mysqli -> query($sql);
	return $result;
}
?>