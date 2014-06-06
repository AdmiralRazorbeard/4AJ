<?php
include_once 'request/error.php';
if(!isAdminSomewhere())
{
	header('location:../index.php');
}
include_once 'view/error.php';
?>