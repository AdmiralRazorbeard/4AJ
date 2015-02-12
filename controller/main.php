<?php
include_once 'request/main.php';
if(!empty($_SESSION['message']))
{
	$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
	unset($_SESSION['message']);
}
$allActualite = listeActualite();
include_once 'tinymcetxt.php';
$_SESSION['backgroundBody']='#3c255e';
include_once 'view/main/main.php';
?>