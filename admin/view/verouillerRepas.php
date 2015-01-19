<?php include_once '/view/includes/header.php'; ?>

			<div class="contentWrapper">
				<h1>Verrouiller un jour</h1>
				<a href="index.php?section=gestionRepas">Retour</a>
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
				        $('body').change('#semaineAnneFrank', function() {
				      		var weekValue=$("#semaineAnneFrank").val();
				          	$('#repasAnneFrank').load("index.php?section=verrouillerRepas&semaineAnneFrank="+weekValue+" "+"#repasAnneFrank");
				       	});
				       	$('body').change('#semaineClairLogis', function() {
				      		var weekValue2=$("#semaineClairLogis").val();
				          	$('#repasClairLogis').load("index.php?section=verrouillerRepas&semaineClairLogis="+weekValue2+" "+"#repasClairLogis");
				       	});
				       	$('body').on('click', 'td', function() {
				      		var informations=$(this).attr('value');
				      		var classe=$(this).attr('class');
				      		$(this).addClass('isselected');
				      		var donnees = informations.split('_');
				      		if(donnees[4]==1)
				      		{
				      			var weekValue=$("#semaineAnneFrank").val();
				      			if (classe=="false")
				       			{
					       			$.post( "index.php?section=verrouillerRepas", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.false.isselected').html('non-vérouillé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true")
								{
					       			$.post( "index.php?section=verrouillerRepas", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.true.isselected').html('vérouillé');
									    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
									  })
									  .fail(function(){
										alert('Erreur');
									  })
								}
				       		}
				       		else
				       		{
				       			var weekValue2=$("#semaineClairLogis").val();
				      			if (classe=="false")
				       			{
					       			$.post( "index.php?section=verrouillerRepas", {semaineClairLogis: weekValue2, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.false.isselected').html('non-vérouillé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true")
								{
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
