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
		// Ou si il a une des fonctions dont il fait parti qui est admin sur les actualites
		{
			return true;
		}
	}
	return false;
}
function allFonction()
// Retourne toutes les fonctions
{
	$tmp = run('SELECT id, nomFonctionFR as nom FROM fonction');
	while($donnees = $tmp->fetch_object())
	{
		$fonction[$donnees->id]['id'] = $donnees->id;
		$fonction[$donnees->id]['nom'] = htmlspecialchars($donnees->nom);
	}
	return $fonction;
}

function addActualite($titre, $contenu, $idMembre)
// Ajoute une actualité
{
	CleanActualite();
	run('INSERT INTO news(id_membre, titreNewsFR, contenuNewsFR) VALUES ('.$idMembre.', "'.$titre.'", "'.$contenu.'")');
}
function CleanActualite()
// Cela supprimer au fur et à mesure les anciennes news pour éviter de surcharger la base
{
	$timestamp1AnAvant = date('Y-m-d G:i:s', strtotime('1 year ago'));
	run('DELETE FROM newsfonction WHERE timestampNews<"'.$timestamp1AnAvant.'"');
	run('DELETE FROM news WHERE timestampNews<"'.$timestamp1AnAvant.'"');
}
function deleteNews($id)
{
	// Supprime la news ainsi que toute les Foreign Keys
	run('DELETE FROM newsfonction WHERE id='.$id);
	run('DELETE FROM news WHERE id='.$id);
}
function envoieMail($lastNews)
// Envoie un mail à ceux qui ont choisi d'en recevoir un
{
	// Récupère les infos de la news
	$infoLastNews = run('SELECT titreNewsFR, contenuNewsFR FROM news WHERE id='.$lastNews)->fetch_object();
	// Requete pour avoir les mails de ceux qui veulent recevoir des news
	$tmp = run('SELECT DISTINCT mail
				FROM membre, fonction, newsfonction, news
				WHERE membre.id = fonction.id
				AND fonction.id = newsfonction.id_fonction
				AND recevoirMailQuandNews = 1
				AND newsfonction.id = news.id
				AND news.id = '.$lastNews);
	while($donnees = $tmp->fetch_object())
	{
		sendMail($donnees->mail, htmlspecialchars($infoLastNews->titreNewsFR), $infoLastNews->contenuNewsFR);
	}
}
function sendMail($mail, $titre, $contenu)
{
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
	    $passage_ligne = "\r\n";
	}
	else
	{
	   $passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = "Une nouvelle actualité a été posté sur 4AJ.fr : ".$titre."
Vous pouvez retrouver cette actualité sur http://4AJ.fr/index.php?section=actualite";	
	$message_html = "<h1>Une nouvelle actualité a été posté sur 4AJ.fr</h1>
	<h4>".$titre."</h4>
	<p>
		".$contenu."
	</p>	";

	//==========
	 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	//=====Définition du sujet.
	$sujet = "Nouvelle actualite sur 4AJ.fr";
	//=========
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"4AJ\"<noreply@4AJ.fr>".$passage_ligne;
	$header.= "Reply-to: \"noreply-4AJ\" <noreply@4AJ.fr>".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"UTF8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	
	 
	//=====Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);
	//==========
}
?>