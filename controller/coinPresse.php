<?php
include_once 'tinymcetxt.php';
$_SESSION['backgroundBody']='#4e0105';
//Gestions des pdf (si superAdmin)
if(!empty($_SESSION['superAdminOn'])) {
	include_once 'request/gestionUploadPdf.php';
	include_once 'controller/gestionUploadPdf.php';
	$listePdf = getPdf("coinPresse");
}
include_once 'view/contact/coinPresse.php';
?>