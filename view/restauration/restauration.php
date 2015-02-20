<?php include_once 'view/includes/header.php'; ?>
			<div class="restauration element contentWrapper edition_mode">
				<!-- Affichage des menus si la personne est deconnectée -->
				<?php if(!isConnected()){ ?>
				<h2 style="color: #a4b819; font-size:16px; text-shadow: 1px 1px 0.6px #103b5a;"><?php langue('Télécharger le menu', 'Download the menu'); ?></h2>
				<div id="menuAnneFrank">
					<div class="selectionSemaine">
						<form method="post">
							<label for="menuSemaineAnneFrank"><?php langue('[Anne Frank] Semaine du', '[Anne Frank] Week of'); ?> : </label>
							<select name="menuSemaineAnneFrank" id="menuSemaineAnneFrank">
								<?php
								//generation liste semaines que l'on va pouvoir ensuite selectionner pour changer la semaine grâce à jquery
								$i = 0;
								while($i < (10+$semaineDePlus))
								{ ?>
									<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
						<?php	$i ++;
								}
								?>
							</select>
						</form>
					</div>
					<?php if($linkAnneFrank!=NULL){ ?>
					<!-- Si pas de menu cette semaine, ne rien afficher -->
					<div class="lienMenu"><img src="view/graphicRessources/pdf.png" alt="icone pdf"/><input type="submit" onclick="location.href='index.php?section=telechargerMenu<?php echo $linkAnneFrank; ?>';" value="Télécharger le menu de la semaine"></div>
					<?php } ?>
				</div>
				<div id="menuClairLogis">
					<div class="selectionSemaine">
						<form method="post">
							<label for="menuSemaineClairLogis"><?php langue('[Clair Logis] Semaine du', '[Clair Logis] Week of'); ?> : </label>
							<select name="menuSemaineClairLogis" id="menuSemaineClairLogis">
								<?php
								//generation liste semaines que l'on va pouvoir ensuite selectionner pour changer la semaine grâce à jquery
								$i = 0;
								while($i < (10+$semaineDePlus))
								{ ?>
									<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
						<?php	$i ++;
								}
								?>
							</select>
						</form>
					</div>
					<?php if($linkClairLogis!=NULL){ ?>
					<!-- Si pas de menu cette semaine, ne rien afficher -->
					<div class="lienMenu"><img src="view/graphicRessources/pdf.png" alt="icone pdf"/><input type="submit" onclick="location.href='index.php?section=telechargerMenu<?php echo $linkClairLogis; ?>';" value="Télécharger le menu de la semaine"></div>
					<?php } ?>
				</div>
				<hr>
				<?php } ?>


				<!-- DEBUT CALENDRIER POUR INSCRIPTION -->
				<?php if($accessRepas){ 
						if(!$blocageReservation) { ?>
				<h2 style="color: #a4b819; text-shadow: 1px 1px 0.6px #103b5a;">Réservations</h2>
				<p>Choisissez l'une des deux résidences et cliquez sur les <b id='caseVerte'>cases vertes</b> pour réserver, cliquez sur les <b id='caseOrange'>cases oranges</b> si vous voulez déréserver (vous ne pouvez plus réserver sur les <b id='caseGrise'>cases grises</b>):</p>
				<br>
				<div id="repasAnneFrank">
					<div class="divSelectionEtMenu">
						<div class="selectionSemaine">
							<span><strong><?php langue('Repas Anne Frank', 'Anne Frank meal'); ?></strong></span>
							<form method="post">
								<label for="semaineAnneFrank"><?php langue('Semaine du', 'Week of'); ?> : </label>
								<select name="semaineAnneFrank" id="semaineAnneFrank">
									<?php
									//generation liste semaines que l'on va pouvoir ensuite selectionner pour changer la semaine grâce à jquery
									$i = 0;
									while($i < (10+$semaineDePlus))
									{ ?>
										<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
							<?php	$i ++;
									}
									?>
								</select>
							</form>
						</div>
						<?php if($linkAnneFrank!=NULL){ ?>
						<!-- Si pas de menu cette semaine, ne rien afficher -->
						<div class="lienMenu"><img src="view/graphicRessources/pdf.png" alt="icone pdf"/><input type="submit" onclick="location.href='index.php?section=telechargerMenu<?php echo $linkAnneFrank; ?>';" value="Télécharger le menu de la semaine"></div>
						<?php } ?>
					</div>
					<table>
						<!-- Tableau de la semaine -->
						<tr>
							<td></td>
							<?php
							//On génère ici l'intitulé de chaque collonne du tableau
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<th>
									<?php langue(ucfirst($key), $value['jourEN']); ?> <?php echo $value['numero']; langue('', $value["suffixe"]); ?> <?php langue($mois[$value['mois']], $value['moisEN']); ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td class="infoTableau">
								<?php langue('Midi', 'Lunch'); ?>
							</td>
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
							<td class="infoTableau">
								<?php langue('Soir', 'Dinner'); ?>
							</td>
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
				<input class="buttonDisconnect" type="submit" onclick="location.href='index.php?section=index&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnect'); ?>">
				<br>
				<br>
				<!--  REPAS CLAIR LOGIS -->
				<div id="repasClairLogis">
					<div class="divSelectionEtMenu">
						<div class="selectionSemaine">
							<span><strong><?php langue('Repas Clair Logis', 'Clair Logis meal'); ?></strong></span>
							<form method="post">
								<label for="semaineClairLogis"><?php langue('Semaine du', 'Week of'); ?> : </label>
								<select name="semaineClairLogis" id="semaineClairLogis">
									<?php
									//generation liste semaines que l'on va pouvoir ensuite selectionner pour changer la semaine grâce à jquery
									$i = 0;
									while($i < (10+$semaineDePlus))
									{ ?>
										<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
							<?php	$i ++;
									}
									?>
								</select>
							</form>
						</div>
						<?php if($linkClairLogis!=NULL){ ?>
						<!-- Si pas de menu cette semaine, ne rien afficher -->
						<div class="lienMenu"><img src="view/graphicRessources/pdf.png" alt="icone pdf"/><input type="submit" onclick="location.href='index.php?section=telechargerMenu<?php echo $linkClairLogis; ?>';" value="Télécharger le menu de la semaine"></div>
						<?php } ?>
					</div>
					<table>
							<!-- Tableau de la semaine -->
						<tr>
							<td></td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<th>
									<?php langue(ucfirst($key), $value['jourEN']); ?> <?php echo $value['numero']; langue('', $value["suffixe"]); ?> <?php langue($mois[$value['mois']], $value['moisEN']); ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td class="infoTableau">
								<?php langue('Midi', 'Lunch'); ?>
							</td>
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
							<td class="infoTableau">
								<?php langue('Soir', 'Dinner'); ?>
							</td>
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
				<input class="buttonDisconnect" type="submit" onclick="location.href='index.php?section=index&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnect from the website'); ?>">
				<br>
				<br>
				<hr>
				<?php } else {?><h2 style="color: #a4b819; text-shadow: 1px 1px 0.6px #103b5a;">Réservations</h2><h4>Réservations momentanément suspendues</h4><h4>Raison avancée: <?php echo($raisonBlocage);?></h4><?php }
						} ?>
				<?php tinymcetxt('restauration'); ?>
				<!-- le contenu informatif de la page est placée après l'espace de réservation -->
					<script type="text/javascript">
					$(document).ready(function() {
						//Changer les semaines juste pour la selection du menu (lorsque l'on est pas connecté)
						$('body').on('change', '#menuSemaineAnneFrank', function() {
				      		var weekValue=$("#menuSemaineAnneFrank").val();
				          	$('#menuAnneFrank').load("index.php?section=restauration&semaineAnneFrank="+weekValue+" "+"#menuAnneFrank");
				       	});
				       	$('body').on('change', '#menuSemaineClairLogis', function() {
				      		var weekValue2=$("#menuSemaineClairLogis").val();
				          	$('#menuClairLogis').load("index.php?section=restauration&semaineClairLogis="+weekValue2+" "+"#menuClairLogis");
				       	});
						//Changer les semaines avec les calendrier (lorsque l'on est connecté)
				        $('body').on('change', '#semaineAnneFrank', function() {
				      		var weekValue=$("#semaineAnneFrank").val();
				          	$('#repasAnneFrank').load("index.php?section=restauration&semaineAnneFrank="+weekValue+" "+"#repasAnneFrank");
				       	});
				       	$('body').on('change', '#semaineClairLogis', function() {
				      		var weekValue2=$("#semaineClairLogis").val();
				          	$('#repasClairLogis').load("index.php?section=restauration&semaineClairLogis="+weekValue2+" "+"#repasClairLogis");
				       	});
				       	$('body').on('click', 'td', function() {
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
				       			$.post( "index.php?section=restauration", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
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
				       			$.post( "index.php?section=restauration", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
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
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>