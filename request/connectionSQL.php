<?php
function connection()
{
	$serveur= 'localhost';
	$user = 'root';
	$password = 'root';
	$BDD = '4AJ';
	return $cnx = new mysqli($serveur, $user, $password, $BDD);
}
function run($sql)
{
	$mysqli = connection();
	$result = $mysqli -> query($sql);
	return $result;
}
?>