<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('../request/connectionSQL.php');
$mysqli = connection();
###### LANGUAGE #######
// Cela permet de gérer la langue, on met une variable valant 1 si FR, 2 si EN.
if(empty($_SESSION['langue']) || (($_SESSION['langue'] != 1) && ($_SESSION['langue'] != 2)))
{
	$_SESSION['langue'] = 1;
}
function langue($FR, $EN)
// Cette fonction affiche, en fonction de si c'est FR ou EN, le $FR ou le $EN
{
	if($_SESSION['langue'] == 2) 
		{ echo htmlspecialchars($EN); }
	else 
		{ echo htmlspecialchars($FR); }
}

if (empty($_GET['section']))	
{
    header('location:index.php?section=mobile');
}
elseif ($_GET['section'] == 'mobile')
{
	include_once('controller/mobile.php');
}
?>