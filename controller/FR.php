<?php
$_SESSION['langue'] = 1;
if(!empty($_GET['section']))
	{ header('location:index.php?section='.$_GET['section']); }
header('location:index.php');
?>