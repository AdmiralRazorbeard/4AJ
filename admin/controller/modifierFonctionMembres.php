<?php
include_once 'request/modifierMembres.php';
// Il prends le request de modifierMembre.php

if(!isAdminMembres() || empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location:index.php?section=gestionMembres');
}

if(!empty($_POST['deleteFonction']) && is_numeric($_POST['deleteFonction']) && $_POST['deleteFonction'] != 1)
// Ceci vérifique que cela existe, mais aussi qu'on supprime pas la fonction "public" d'un membre
{
	run('DELETE FROM membrefonction WHERE id_fonction = '.$_POST['deleteFonction'].' AND id ='.$_GET['id']);
}

if(!empty($_POST['addFonction']) && is_numeric($_POST['addFonction']))
{
	run('INSERT INTO membrefonction(id, id_fonction) VALUES('.$_GET['id'].', '.$_POST['addFonction'].')');
}
$infoMembre = infoMembres($_GET['id']);
$allFonction = FonctionNotMembre($_GET['id']); 
include_once 'view/modifierFonctionMembres.php';
?>