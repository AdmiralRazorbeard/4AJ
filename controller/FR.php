<?php
$_SESSION['langue'] = 1;
if(!empty($_GET['sect']))
	{ header('location:index.php?section='.$_GET['sect']); }
else
	{ header('location:index.php'); }
?>