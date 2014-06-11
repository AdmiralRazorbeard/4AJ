<?php
include_once 'request/contact.php';
include_once 'textToolBox.php';
if(!empty($_POST['subject']) && !empty($_POST['email']) && !empty($_POST['contenu']))
{
	if(preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['email']))
	{
		sendMailContact(1, $_POST['email'], $_POST['subject'], $_POST['contenu']);	
	}
}
include_once 'view/contact/contact.php';
?>