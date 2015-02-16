<?php
function isAdminRepas()
// Fonction pour savoir si le membre est admin des repas
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
		$tmp 	= run('	SELECT COUNT(*) as nbre
						FROM membre,membrefonction,fonction 
						WHERE membre.id = membrefonction.id 
						AND membrefonction.id_fonction = fonction.id 
						AND mail = "'.$mail.'" 
						AND fonction.isAdminRepas = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si il a une des fonctions dont il fait parti qui est admin sur les repas
		{
			return true;
		}
	}
	return false;
}

function getMenu()
//fonction qui permet de recuperer la liste des menus
{
	$tmp = run('SELECT semaine, annee, residence, telechargement 
				FROM menusemaine'); 
	$listeMenu = NULL;
	if($tmp)
	{
		$i=0;
		while($donnees = $tmp->fetch_object())
		{
			$listeMenu[$i]['semaine'] = $donnees->semaine;
			$listeMenu[$i]['annee'] = $donnees->annee; 
			$listeMenu[$i]['residence'] = $donnees->residence;
			$listeMenu[$i]['telechargement'] = $donnees->telechargement;
			$i++;
		}
	}
	return $listeMenu;
}

function deleteMenu(Array $tmp)
//fonction qui permet de recuperer la liste des menus
{
	if($tmp[0]<10){
	//Pour faire correspondre au véritable nom du fichier qui se trouve dans le serveur
		$value=$tmp[1].'_0'.$tmp[0].'_'.$tmp[2];
	}
	else{
		$value=$tmp[1].'_'.$tmp[0].'_'.$tmp[2];
	}
	if(file_exists('../fichierPDF/menu/'.$value.'.pdf'))
	{
		unlink('../fichierPDF/menu/'.$value.'.pdf');
		run('DELETE FROM menusemaine WHERE semaine = '.$tmp[0].' AND annee='.$tmp[1].' AND residence ='.$tmp[2]);
	}
}
?>