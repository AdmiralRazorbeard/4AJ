<?php
$_SESSION['backgroundBody']='#205f5a';

//Gestions des pdf (si superAdmin)
include_once '/request/gestionUploadPdf.php';
if(!empty($_SESSION['superAdminOn']) && superAdmin()) {

	include_once '/controller/gestionUploadPdf.php';
	$listePdf = getPdf("plateformeLogement");
}

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
	include_once '/controller/contactPlateformeLogement.php';
}
?>