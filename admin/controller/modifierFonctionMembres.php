<?php
include_once 'request/modifierMembres.php';
// Il prends le request de modifierMembre.php

if(!isAdminMembres() || empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location:index.php?section=gestionMembres');
}

if(!empty($_POST['deleteFonction']) && is_numeric($_POST['deleteFonction']) && $_POST['deleteFonction'] != 1)
// Ceci vérifie que cela existe, mais aussi qu'on supprime pas la fonction "public" d'un membre
{
	run('DELETE FROM membrefonction WHERE id_fonction = '.intval($_POST['deleteFonction']).' AND id ='.intval($_GET['id']));
}

if(!empty($_POST['addFonction']) && is_numeric($_POST['addFonction']))
{
	run('INSERT INTO membrefonction(id, id_fonction) VALUES('.intval($_GET['id']).', '.intval($_POST['addFonction']).')');
}
$infoMembre = infoMembres(intval($_GET['id']));
$allFonction = FonctionNotMembre(intval($_GET['id'])); 
include_once 'view/modifierFonctionMembres.php';
?>