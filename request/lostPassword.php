<?php
function resetPassword($mail)
// Reset le password, envoie le mail, et retourne vrai si le membre existe, retourne faux sinon.
{	
	$mysqli = connection();
	$mail = $mysqli->real_escape_string($mail);
	$tmp = run('SELECT COUNT(*) as nbre FROM membre WHERE mail="'.$mail.'"')->fetch_object();
	if($tmp->nbre != 1)
	{
		return false;
	}
	$motDePasse = motDePasse(10);
	sendMail($mail, $motDePasse);
	run('UPDATE membre SET password="'.md5($motDePasse).'" WHERE mail="'.$mail.'"');
	return true;

}
function sendMail($mail, $motDePasse)
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
	Voici le nouveau mot de passe, vous pouvez le changer &agrave; tout moment en le r&eacute;glant dans vos param&egrave;tres.
	Mot de passe : ".$motDePasse;	
	$message_html = "R&eacute;initialisation du mot de passe pour 4AJ.fr<br />
	Voici le nouveau mot de passe, vous pouvez le changer &agrave; tout moment en le r&eacute;glant dans vos param&egrave;tres.<br />
	Mot de passe : ".$motDePasse;
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