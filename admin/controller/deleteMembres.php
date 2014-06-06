<?php
include_once 'request/gestionMembres.php';
if(isAdminMembres())
{
	if(!empty($_GET['delete']) && is_numeric($_GET['delete']))
	{
		$tmp = run('SELECT isSuperAdmin FROM membre WHERE id='.$_GET['delete'])->fetch_object();
		if($tmp->isSuperAdmin != 1)
			// On ne peut pas supprimer un super admin
		{
			supprimerMembre($_GET['delete']);
		}
	}
	header('location:index.php?section=gestionMembres');
}
else
{
	header('location:index.php?section=error');
}
?>