<?php
include_once 'tinymcetxt.php';
$_SESSION['backgroundBody']='#4e0105';

//Gestions des pdf (si superAdmin)
include_once '/request/gestionUploadPdf.php';
if(!empty($_SESSION['superAdminOn']) && superAdmin()) {

	include_once '/controller/gestionUploadPdf.php';
	$listePdf = getPdf("nousSoutenir");
}

include_once '/view/contact/nousSoutenir.php';
?>