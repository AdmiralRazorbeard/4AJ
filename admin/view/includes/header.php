<?php include_once('/view/includes/headerfunctions.php');?>
<!-- Gestion des classes actives pour les boutons et de la connexion-->
<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="/4AJ/admin/view/style.css" />
		<link rel="icon" type="image/png" href="/4AJ/view/graphicRessources/favicon.jpg" >
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
			<?php
			if(!empty($message))
			{
				echo '<div class="connexion_text"><em>'.$message.'</em></div>'; 
			} ?>
		</div>
		<div id="banniere">
			<a href="index.php?section=main"><img src="/4AJ/admin/view/graphicRessources/administration.jpg" alt="image bannière"/></a>
		</div>
		<nav id="menu">
			<ul>
				<li><a <?php if (openSection('item1')){?>id="active_menu_item"<?php } else { ?>id="menu_item"<?php } ?> href="index.php?section=gestionMembres">Gestion des membres</a></li>
				<li><a <?php if (openSection('item2')){?>id="active_menu_item"<?php } else { ?>id="menu_item"<?php } ?> href="index.php?section=fonction">Fonction des membres</a></li>
				<li><a <?php if (openSection('item3')){?>id="active_menu_item"<?php } else { ?>id="menu_item"<?php } ?> href="index.php?section=actualite">Nouvelle actualité</a></li>
				<li><a <?php if (openSection('item4')){?><?php if(nouveauLivreOrAConfirmer()){ ?>id="active_menu_item2"<?php } else {?>id="active_menu_item"<?php } ?><?php } else { ?><?php if(nouveauLivreOrAConfirmer()){ ?>id="menu_item2"<?php } else {?>id="menu_item"<?php } ?><?php } ?> href="index.php?section=livreOrAConfirmer">Livre d'or à confirmer</a></li>
				<li><a <?php if (openSection('item5')){?>id="active_menu_item"<?php } else { ?>id="menu_item"<?php } ?> href="index.php?section=gestionRepas">Inscrits aux repas</a></li>
				<li><a <?php if (openSection('item6')){?>id="active_menu_item"<?php } else { ?>id="menu_item"<?php } ?> href="#">Item6</a></li>		
			</ul>
		</nav>