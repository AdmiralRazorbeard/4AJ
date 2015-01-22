<?php include_once '/view/includes/header.php'; ?>

			<div class="contentWrapper">
				<h1>Verrouiller un jour</h1>
				<a href="index.php?section=gestionRepas">Retour</a><br>

					<!-- Choix de l'interdiction ou du simple blocage -->
					<input type="radio" name="choixDeLinterdiction" class="choixDeLinterdiction" checked="checked" value="interdire"/> <label>Interdire les réservations</label>
                    <input type="radio" name="choixDeLinterdiction" class="choixDeLinterdiction" value="bloquer"/> <label>Bloquer les réservations</label>
                    <select id="fonctionChoisie" name="fonctionChoisie">
                    <?php foreach ($membreFonction as $key => $listeFonction) { ?>
                    	<option value="<?php echo $listeFonction['id']; ?>"><?php if($listeFonction['nom']=="Public"){ echo "Tout le monde"; }else{ echo $listeFonction['nom'];} ?></option>
                    <?php } ?>
					</select>

				<div id="repasAnneFrank">
					<legend>
						Verrouiller un jour de repas à résidence Anne Frank
					</legend>
					<form method="post">
						<label for="semaineAnneFrank">Semaine du : </label>
						<select name="semaineAnneFrank" id="semaineAnneFrank">
							<?php
							$i = 0;
							while($i < 18)
							{ ?>
								<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
					<table class="gestionRepas">
							<!-- Tableau de la semaine -->
						<tr>
							<td></td>
							<?php
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<th>
									<?php echo ucfirst($key); ?> <?php echo $value['numero']; ?> <?php echo $mois[$value['mois']]; ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td class="infoTableau">
								Midi
							</td>
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 1, 1)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_1_1"
									<?php if($tmp) { echo 'class="false">verrouillé'; } else { echo 'class = "true">non-verrouillé'; } ?>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td class="infoTableau">
								Soir
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 0, 1)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_0_1"
									<?php if($tmp) { echo 'class="false">verrouillé'; } else { echo 'class = "true">non-verrouillé'; } ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
				<br>
				<div id="repasClairLogis">
					<legend>
						Verrouiller un jour de repas à résidence Clair Logis
					</legend>
					<form method="post">
						<label for="semaineClairLogis">Semaine du : </label>
						<select name="semaineClairLogis" id="semaineClairLogis">
							<?php
							$i = 0;
							while($i < 18)
							{ ?>
								<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
					<table class="gestionRepas">
							<!-- Tableau de la semaine -->
						<tr>
							<td></td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<th>
									<?php echo ucfirst($key); ?> <?php echo $value['numero']; ?> <?php echo $mois[$value['mois']]; ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td class="infoTableau">
								Midi
							</td>
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 1, 2)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_1_2"
									<?php if($tmp) { echo 'class="false">verrouillé'; } else { echo 'class = "true">non-verrouillé'; } ?>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td class="infoTableau">
								Soir
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 0, 2)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_0_2"
									<?php if($tmp) { echo 'class="false">verrouillé'; } else { echo 'class = "true">non-verrouillé'; } ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
			</div>
			<script type="text/javascript">
					$(document).ready(function() {
						//Mise a jour de la semaine
				        $('body').on('change', '#semaineAnneFrank', function() {
				        	console.log('fonction1');
				      		var weekValue=$("#semaineAnneFrank").val();
				          	$('#repasAnneFrank').load("index.php?section=verrouillerRepas&semaineAnneFrank="+weekValue+" "+"#repasAnneFrank");
				       	});
				       	$('body').on('change', '#semaineClairLogis', function() {
				       		console.log('fonction2');
				      		var weekValue2=$("#semaineClairLogis").val();
				          	$('#repasClairLogis').load("index.php?section=verrouillerRepas&semaineClairLogis="+weekValue2+" "+"#repasClairLogis");
				       	});
				       	//Mise a jour des boutons
				       	$('body').on('click', 'td', function() {
				       		//On cherche d'abord le type d'interdiction
				       		var typeInterdiction=$(".choixDeLinterdiction:checked").val();
				      		//On collecte puis on traite les infos de la case que l'on a coché
				      		var informations=$(this).attr('value');
				      		var classe=$(this).attr('class');
				      		$(this).addClass('isselected');
				      		console.log('fonction3');
				      		var donnees = informations.split('_');
				      		if(donnees[4]==1){
				      			var weekValue=$("#semaineAnneFrank").val();
				      			var fonctionChoisie=$("#fonctionChoisie").val();
				      			if(typeInterdiction== "interdire"){
				      			//Si on est dans l'interdiction et non dans le blocage
				      				if (classe=="false"){
					       				$.post( "index.php?section=verrouillerRepas", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .done(function() {
										  		$('.false.isselected').html('non-vérouillé');
										    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
										  })
										  .fail(function(){
										   alert('Erreur');
										  })
									}
									if (classe=="true"){
						       			$.post( "index.php?section=verrouillerRepas", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .done(function() {
										  		$('.true.isselected').html('vérouillé');
										    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
										  })
										  .fail(function(){
											alert('Erreur');
										  })
									}
									if (classe=="blocked"){
										//Si c'est bloqué l'interdiction est plus forte que le blocage, elle detruit donc ce dernier
						       			$.post( "index.php?section=verrouillerRepas", {fonction: fonctionChoisie, semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .fail(function(){
											alert('Erreur');
										  })
										$.post( "index.php?section=verrouillerRepas", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .done(function() {
										  		$('.blocked.isselected').html('vérouillé');
										    	$('.blocked.isselected').addClass('false').removeClass('blocked').removeClass('isselected');
										  })
										  .fail(function(){
											alert('Erreur');
										  })
									}
				      			}
				      			else{
				      			//Si on est dans le blocage et non dans l'interdiction
									if (classe=="true"){
						       			$.post( "index.php?section=verrouillerRepas", {fonction: fonctionChoisie, semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .done(function() {
										  		$('.true.isselected').html('bloqué');
										    	$('.true.isselected').addClass('blocked').removeClass('true').removeClass('isselected');
										  })
										  .fail(function(){
											alert('Erreur');
										  })
									}
									if (classe=="blocked"){
						       			$.post( "index.php?section=verrouillerRepas", {fonction: fonctionChoisie, semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
										  .done(function() {
										  		$('.blocked.isselected').html('non-vérouillé');
										    	$('.blocked.isselected').addClass('true').removeClass('blocked').removeClass('isselected');
										  })
										  .fail(function(){
											alert('Erreur');
										  })
									}
				      			}
				       		}
				       		else{
				       			var weekValue2=$("#semaineClairLogis").val();
				      			if (classe=="false"){
					       			$.post( "index.php?section=verrouillerRepas", {semaineClairLogis: weekValue2, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.false.isselected').html('non-vérouillé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true"){
					       			$.post( "index.php?section=verrouillerRepas", {semaineClairLogis: weekValue2, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.true.isselected').html('vérouillé');
									    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
				  			}
				       	});
					});
				</script>
		</div>
	</body>
	</html>
