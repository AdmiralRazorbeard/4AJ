<?php
session_start();
date_default_timezone_set('Europe/Paris');
include_once('request/connectionSQL.php');
$mysqli = connection();

if(isset($_GET['typeActualite']) && empty($_GET['section']))
// Au cas où on vient d'actualite
{
	if(is_numeric($_GET['typeActualite']) || $_GET['typeActualite'] == 'all')
	{
		header('location:index.php?section=actualites&typeActualite='.$_GET['typeActualite']);
	}
	else
	{
		header('location:index.php?index=index');
	}	
}
// Si on ne vient pas d'actualité, on fait comme d'hab
elseif (empty($_GET['section']))	
{
    header('location:index.php?section=index');
}
elseif ($_GET['section'] == 'index')
{
	include_once 'controller/index.php';
}
elseif ($_GET['section'] == 'inscription')
{
	include_once 'controller/inscription.php';
}
elseif ($_GET['section'] == 'association')
{
	include_once 'controller/association.php';
}
elseif ($_GET['section'] == 'actualites')
{
	include_once 'controller/actualites.php';
}
elseif ($_GET['section'] == 'plateformeLogement' || ($_GET['section'] == 'plateformeLogement' && !empty($_GET['subSection'])))
{
	include_once 'controller/plateformeLogement.php';
}
elseif ($_GET['section'] == 'liensUtiles')
{
	include_once 'controller/liensUtiles.php';
}
elseif ($_GET['section'] == 'vieEnFoyer')
{
	include_once 'controller/vieEnFoyer.php';
}
elseif ($_GET['section'] == 'services')
{
	include_once 'controller/services.php';
}
elseif ($_GET['section'] == 'repas')
{
	include_once 'controller/repas.php';
}
elseif ($_GET['section'] == 'livreOr')
{
	include_once 'controller/livreOr.php';
}
elseif ($_GET['section'] == 'devenirResidant')
{
	include_once 'controller/devenirResidant.php';
}
elseif ($_GET['section'] == 'conditions')
{
	include_once 'controller/conditions.php';
}
elseif ($_GET['section'] == 'logements')
{
	include_once 'controller/logements.php';
}
elseif ($_GET['section'] == 'contact')
{
	include_once 'controller/contact.php';
}
elseif ($_GET['section'] == 'faq')
{
	include_once 'controller/faq.php';
}
elseif ($_GET['section'] == 'memento')
{
	include_once 'controller/memento.php';
}
elseif ($_GET['section'] == 'faireUnDon')
{
	include_once 'controller/faireUnDon.php';
}
?>