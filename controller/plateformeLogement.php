<?php
if(isset($_GET['section']) && empty($_GET['subSection']))
{
	header('location:index.php?section=plateformeLogement&subSection=main');
}
elseif ($_GET['subSection'] == 'main')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/plateformeLogement.php';
}
elseif ($_GET['subSection'] == 'accueillir')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/accueillir.php';
}
elseif ($_GET['subSection'] == 'informer')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/informer.php';
}
elseif ($_GET['subSection'] == 'atelier')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/atelier.php';
}
elseif ($_GET['subSection'] == 'accompagner')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/accompagner.php';
}
elseif ($_GET['subSection'] == 'documenter')
{
	include_once 'tinymcetxt.php';
	include_once '/view/association/documenter.php';
}
elseif ($_GET['subSection'] == 'contact')
{
	include_once 'tinymcetxt.php';
	include_once 'request/contact.php';
	if(!empty($_POST['subject']) && !empty($_POST['email']) && !empty($_POST['contenu']))
	{
		if(preg_match("#^[a-zA-Z0-9.+/=!\#%&'*/?^`{|}~_-]+@[a-zA-Z0-9.+/=!\#%&'*/?^`.{|}~_-]+\.[a-z]+$#", $_POST['email']))
		{
			sendMailContact(2, $_POST['email'], $_POST['subject'], $_POST['contenu']);	
		}
	}
	include_once '/view/association/contact.php';
}
?>