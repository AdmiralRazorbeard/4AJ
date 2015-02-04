<?php
include_once 'tinymcetxt.php';
$_SESSION['backgroundBody']='#4e0105';
include_once '/request/gestionUploadPdf.php';
include_once '/controller/gestionUploadPdf.php';
//on récupère la liste des menus
$listePdf = getPdf("nousSoutenir");
include_once '/view/contact/nousSoutenir.php';
?>