<?php
include_once 'request/actualite.php';
$admin = false;
if(isAdminActualite())
{	$admin = true; }

$listeActualite = listeActualite();

include_once 'view/actualite/actualite.php';
?>