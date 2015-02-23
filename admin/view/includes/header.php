<?php include_once('view/includes/headerfunctions.php');
// Gestion des classes actives pour les boutons et de la connexion
?>
<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="view/style.css" />
		<link rel="icon" type="image/png" href="view/graphicRessources/favicon.jpg" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<meta charset="utf-8">
	</head> 
	<body>
	<div class="mainWrapper">
		<div id="connexion">
			<?php
			if(isConnected()) {?>
				<div class="connexion_text connexion_bold">Bienvenue</div>
				<div class="connexion_text"><a href="../index.php?section=parameters">Paramètres</a></div>
				<div class="connexion_text"><a href="../index.php?section=index&amp;dislog=true">Se déconnecter</a></div>
			<?php }
			else { ?>
			<div class="connexion_text connexion_bold">Connexion</br></div>
			<form method="post">
				<div class="connexion_text"><legend for="mail">Votre email :</div><div></legend><input type="name" id="mail" name="mail" /></div>
				<div class="connexion_text"><legend for="password">Mot de passe :</div><div></legend><input type="password" id="password" name="password" /></div>
				<div class="connexion_submit"><input id="submit" type="submit"/></div>
			</form>
			<?php } ?>
			<div class="connexion_inscription connexion_bold"><a href="../">Accueil</a></div>
		</div>
		<div id="banniere">
			<a href="index.php?section=main"><img src="/admin/view/graphicRessources/administration.jpg" alt="image bannière"/></a>
		</div>
		<nav id="menu">
			<ul>
				<li><a <?php if (openSection('gestionMembres') || openSection('modifierMembres') || openSection('modifierFonctionMembres')){?>id="active_menu_item"<?php } else { ?>class="menu_item"<?php } ?> href="index.php?section=gestionMembres">Gestion des membres</a></li>
				<li><a <?php if (openSection('fonction')){?>id="active_menu_item"<?php } else { ?>class="menu_item"<?php } ?> href="index.php?section=fonction">Fonctions des membres</a></li>
				<li><a <?php if (openSection('actualite')){?>id="active_menu_item"<?php } else { ?>class="menu_item"<?php } ?> href="index.php?section=actualite">Nouvelle actualité</a></li>
				<li><a <?php if (openSection('livreOrAConfirmer')){?><?php if(nouveauLivreOrAConfirmer()){ ?>id="active_menu_item2"<?php } else {?>id="active_menu_item"<?php } } else { ?><?php if(nouveauLivreOrAConfirmer()){ ?>id="menu_item2"<?php } else {?>class="menu_item"<?php } ?><?php } ?> href="index.php?section=livreOrAConfirmer">Livre d'or à confirmer</a></li>
				<li><a <?php if (openSection('gestionRepas') || openSection('verrouillerRepas') || openSection('menuSemaine') || openSection('horaireLimite')){?>id="active_menu_item"<?php } else { ?>class="menu_item"<?php } ?> href="index.php?section=gestionRepas">Restauration</a></li>
				<li><a <?php if (openSection('formulaireContact')){?>id="active_menu_item"<?php } else { ?>class="menu_item"<?php } ?> href="index.php?section=formulaireContact">Formulaire de contact</a></li>		
			</ul>
		</nav>