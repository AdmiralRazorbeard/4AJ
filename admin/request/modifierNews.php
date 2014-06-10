<?php 
function isAdminActualite()
// Fonction pour savoir si le membre est admin d'actualite
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
						AND fonction.isAdminActualite = 1');
		$tmp = $tmp->fetch_object();
		if($tmp->nbre >= 1)
		// Ou si il a une des fonctions dont il fait parti qui est admin sur le livre d'or
		{
			return true;
		}
	}
	return false;
}

function infoNews($id)
// récupère les infos de la news (en vérifiant que la news existe évidemment)
{
	$nbre = run('SELECT COUNT(*) as nbre FROM news WHERE id='.$id)->fetch_object();
	$nbre = $nbre->nbre;
	$info = NULL;
	if($nbre == 1)
	{
		$tmp = run('SELECT id, titreNewsFR, contenuNewsFR FROM news WHERE id='.$id)->fetch_object();
		$info['id'] = $tmp->id;
		$info['titre'] = htmlspecialchars($tmp->titreNewsFR);
		$info['contenu'] = htmlspecialchars($tmp->contenuNewsFR);
	}
	return $info;
}

function updatenews($id, $titre, $contenu, $nomFichier)
// On mets à jour (en vérifiant que la news existe évidemment)
// Nom fichier vaut 0 si on y touche pas, -1 si on veut le supprimer, et le nom du fichier si il faut le changer
{
	$nbre = run('SELECT COUNT(*) as nbre, fichierPDF FROM news WHERE id='.$id)->fetch_object();
	$tmp = $nbre->nbre;
	$info = NULL;
	$mysqli = connection();
	$titre = $mysqli->real_escape_string($titre);
	$contenu = $mysqli->real_escape_string($contenu);

	if($tmp == 1)
	{
		if($nomFichier == -1)
		{
			$nomFichier = "";
			if(file_exists('../fichierPDF/'.$nbre->fichierPDF))
			{
				@unlink('../fichierPDF/'.$nbre->fichierPDF);
			}
		}
		elseif($nomFichier == 1)
		{
			$nomFichier = $mysqli->real_escape_string($nbre->fichierPDF);
		}
		else
		{
			$nomFichier = $mysqli->real_escape_string($nomFichier);
			if(file_exists('../fichierPDF/'.$nbre->fichierPDF))
			{
				@unlink('../fichierPDF/'.$nbre->fichierPDF);
			}
		}
		run('UPDATE news SET titreNewsFR="'.$titre.'", contenuNewsFR="'.$contenu.'", fichierPDF = "'.$nomFichier.'" WHERE id='.$id);
	}
}
function genererCle($nb_car, $chaine = '1234567890AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn')
// Générer une clé aléatoire
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for($i=0; $i < $nb_car; $i++)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}
?>