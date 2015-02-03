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
		<link rel="stylesheet" href="sss/sss.css" type="text/css" media="all">
		<meta charset="utf-8">
		<?php if(!empty($_SESSION['superAdminOn']) && isSuperAdmin())
		//Pour ne charger les scripts que lorsque l'on est superadministrateur
		{?>
		<script type="text/javascript" src="/4AJ/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
		tinymce.init({
			//Pour générer la boite de dialogue lorsque l'on souhaite éditer les pages
		    selector: "#txtarea",
		    height: 400,
		    language : 'fr_FR',
		    plugins: [
                "advlist autolink autosave link image lists charmap preview hr spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                "table contextmenu directionality textcolor paste textcolor colorpicker textpattern"
        ],

        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | forecolor | bullist numlist | outdent indent blockquote | styleselect fontsizeselect | link unlink image code table | hr removeformat | subscript superscript | charmap ",
        toolbar2: "undo redo | cut copy paste | searchreplace | fullscreen | insertdatetime preview | spellchecker | visualchars visualblocks nonbreaking",
        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Titre association', block: 'h2', styles: {color: '#2797e8', textShadow:'1px 1px 0.6px #103b5a'}},
                {title: 'Titre plateforme', block: 'h2', styles: {color: '#177f80', textShadow:'1px 1px 0.6px #052020'}},
                {title: 'Titre résidences', block: 'h2', styles: {color: '#f8d617', textShadow:'1px 1px 0.6px #5a4c00'}},
                {title: 'Titre restauration', block: 'h2', styles: {color: '#a4b819', textShadow:'1px 1px 0.6px #103b5a'}},
                {title: 'Titre services', block: 'h2', styles: {color: '#e3944e', textShadow:'1px 1px 0.6px #3b2714'}},
                {title: 'Titre contact', block: 'h2', styles: {color: '#990007', textShadow:'1px 1px 0.6px #350003'}},
                {title: 'Sous-titre association', block: 'h3', styles: {color: '#003c66'}},
                {title: 'Sous-titre plateforme', block: 'h3', styles: {color: '#0e5152'}},
                {title: 'Sous-titre résidences', block: 'h3', styles: {color: '#583e00'}},
                {title: 'Sous-titre restauration', block: 'h3', styles: {color: '#334405'}},
                {title: 'Sous-titre services', block: 'h3', styles: {color: '#5a3a1d'}},
                {title: 'Sous-titre contact', block: 'h3', styles: {color: '#5a0004'}}
        ]
});
		</script>
		<?php } ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="sss/sss.min.js"></script>
		<script>
		jQuery(function($) {
		//vitesse du diaporama jquery
		$('.slider').sss({speed : 5600});
		});
		//Permet ensuite de switcher la couleur de fond du site
		function color(color) {
			$('body').css('background',color);
		}
		</script>
	</head>

	<body style="background: none repeat scroll 0% 0% <?php if(!empty($_SESSION['backgroundBody'])){ echo $_SESSION['backgroundBody']; } else { echo '#04467e'; } ?>;">
	<!-- La couleur du body est géré par une variable de session -->
	<div class="mainWrapper">
		<div onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');" onMouseOver="color('#04467e');">
			<div class="box1 boxAdresse" onclick="location.href='index.php?section=residenceAnneFrank';">FJT ANNE FRANK<br>21, rue du bloc 62000 ARRAS</div>
			<div class="box2 boxAdresse" onclick="location.href='index.php?section=residenceClairLogis';">FJT CLAIR LOGIS<br>3, rue du Paul Perin 62000 ARRAS</div>
			<div class="box3 boxAdresse" onclick="location.href='index.php?section=residenceNobel';">FJT NOBEL<br>7, rue Diderot 62000 ARRAS</div>
			<div class="box4 boxAdresse" onclick="location.href='index.php?section=plateformeLogement';">PLATEFORME LOGEMENT<br>34 bis, Grand'Place 62000 ARRAS</div>
			<div id="connexion">
				<?php
				if(isConnected()) {?>
					<div class="connexion_text connexion_bold"><?php langue('Bienvenue', 'Welcome'); ?></div>
					<div class="connexion_text"><a href="index.php?section=parameters"><?php langue('Paramètres', 'Parameters'); ?></a></div>
					<div class="connexion_text"><a href="index.php?section=index&amp;dislog=true"><?php langue('Se déconnecter', 'Log out'); ?></a></div>
			<?php 	if(isAdminSomewhere())
					// Si l'utilisateur est admin
					{ ?> 
						<div class="language"><a href="index.php?section=FR<?php if(!empty($_GET['section'])) { echo '&amp;sect='.$_GET['section']; } ?>"><img src="/4AJ/view/graphicRessources/france.png" alt="france"/></a><a href="index.php?section=EN<?php if(!empty($_GET['section'])) { echo '&amp;sect='.$_GET['section']; } ?>"><img src="/4AJ/view/graphicRessources/uk.png" alt="uk"/></a></div>
						<div class="connexion_inscription connexion_bold">
							<a href="admin/index.php?section=main">Partie administrateur</a>
						</div>
							<?php if(isSuperAdmin()) { ?>
								<!-- Si super admin, il peut passer en mode édition -->
								<div class="connexion_inscription connexion_bold">
								<?php if(empty($_SESSION['superAdminOn'])) { ?>
									<a href="index.php?section=index&amp;superAdminOn=true&amp;get=<?php echo $_GET['section']; ?>">Mode édition</a>
								<?php } else { ?>
									<!-- Cela veut dire qu'il est déjà superAdmin, donc lien pour désactiver -->
									<a href="index.php?section=index&amp;finSuperAdminOn=true&amp;get=<?php echo $_GET['section']; ?>">Fin mode édition</a>
								<?php 	}
								echo '</div>'; 
								}?>
					<?php 
						}
					}
				else { ?>
				<div class="connexion_text connexion_bold"><?php langue('Connexion', 'Log in'); ?></div>
				<form method="post">
					<div class="connexion_text"><label for="mail">Email :</label></div><div><input required type="email" id="mail" name="mail" /></div>
					<div class="connexion_text"><label for="password"><?php langue('Mot de passe :', 'Password :'); ?></label></div><div><input required type="password" id="password" name="password" /></div>
					<div class="connexion_submit"><input id="submit" type="submit" value="<?php langue('Envoyer', 'Send'); ?>"/></div>
				</form>
				<div class="connexion_text"><em><a id="lostPwd" href="index.php?section=lostPassword"><?php langue('Mot de passe perdu?', 'Forgotten your password?'); ?></a></em></div>
				<div class="language"><a href="index.php?section=FR<?php if(!empty($_GET['section'])) { echo '&amp;sect='.$_GET['section']; } ?>"><img src="/4AJ/view/graphicRessources/france.png" alt="france"/></a><a href="index.php?section=EN<?php if(!empty($_GET['section'])) { echo '&amp;sect='.$_GET['section']; } ?>"><img src="/4AJ/view/graphicRessources/uk.png" alt="uk"/></a><a href="mobile/index.php?section=mobile">mobile</a></div>
				<div class="connexion_inscription connexion_bold"><a href="index.php?section=inscription"><?php langue('Inscription', 'Register'); ?></a></div>
				<?php } ?>
				<?php
				if(!empty($message))
				{
					echo '<div class="connexion_text">'.$message.'</div>'; 
				} ?>
			</div>
		</div>
		<div id="banniere" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');" onMouseOver="color('#04467e');">
			<a href="index.php?section=index"><em id="dateAujourdhui"><?php echo $dateAujourdhui; ?></em></a>
			<a href="index.php?section=index"><img id="bannierelogo" src="/4AJ/view/graphicRessources/bannierelogo.png" alt="logo bannière"/></a>
			<ul id="sContent">
				<li><a href="index.php?section=index"><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></a></li>
				<li><a href="index.php?section=index"><img src="/4AJ/view/graphicRessources/2.jpg" alt="image bannière"/></a></li>
				<li><a href="index.php?section=index"><img src="/4AJ/view/graphicRessources/3.jpg" alt="image bannière"/></a></li>
				<li><a href="index.php?section=index"><img src="/4AJ/view/graphicRessources/2.jpg" alt="image bannière"/></a></li>
				<li><a href="index.php?section=index"><img src="/4AJ/view/graphicRessources/1.jpg" alt="image bannière"/></a></li>
			</ul>
		</div>
		<nav id="mainMenu">
			<ul>
				<li onMouseOver="color('#3c255e');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSection('index')){?>id="active_item0"<?php } else { ?>id="item0"<?php } ?> href="index.php?section=index"><?php langue('Accueil', 'Home'); ?></a></li>
				<li onMouseOver="color('#387fb1');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSous_Section_association()){?>id="active_item1"<?php } else { ?>id="item1"<?php } ?> href="index.php?section=association"><?php langue('L\'association', 'The association'); ?></a>
					<ul id="s_item1">
      					<li><a href="index.php?section=quiSommesNous"><?php langue('Qui sommes-nous?', 'Who are we?'); ?></a></li>
      					<li><a class="last_item" href="index.php?section=plateformeLogement"><?php langue('Plateforme Logement', 'Housing platform'); ?></a></li>
    				</ul>
    			</li>	
				<li onMouseOver="color('#dec32c');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSous_Section_nosResidences()){?>id="active_item2"<?php } else { ?>id="item2"<?php } ?> href="index.php?section=nosResidences"><?php langue('Nos résidences', 'Our residences'); ?></a>
					<ul id="s_item2">
      					<li><a href="index.php?section=residenceAnneFrank">Anne Frank</a></li>
      					<li><a href="index.php?section=residenceClairLogis">Clair Logis</a></li>
      					<li><a class="last_item" href="index.php?section=residenceNobel">Nobel</a></li>
    				</ul>
    			</li>
				<li onMouseOver="color('#92a224');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSection('restauration')){?>id="active_item3"<?php } else { ?>id="item3"<?php } ?> href="index.php?section=restauration"><?php langue('Restauration', 'Restauration'); ?></a></li>
				<li onMouseOver="color('#b36e30');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSection('services')){?>id="active_item4"<?php } else { ?>id="item4"<?php } ?> href="index.php?section=services">Services</a>
				<li onMouseOver="color('#4e0105');" onMouseOut="color('<?php echo $_SESSION['backgroundBody']; ?>');"><a <?php if (openSous_Section_contact()){?>id="active_item5"<?php } else { ?>id="item5"<?php } ?> href="index.php?section=contact">Contact</a>
					<ul id="s_item5">
      					<li><a class="correct_size" href="index.php?section=faq">FAQ</a></li>
      					<li><a class="correct_size" href="index.php?section=liensUtiles"><?php langue('Liens utiles', 'Helpful links'); ?></a></li>
      					<li><a class="correct_size" href="index.php?section=memento"><?php langue('Mémento', 'Summary'); ?></a></li>
      					<li><a class="last_item correct_size" href="index.php?section=livreOr"><?php langue('Livre d\'or', 'Guest book'); ?></a></li>
    				</ul>
    			</li>	
			</ul>
		</nav>