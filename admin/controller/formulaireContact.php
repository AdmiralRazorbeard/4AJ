<?php
include_once 'request/formulaireContact.php';
if(!isSuperAdmin())
{
	header('location:index.php');
}
if(!empty($_POST['mailMain']) && preg_match("#^[a-zA-Zéà0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zàéA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailMain']))
{
	changerMail(1, $_POST['mailMain']);
}
if(!empty($_POST['mailPlateformeLogement']) && preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['mailPlateformeLogement']))
{
	changerMail(2, $_POST['mailPlateformeLogement']);
}
$mailFormulaire = mailFormulaire();
include_once 'view/formulaireContact.php';
?>