<?php
$_SESSION['langue'] = 2;
if(!empty($_GET['section']))
	{ header('location:index.php?section='.$_GET['section']); }
header('location:index.php');
?>