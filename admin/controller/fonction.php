<?php
include_once 'request/fonction.php';
$membreParPage = 2;
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
if(!empty($_GET['fonction']) && is_numeric($_GET['fonction']))
	// Si l'utilisateur a choisi une fonction, on récupère la liste des membres
{
	if(!empty($_GET['supprimerMembre']) && is_numeric($_GET['supprimerMembre']) && $_GET['fonction'] > 1)
		/* Si en plus d'avoir choisi une fonction, il choisit un membre à supprimer, il est supprimer,
		(sauf si fonction public) */
	{
		supprimerFonctionMembre($_GET['supprimerMembre'], $_GET['fonction']);
		header('location:index.php?section=fonction&fonction='.$_GET['fonction']);
	}
	elseif(!empty($_GET['ajouterMembre']) && is_numeric($_GET['ajouterMembre']) && $_GET['fonction'] > 1)
		/* Si il a choisi un membre à ajouter, on l'ajoute */
	{
		ajouterMembreAFonction($_GET['ajouterMembre'], $_GET['fonction']);
	}
	// On vérifie pour les pages :
	if(!empty($_GET['pageSupprimer']) && is_numeric($_GET['pageSupprimer']))
	{ $pageSupprimer = $_GET['pageSupprimer']; }
	else
	{ $pageSupprimer = 1; }
	if(!empty($_GET['pageAjouter']) && is_numeric($_GET['pageAjouter']))
	{ $pageAjouter = $_GET['pageAjouter']; }
	else
	{ $pageAjouter = 1; }
	$allMembreIn = allMembre($_GET['fonction'], $membreParPage, $pageSupprimer);
	// On récupère la liste des membres de la fonction
	$allMembreNotInFonction = allMembreNotIn($_GET['fonction'], $membreParPage, $pageAjouter);
	// On récupère ici la liste de tous les membres ne faisant pas parti de la fonction

	// On récupère ensuite le nombre de page : 
	$nbrePageIn = nbrePage(1, $membreParPage, $_GET['fonction']);
	$nbrePageNotIn = nbrePage(0, $membreParPage, $_GET['fonction']);
}
$allFonction = allFonction();
include_once 'view/fonction.php';
?>