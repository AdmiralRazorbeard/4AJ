<?php
function isSuperAdmin()
// Fonction pour savoir si le membre est super admin
{
	$mysqli = connection();
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$tmp 	= $tmp->fetch_object();
		if($tmp->isSuperAdmin == 1)
		// Si super admin, il a le pouvoir
		{
			return true;
		}
	}
	return false;
}
function mailFormulaire()
{
	$tmp = run('SELECT mailMain, mailPlateformeLogement FROM mail WHERE id=1')->fetch_object();
	$mail['mailMain'] = $tmp->mailMain;
	$mail['mailPlateformeLogement'] = $tmp->mailPlateformeLogement;
	return $mail;
}

function changerMail($lequel, $mail)
// Change le mail du contactMain (lequel == 1) ou mailPlateformeLogement (lequel == 2)
{
	if($lequel == 1)
		{ $lequel = 'mailMain'; }
	elseif($lequel == 2)
		{ $lequel = 'mailPlateformeLogement'; }
	else
		{ header('location:index.php?section=formulaireContact'); }
	run('UPDATE mail SET '.$lequel.'= "'.$mail.'" WHERE id=1'); // Il n'y a qu'une seule entrée dans la bdd
}