<?php
include_once 'request/main.php';
if(!isAdminSomewhere())
{
	header('location:../index.php');
}
include_once 'view/main.php';
?>