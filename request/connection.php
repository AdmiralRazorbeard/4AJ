<?php
function countMember($mail, $password) // Retourne 1 si valide, 1.5 si seulement mail valide
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
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		if(!empty($message))
		{
			$_SESSION['message'] = $message;
		}
		header('location:index.html');
	}
}
?>