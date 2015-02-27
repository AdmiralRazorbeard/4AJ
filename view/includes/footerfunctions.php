<?php
function nombreVisiteur()
{
	$tmp = run('SELECT nombre FROM nombrevisiteur WHERE id=1')->fetch_object();
	$tmp = $tmp->nombre;
	if(empty($_SESSION['visiteur']))
	{
		$tmp ++;
		run('UPDATE nombrevisiteur SET nombre = '.$tmp);
		$_SESSION['visiteur'] = true;
	}
	return $tmp;
}
?>