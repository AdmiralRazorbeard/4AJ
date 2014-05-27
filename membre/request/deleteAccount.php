<?php
function deleteAccount()
// fonction qui permet la suppression du compte
{
	$mysqli = connection();
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		$mail 	= $mysqli->real_escape_string($_SESSION['mail']);
		$tmp	= run('SELECT id, isSuperAdmin FROM membre WHERE mail = "'.$mail.'"');
		$account = NULL;
		while ($donnees = $tmp->fetch_object())
		{
		$account[0]['id'] = $donnees->id;
		$account[0]['isSuperAdmin'] = $donnees->isSuperAdmin;
		}
		if($account[0]['isSuperAdmin'] != 1)
		// Si non super admin
		{
			//deconnexion
			unset($_SESSION['mail']);
			unset($_SESSION['log']);
			//supression
			run('DELETE FROM membrefonction WHERE id='.$account[0]['id']);
			run('UPDATE news SET id_membre=NULL WHERE id_membre='.$account[0]['id']);
			run('DELETE FROM membre WHERE id='.$account[0]['id']);
			return true;
		}
		else
		{
			return false;
		}
	}
	return false;
}
