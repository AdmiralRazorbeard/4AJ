<?php
function countMember($mail, $password)
//Retourne 1 si valide, 1.5 si seulement mail valide
{
	$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'"');
	$nbre = $nbre->fetch_object();
	if($nbre->nbre == 1)
	{
		$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'" AND password = "'.$password.'"');
		$nbre = $nbre->fetch_object();
		if($nbre->nbre == 1)
			return 1;
		else
			return 1.5;
	}
	return 0;
}
function isConnect()
// Return true si connecté, false sinon
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		return true;
	}
	return false;
}
function mailExist($mail)
{
	$nbre = run('SELECT COUNT(*) as nbre FROM membre WHERE mail = "'.$mail.'"');
	$nbre = $nbre->fetch_object();
	if($nbre->nbre == 1)
	{
		return true;
	}
	return false;
}
?>