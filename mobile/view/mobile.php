<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="/4AJ/mobile/view/styleMobile.css" />
		<link rel="icon" type="image/png" href="/4AJ/view/graphicRessources/favicon.jpg" >
		<meta charset="utf-8">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head> 
	<body>
		<div class="restaurationMobile">
			<?php if(empty($_SESSION['log']) || empty($_SESSION['mail'])) { ?>
				<form action="index.php?section=mobile" method="post">
					<label for="mail">Email :</label><input required type="email" id="mail" name="mail" />
					<label for="password">Mot de passe :</label><input required type="password" id="password" name="password" />
					<fieldset data-role="controlgroup" data-type="horizontal">
					    <legend>Choix residence :</legend>
					    <input required name="choixResidence" id="radio-choice-residence1" value="1" type="radio">
					    <label for="radio-choice-residence1">Anne Frank</label>
					    <input name="choixResidence" id="radio-choice-residence2" value="2" type="radio">
					    <label for="radio-choice-residence2">Clair logis</label>
					</fieldset>
					<input id="submit" type="submit" value="Envoyer"/>
				</form>
			<?php } ?>
			<!-- DEBUT CALENDRIER POUR INSCRIPTION -->
			<?php if($accessRepas){ 
					if(!$blocageReservation) {
						if($_SESSION['residenceMobile']==1) { ?>
			<input class="buttonDisconnect" type="submit" onclick="location.href='index.php?section=mobile&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnect from the website'); ?>">
			<div id="repasAnneFrank">
				<span><strong><?php langue('Repas Anne Frank', 'Anne Frank meal'); ?></strong></span>
				<table>
					<!-- Tableau de la semaine -->
					<tr>
						<?php
						//On génère ici l'intitulé de chaque collonne du tableau
						foreach ($semaineAnneFrank as $key => $value) { ?>
							<th>
								<?php langue(ucfirst($key), $value['jourEN']); ?><br><?php echo $value['numero']; langue('', $value["suffixe"]); ?><br><?php langue($mois[$value['mois']], $value['moisEN']); ?>
							</th>
				<?php	}
						?>
					</tr>
					<tr>
						<?php 	
						//On calcule pour chaque case sa couleur puis on l'affiche (midi)
						foreach ($semaineAnneFrank as $key => $value) { 
						$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 1)
							?>
							<td <?php if($tmp == 1) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 false">libre');} 
										elseif($tmp == 2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 true">réservé');} 
										elseif($tmp == 3) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 invalide">');} 
										elseif($tmp == 4) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 falseBlocked">libre');} 
										else { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 trueBlocked">réservé');} 
							?>
							</td>
				<?php	} ?>
					</tr>
					<tr>
						<?php
						//On calcule pour chaque case sa couleur puis on l'affiche (soir)
						foreach ($semaineAnneFrank as $key => $value) { 
						$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 1)
							?>
							<td <?php if($tmp == 1) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 false">libre');} 
										elseif($tmp == 2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 true">réservé');} 
										elseif($tmp == 3) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 invalide">');} 
										elseif($tmp == 4) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 falseBlocked">libre');} 
										else { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 trueBlocked">réservé');} 
							?>
							</td>
				<?php	} ?>
					</tr>
				</table>
			</div>
			<?php } else { ?>
			<!--  REPAS CLAIR LOGIS -->
			<input class="buttonDisconnect" type="submit" onclick="location.href='index.php?section=mobile&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnect from the website'); ?>">
			<div id="repasClairLogis">
				<span><strong><?php langue('Repas Clair Logis', 'Clair Logis meal'); ?></strong></span>
				<table>
						<!-- Tableau de la semaine -->
					<tr>
						<?php
						foreach ($semaineClairLogis as $key => $value) { ?>
							<th>
								<?php langue(ucfirst($key), $value['jourEN']); ?> <?php echo $value['numero']; langue('', $value["suffixe"]); ?> <?php langue($mois[$value['mois']], $value['moisEN']); ?>
							</th>
				<?php	}
						?>
					</tr>
					<tr>
						<?php
						//On calcule pour chaque case sa couleur puis on l'affiche (midi)
						foreach ($semaineClairLogis as $key => $value) { 
						$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 2)
							?>
							<td <?php if($tmp == 1) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 false">libre');} 
										elseif($tmp == 2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 true">réservé');} 
										elseif($tmp == 3) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 invalide">');} 
										elseif($tmp == 4) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 falseBlocked">libre');} 
										else { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 trueBlocked">réservé');} 
							?>
							</td>
				<?php	} ?>
					</tr>
					<tr>
						<?php
						//On calcule pour chaque case sa couleur puis on l'affiche (soir)
						foreach ($semaineClairLogis as $key => $value) { 
						$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 2)
							?>
							<td <?php if($tmp == 1) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 false">libre');} 
										elseif($tmp == 2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 true">réservé');} 
										elseif($tmp == 3) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 invalide">');} 
										elseif($tmp == 4) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 falseBlocked">libre');} 
										else { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 trueBlocked">réservé');} 
							?>
							</td>
				<?php	} ?>
					</tr>
				</table>
				<!-- FIN CALENDRIER -->
			</div>
			<?php } } else {?><h2 style="color: #a4b819; text-shadow: 1px 1px 0.6px #103b5a;">Réservations</h2><h4>Réservations momentanément suspendues</h4><h4>Raison avancée: <?php echo($raisonBlocage);?></h4><?php }
					} ?>
				<script type="text/javascript">
				$(document).ready(function() {
					var weekValueAnneFrank=<?php echo $semaineDePlus; ?>;
					console.log(weekValueAnneFrank);
			       	$('body').on('swipeleft', '#repasAnneFrank', function(event) {
			       		event.stopImmediatePropagation();
			      		weekValueAnneFrank=weekValueAnneFrank+1;
			      		console.log(weekValueAnneFrank);
			      		$('#repasAnneFrank').fadeOut(100, function(){
			          		$('#repasAnneFrank').load("index.php?section=mobile&semaineAnneFrank="+weekValueAnneFrank+" "+"#repasAnneFrank", function(){
			          			$('#repasAnneFrank').fadeIn(100);
			         		});
			          	});
			       	});
			       	$('body').on('swiperight', '#repasAnneFrank', function(event) {
			       		event.stopImmediatePropagation();
			      		if(weekValueAnneFrank-1>=0){
			      			weekValueAnneFrank--;
			      			$('#repasAnneFrank').fadeOut(100, function(){
			          			$('#repasAnneFrank').load("index.php?section=mobile&semaineAnneFrank="+weekValueAnneFrank+" "+"#repasAnneFrank", function(){
									$('#repasAnneFrank').fadeIn(100);
								});
							});		          	
			          	}
			       	});
			       	var weekValueClairLogis=<?php echo $semaineDePlus; ?>;
			       	$('body').on('swipeleft', '#repasClairLogis', function(event) {
			       		event.stopImmediatePropagation();
			      		weekValueClairLogis++;
			      		$('#repasClairLogis').fadeOut(100, function(){
			          		$('#repasClairLogis').load("index.php?section=mobile&semaineClairLogis="+weekValueClairLogis+" "+"#repasClairLogis", function(){
			          			$('#repasClairLogis').fadeIn(100);
			         		});
			          	});
			       	});
			       	$('body').on('swiperight', '#repasClairLogis', function(event) {
			       		event.stopImmediatePropagation();
			      		if(weekValueClairLogis-1>=0){
			      			weekValueClairLogis--;
			      			$('#repasClairLogis').fadeOut(100, function(){
			          			$('#repasClairLogis').load("index.php?section=mobile&semaineClairLogis="+weekValueClairLogis+" "+"#repasClairLogis", function(){
									$('#repasClairLogis').fadeIn(100);
								});
							});		          	
			          	}
			       	});
			       	$('body').on('tap', 'td', function() {
			       		var informations=$(this).attr('class');
		      			var tmp = informations.split(' ');
		      			var donnees = tmp[0].split('_');
			      		var classe=tmp[1];
			      		$(this).addClass('isselected');
			      		var residence="";
			      		var semaine="semaine";
			      		if(donnees[4]==1){
			      			residence="AnneFrank";
			      			semaine+=residence;
			      		}
			      		else{
			      			residence="ClairLogis";
			      			semaine+=residence;
			      		}
		      			var weekValue=$("#semaine"+residence).val();
		      			if (classe=="false")
		       			{
			       			$.post( "index.php?section=mobile", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
							  .done(function(data) {
							  	if(data==1)
							  	{
							  		$('.false.isselected').html('réservé');
							    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
								}
								else
								{
									$('.false.isselected').html('libre');
									$('.false.isselected').addClass('falseBlocked').removeClass('false').removeClass('isselected');
								}
							  })
							  .fail(function(){
							   alert('Erreur');
							  })
						}
						else if (classe=="true")
						{
			       			$.post( "index.php?section=mobile", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
							  .done(function(data) {
							  	if(data==1)
							  	{
							  		$('.true.isselected').html('libre');
							    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
								}
								else
								{
									$('.true.isselected').html('réservé');
									$('.true.isselected').addClass('trueBlocked').removeClass('true').removeClass('isselected');
								}
							  })
							  .fail(function(){
								alert('Erreur');
							  })
						}
						else if(classe=="trueBlocked")
						{
							$('.trueBlocked.isselected').removeClass('isselected');
						}
						else if(classe=="falseBlocked")
						{
							$('.falseBlocked.isselected').removeClass('isselected');
						}
						else if(classe=="invalide")
						{
							$('.invalide.isselected').removeClass('isselected');
						}
			       	});
				});
			</script>
		</div>
	</body>
</html>