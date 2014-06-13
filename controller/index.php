<?php
include_once 'request/index.php';
if(!empty($_SESSION['message']))
{
	$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
	unset($_SESSION['message']);
}
$allActualite = listeActualite();
include_once 'view/index/index.php';
?>