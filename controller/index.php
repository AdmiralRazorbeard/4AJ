<?php
include_once 'request/index.php';
if(!empty($_SESSION['message']))
{
	$message = '<em>'.htmlspecialchars($_SESSION['message']).'</em>';
	unset($_SESSION['message']);
}


include_once 'view/index.php';
?>