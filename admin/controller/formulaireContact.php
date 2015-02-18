<?php
include_once 'request/formulaireContact.php';
if(!isSuperAdmin())
{
	header('location:index.php?section=error');
}
if(!empty($_POST['mailMain']) && preg_match("#^[a-zA-Zéà0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zàéA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailMain']))
{
	changerMail('mailMain', $mysqli->real_escape_string($_POST['mailMain']));
}
if(!empty($_POST['mailPlateformeLogement']) && preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailPlateformeLogement']))
{
	changerMail('mailPlateformeLogement', $mysqli->real_escape_string($_POST['mailPlateformeLogement']));
}
if(!empty($_POST['mailAnneFrank']) && preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailAnneFrank']))
{
	changerMail('mailAnneFrank', $mysqli->real_escape_string($_POST['mailAnneFrank']));
}
if(!empty($_POST['mailClairLogis']) && preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailClairLogis']))
{
	changerMail('mailClairLogis', $mysqli->real_escape_string($_POST['mailClairLogis']));
}
if(!empty($_POST['mailNobel']) && preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailNobel']))
{
	changerMail('mailNobel', $mysqli->real_escape_string($_POST['mailNobel']));
}
$mailFormulaire = mailFormulaire();
include_once 'view/formulaireContact.php';
?>