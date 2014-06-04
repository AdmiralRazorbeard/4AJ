<?php include_once('/view/includes/headerfunctions.php')
 // Gestion des classes actives pour les boutons et de la connexion
;?>
<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="/4AJ/view/style.css" />
		<link rel="icon" type="image/png" href="/4AJ/view/graphicRessources/favicon.jpg" >
		<meta charset="utf-8">
	</head> 
	<body>
	<div class="mainWrapper">
		<div>
			<div class="box1 boxAdresse">FJT ANNE FRANCK<br>21, rue du bloc 62000 ARRAS</div>
			<div class="box2 boxAdresse">FJT CLAIR LOGIS<br>3, rue du Paul Perin 62000 ARRAS</div>
			<div class="box3 boxAdresse">FJT NOBEL<br>7, rue Diderot 62000 ARRAS</div>
			<div id="connexion">
				<?php
				if(isConnected()) {?>
					<div class="connexion_text connexion_bold">Bienvenue</div>
					<div class="connexion_text"><a href="index.php?section=parameters">Paramètres</a></div>
					<div class="connexion_text"><a href="index.php?section=index&amp;dislog=true">Se déconnecter</a></div>
			<?php 	if(isAdminSomewhere())
					// Si l'utilisateur est admin
					{ ?> 
						<div class="connexion_inscription connexion_bold">
							<a href="admin/index.php?section=gestionMembres">Partie administrateur</a>
						</div>
						<div class="connexion_inscription connexion_bold">
							<?php if(isSuperAdmin()) { ?>
								<!-- Si super admin, il peut passer en mode édition -->
								<?php if(empty($_SESSION['superAdminOn'])) { ?>
									<a href="index.php?section=index&amp;superAdminOn=true">Mode édition</a></div> 
								<?php } else { ?>
									<!-- Cela veut dire qu'il est déjà superAdmin, donc lien pour désactiver -->
									<a href="index.php?section=index&amp;finSuperAdminOn=true">Fin mode édition</a></div>
							<?php 	} 
								}?>
				<?php 
					}
				}
				else { ?>
				<div class="connexion_text connexion_bold">Connexion</div>
				<form method="post">
					<div class="connexion_text"><label for="mail">Votre email :</label></div><div><input type="name" id="mail" name="mail" /></div>
					<div class="connexion_text"><label for="password">Mot de passe :</label></div><div><input type="password" id="password" name="password" /></div>
					<div class="connexion_submit"><input id="submit" type="submit"/></div>
				</form>
				<div class="connexion_inscription connexion_bold"><a href="index.php?section=inscription">Inscription</a></div>
				<?php } ?>
				<?php
				if(!empty($message))
				{
					echo '<div class="connexion_text"><em>'.$message.'</em></div>'; 
				} ?>
			</div>
		</div>
		<div id="banniere">
			<img id="bannierelogo" src="/4AJ/view/graphicRessources/bannierelogo.png" alt="logo bannière"/>
			<ul id="sContent">
				<li><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/2.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/3.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></li>
			</ul>
		</div>
		<nav id="mainMenu">
			<ul>
				<li><a <?php if (openSection('index')){?>id="active_item0"<?php } else { ?>id="item0"<?php } ?> href="index.php?section=index">Accueil</a></li>
				<li><a <?php if (openSous_Section_association()){?>id="active_item1"<?php } else { ?>id="item1"<?php } ?> href="index.php?section=association">L'association</a>
					<ul id="s_item1">
      					<li><a href="index.php?section=quiSommesNous">Qui sommes-nous ?</a></li>
      					<li><a href="index.php?section=plateformeLogement">Plateforme Logement</a></li>
      					<li><a class="last_item" href="index.php?section=les3Fjt">Les 3 FJT</a></li>
    				</ul>
    			</li>	
				<li><a <?php if (openSection('actualites')){?>id="active_item2"<?php } else { ?>id="item2"<?php } ?> href="index.php?section=actualites">Actualités</a></li>
				<li><a <?php if (openSection('liensUtiles')){?>id="active_item3"<?php } else { ?>id="item3"<?php } ?> href="index.php?section=liensUtiles">Liens utiles</a></li>
				<li><a <?php if (openSous_Section_vieEnFoyer()){?>id="active_item4"<?php } else { ?>id="item4"<?php } ?> href="index.php?section=vieEnFoyer">Vie en foyer</a>
				    <ul id="s_item4">
      					<li><a href="index.php?section=services">Services</a></li>
      					<li><a href="index.php?section=repas">Repas</a></li>
      					<li><a class="last_item" href="index.php?section=livreOr">Livre d'or</a></li>
    				</ul>
    			</li>
				<li><a <?php if (openSous_Section_devenirResidant()){?>id="active_item5"<?php } else { ?>id="item5"<?php } ?> href="index.php?section=devenirResidant">Devenir résidant</a>
				    <ul id="s_item5">
      					<li><a href="index.php?section=conditions">Conditions</a></li>
      					<li><a class="last_item" href="index.php?section=logements">Logements</a></li>
    				</ul>
    			</li>
				<li><a <?php if (openSous_Section_contact()){?>id="active_item6"<?php } else { ?>id="item6"<?php } ?> href="index.php?section=contact">Contact</a>
					<ul id="s_item6">
      					<li><a href="index.php?section=faq">FAQ</a></li>
      					<li><a href="index.php?section=memento">Mémento</a></li>
      					<li><a class="last_item" href="index.php?section=faireUnDon">Faire un don</a></li>
    				</ul>
    			</li>	
			</ul>
		</nav>