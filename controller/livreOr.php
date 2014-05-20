<?php
include_once 'request/livreOr.php';
if(!empty($_POST['nom']) && !empty($_POST['contenu']))
{
	if(!is_numeric($_POST['nom']) && !is_numeric($_POST['contenu']) && strlen($_POST['contenu'] <= 305))
	{
		$nom = $mysqli->real_escape_string($_POST['nom']);
		$contenu = $mysqli->real_escape_string(nl2br($_POST['contenu']));
		$email = "null";
		if(!empty($_POST['mail']) && preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mail']))
		{
			$email = $mysqli->real_escape_string($_POST['mail']);
		}
		addLivreOr($nom,$contenu,$email);
	}
}
$contenuLivreOr = returnLivreOr();
include_once 'view/vieEnFoyer/livreOr.php';
?>