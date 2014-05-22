<?php
include_once 'request/actualites.php';
$admin = false;
if(isAdminActualite())
{	$admin = true; }

$listeActualite = listeActualite();

include_once 'view/actualite/actualites.php';
?>