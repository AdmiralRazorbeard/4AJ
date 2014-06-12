<?php include_once('/view/includes/headerfunctions.php');
include_once('/view/includes/footerfunctions.php');
 // Gestion des classes actives pour les boutons et de la connexion
?>
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
			<div class="box4 boxAdresse">PLATEFORME LOGEMENT<br>34 bis, Grand'Place 62000 ARRAS</div>
			<div id="connexion">
				<?php
				if(isConnected()) {?>
					<div class="connexion_text connexion_bold"><?php langue('Bienvenue', 'Welcome'); ?></div>
					<div class="connexion_text"><a href="index.php?section=parameters"><?php langue('Paramètres', 'Parameters'); ?></a></div>
					<div class="connexion_text"><a href="index.php?section=index&amp;dislog=true"><?php langue('Se déconnecter', 'Log out'); ?></a></div>
			<?php 	if(isAdminSomewhere())
					// Si l'utilisateur est admin
					{ ?> 
						<div class="language"><a href="index.php?section=FR"><img src="/4AJ/view/graphicRessources/france.png" alt="france"/></a><a href="index.php?section=EN"><img src="/4AJ/view/graphicRessources/uk.png" alt="uk"/></a></div>
						<div class="connexion_inscription connexion_bold">
							<a href="admin/index.php?section=main">Partie administrateur</a>
						</div>
							<?php if(isSuperAdmin()) { ?>
								<!-- Si super admin, il peut passer en mode édition -->
								<div class="connexion_inscription connexion_bold">
								<?php if(empty($_SESSION['superAdminOn'])) { ?>
									<a href="index.php?section=index&amp;superAdminOn=true&amp;get=<?php echo $_GET['section']; ?>">Mode édition</a></div> 
								<?php } else { ?>
									<!-- Cela veut dire qu'il est déjà superAdmin, donc lien pour désactiver -->
									<a href="index.php?section=index&amp;finSuperAdminOn=true&amp;get=<?php echo $_GET['section']; ?>">Fin mode édition</a></div>
								<?php 	} 
								}?>
					<?php 
						}
					}
				else { ?>
				<div class="connexion_text connexion_bold"><?php langue('Connexion', 'Log in'); ?></div>
				<form method="post">
					<div class="connexion_text"><label for="mail">Email :</label></div><div><input type="name" id="mail" name="mail" /></div>
					<div class="connexion_text"><label for="password"><?php langue('Mot de passe :', 'Password :'); ?></label></div><div><input type="password" id="password" name="password" /></div>
					<div class="connexion_submit"><input id="submit" type="submit" <?php langue('value="Envoyer"', 'value="Send"'); ?>/></div>
				</form>
				<div class="connexion_text"><em><a id="lostPwd" href="index.php?section=lostPassword"><?php langue('Mot de passe perdu?', 'Forgotten your password?'); ?></a></em></div>
				<div class="language"><a href="index.php?section=FR"><img src="/4AJ/view/graphicRessources/france.png" alt="france"/></a><a href="index.php?section=EN"><img src="/4AJ/view/graphicRessources/uk.png" alt="uk"/></a></div>
				<div class="connexion_inscription connexion_bold"><a href="index.php?section=inscription"><?php langue('Inscription', 'Register'); ?></a></div>
				<?php } ?>
				<?php
				if(!empty($message))
				{
					echo '<div class="connexion_text">'.$message.'</div>'; 
				} ?>
			</div>
		</div>
		<div id="banniere">
			<img id="bannierelogo" src="/4AJ/view/graphicRessources/bannierelogo.png" alt="logo bannière"/>
			<ul id="sContent">
				<li><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/2.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/3.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/2.jpg" alt="image bannière"/></li>
				<li><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></li>
			</ul>
		</div>
		<nav id="mainMenu">
			<ul>
				<li><a <?php if (openSection('index')){?>id="active_item0"<?php } else { ?>id="item0"<?php } ?> href="index.php?section=index"><?php langue('Accueil', 'Home'); ?></a></li>
				<li><a <?php if (openSous_Section_association()){?>id="active_item1"<?php } else { ?>id="item1"<?php } ?> href="index.php?section=association"><?php langue('L\'association', 'The association'); ?></a>
					<ul id="s_item1">
      					<li><a href="index.php?section=quiSommesNous"><?php langue('Qui sommes-nous?', 'Who are we?'); ?></a></li>
      					<li><a href="index.php?section=plateformeLogement"><?php langue('Plateforme Logement', 'Housing platform'); ?></a></li>
      					<li><a class="last_item" href="index.php?section=3FJT"><?php langue('Les 3 FJT', 'The three HYW'); ?></a></li>
    				</ul>
    			</li>	
				<li><a <?php if (openSection('actualites')){?>id="active_item2"<?php } else { ?>id="item2"<?php } ?> href="index.php?section=actualites"><?php langue('Actualités', 'News'); ?></a></li>
				<li><a <?php if (openSection('liensUtiles')){?>id="active_item3"<?php } else { ?>id="item3"<?php } ?> href="index.php?section=liensUtiles"><?php langue('Liens utiles', 'Helpful links'); ?></a></li>
				<li><a <?php if (openSous_Section_vieEnFoyer()){?>id="active_item4"<?php } else { ?>id="item4"<?php } ?> href="index.php?section=vieEnFoyer"><?php langue('Vie en foyer', 'Life at 4AJ'); ?></a>
				    <ul id="s_item4">
      					<li><a href="index.php?section=services">Services</a></li>
      					<li><a href="index.php?section=repas"><?php langue('Repas', 'Meal'); ?></a></li>
      					<li><a class="last_item" href="index.php?section=livreOr"><?php langue('Livre d\'or', 'Guest book'); ?></a></li>
    				</ul>
    			</li>
				<li><a <?php if (openSous_Section_devenirResident()){?>id="active_item5"<?php } else { ?>id="item5"<?php } ?> href="index.php?section=devenirResident"><?php langue('Devenir résident', 'Becoming resident'); ?></a>
				    <ul id="s_item5">
      					<li><a href="index.php?section=conditions">Conditions</a></li>
      					<li><a class="last_item" href="index.php?section=logements"><?php langue('Logements', 'Housing'); ?></a></li>
    				</ul>
    			</li>
				<li><a <?php if (openSous_Section_contact()){?>id="active_item6"<?php } else { ?>id="item6"<?php } ?> href="index.php?section=contact">Contact</a>
					<ul id="s_item6">
      					<li><a href="index.php?section=faq">FAQ</a></li>
      					<li><a href="index.php?section=memento"><?php langue('Mémento', 'Summary'); ?></a></li>
      					<li><a class="last_item" href="index.php?section=faireUnDon"><?php langue('Faire un don', 'Donate'); ?></a></li>
    				</ul>
    			</li>	
			</ul>
		</nav>