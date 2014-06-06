<?php
function nombreVisiteur()
{
	if(empty($_SESSION['visiteur']))
	{
		$tmp = run('SELECT nombre FROM nombrevisiteur WHERE id=1')->fetch_object();
		$tmp = $tmp->nombre;
		$tmp ++;
		run('UPDATE nombrevisiteur SET nombre = '.$tmp);
		$_SESSION['visiteur'] = true;
	}
	$tmp = run('SELECT nombre FROM nombrevisiteur WHERE id=1')->fetch_object();
	$tmp = $tmp->nombre;
	return $tmp;
}

?>