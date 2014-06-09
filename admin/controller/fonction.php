<?php
include_once 'request/fonction.php';
if(!isAdminFonction())
{
	header('location:index.php?section=error');
}
if(!empty($_GET['type']) && !empty($_GET['id']) && is_numeric($_GET['id']) && is_numeric($_GET['type']))
{
	// On change le pouvoir de la fonction (inversement en fonction de ce qu'elle était)
	changerPouvoir($_GET['type'], $_GET['id']);
	header('location:index.php?section=fonction');
}
if(!empty($_POST['nom']) && !ctype_space($_POST['nom']))
{
	// Ajout d'une fonction
	ajouterFonction($mysqli->real_escape_string($_POST['nom']));
}
if(!empty($_GET['delete']) && is_numeric($_GET['delete']) && $_GET['delete'] > 1)
	// Supprime seulement si ce n'est pas la fonction "public"
{
	supprimerFonction($_GET['delete']);
	header('location:index.php?section=fonction');
}
if(!empty($_POST['addMembreInFonction']) && !empty($_POST['idFonction']) && is_numeric($_POST['addMembreInFonction']) && is_numeric($_POST['idFonction']))
	// Si l'utilisateur veut ajouter un membre à la fonction
{
	ajouterMembreAFonction($_POST['addMembreInFonction'], $_POST['idFonction']); 
}
if(!empty($_GET['fonction']) && is_numeric($_GET['fonction']))
	// Si l'utilisateur a choisi une fonction, on récupère la liste des membres
{
	if(!empty($_GET['supprimerMembre']) && is_numeric($_GET['supprimerMembre']))
		/* Si en plus d'avoir choisi une fonction, il choisit une membre, 
		il enlève le membre de la fonction associée */
	{
		supprimerFonctionMembre($_GET['supprimerMembre'], $_GET['fonction']);
		header('location:index.php?section=fonction&fonction='.$_GET['fonction']);
	}
	$allMembreIn = allMembre($_GET['fonction']);
	// On récupère la liste des membres de la fonction
	$allMembreNotInFonction = allMembreNotIn($_GET['fonction']);
	// On récupère ici la liste de tous les membres ne faisant pas parti de la fonction
}
$allFonction = allFonction();
include_once 'view/fonction.php';
?>