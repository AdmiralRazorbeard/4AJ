<?php
function resetPassword($mail)
// Reset le password, envoie le mail, et retourne vrai si le membre existe, retourne faux sinon.
{	
	$mysqli = connection();
	$mail = $mysqli->real_escape_string($mail);
	$temp = run('SELECT COUNT(*) as nbre, id FROM membre WHERE mail="'.$mail.'"')->fetch_object();
	if($temp->nbre != 1)
	{
		return false;
	}
	cleanOublierPassword();
	$resetPassword = motDePasse(50);
	// Vérifie que la clé de sécurité n'a pas déjà été utiliser
	$tmp = run('SELECT COUNT(*) as nbre, id FROM oubliemotdepassesecurite WHERE securite = "'.$resetPassword.'"')->fetch_object();
	while($tmp->nbre == 1)
	{
		$resetPassword = motDePasse(50);
		$tmp = run('SELECT COUNT(*) as nbre, id FROM oubliemotdepassesecurite WHERE securite = "'.$resetPassword.'"')->fetch_object();
	}
	sendMail($mail, $resetPassword);
	run('INSERT INTO oubliemotdepassesecurite(id_membre, securite) VALUES('.$temp->id.', "'.$resetPassword.'")');
	return true;
}
function cleanOublierPassword()
// Nettoie la table oublier password pour tout les clés de sécurité datant de plus de 2 heures
{
	$now = strtotime("now");
	$tmp = run('SELECT id FROM oubliemotdepassesecurite 
		 		WHERE UNIX_TIMESTAMP(CurrentTimestamp) < "'.strtotime("-2 hours").'"');
	while($donnees = $tmp->fetch_object())
	{
		run('DELETE FROM oubliemotdepassesecurite WHERE id='.$donnees->id);
	}
}
function sendMail($mail, $resetPassword)
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
	$message_txt = "R&eacute;initialisation du mot de passe pour 4AJ.fr
	Pour r&eacute;initialiser votre mot de passe, veuillez suivre ce lien : http://4AJ.fr/index.php?section=findPassword&id=".$resetPassword."";	
	$message_html = "R&eacute;initialisation du mot de passe pour 4AJ.fr<br />
	Pour r&eacute;initialiser votre mot de passe, veuillez suivre ce lien : <a href='http://4AJ.fr/index.php?section=findPassword&id=".$resetPassword."'>http://4AJ.fr/index.php?section=findPassword&id=".$resetPassword."</a>";	

	//==========
	 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	//=====Définition du sujet.
	$sujet = "Réinitialisation du mot de passe de 4AJ.fr";
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
function motDePasse($nb_car, $chaine = '1234567890AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn')
// Générer un mot de passe aléatoire.
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