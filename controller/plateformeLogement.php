<?php
if(isset($_GET['section']) && empty($_GET['subSection']))
{
	header('location:index.php?section=plateformeLogement&subSection=main');
}
elseif ($_GET['subSection'] == 'main')
{
	include_once '/view/association/plateformeLogement.php';
}
elseif ($_GET['subSection'] == 'accueillir')
{
	include_once '/view/association/accueillir.php';
}
elseif ($_GET['subSection'] == 'informer')
{
	include_once '/view/association/informer.php';
}
elseif ($_GET['subSection'] == 'atelier')
{
	include_once '/view/association/atelier.php';
}
elseif ($_GET['subSection'] == 'accompagner')
{
	include_once '/view/association/accompagner.php';
}
elseif ($_GET['subSection'] == 'documenter')
{
	include_once '/view/association/documenter.php';
}
elseif ($_GET['subSection'] == 'contact')
{
	include_once '/view/association/contact.php';
}
?>