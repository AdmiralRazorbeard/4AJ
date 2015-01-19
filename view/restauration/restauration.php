<?php include_once '/view/includes/header.php'; ?>
			<div class="restauration element contentWrapper edition_mode">
				<?php tinymcetxt('restauration'); ?>
				<br />
				<!-- MENU DE LA SEMAINE -->
				<p>



				</p>
				<!-- FIN MENU DE LA SEMAINE -->
				<!-- DEBUT CALENDRIER POUR INSCRIPTION -->
				<?php if($accessRepas) { ?> 
				<p>Choisissez l'une des deux résidences et cliquez sur les <b id='caseVerte'>cases vertes</b> pour réserver, cliquez sur les <b id='caseOrange'>cases oranges</b> si vous voulez déréserver (vous ne pouvez plus reserver sur les <b id='caseGrise'>cases grises</b>):</p>
				<br>
				<div id="repasAnneFrank">
					<span><strong><?php langue('Repas Anne Frank', 'Anne Frank meal'); ?></strong></span>
					<form method="post">
						<label for="semaineAnneFrank"><?php langue('Semaine du', 'Week of'); ?> : </label>
						<select name="semaineAnneFrank" id="semaineAnneFrank">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
					<table>
							<!-- Tableau de la semaine -->
						<tr>
							<td></td>
							<?php
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
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 1)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_1_1"
									<?php if($tmp == 1) { echo 'class="false">non-réservé'; } elseif($tmp == 2) { echo 'class = "true">réservé';  } else { echo 'class="invalide">'; } ?>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td class="infoTableau">
								<?php langue('Soir', 'Dinner'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 1)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_0_1"
									<?php if($tmp == 1) { echo 'class="false">non-réservé'; } elseif($tmp == 2) { echo 'class = "true">réservé';  } else { echo 'class="invalide">'; } ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
				<input id="buttonDisconnect" type="submit" onclick="location.href='index.php?section=index&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnet'); ?>">
				<br>
				<br>
						<!--  REPAS CLAIR LOGIS -->
				<div id="repasClairLogis">
					<span><strong><?php langue('Repas Clair Logis', 'Clair Logis meal'); ?></strong></span>
					<form method="post">
						<label for="semaineClairLogis"><?php langue('Semaine du', 'Week of'); ?> : </label>
						<select name="semaineClairLogis" id="semaineClairLogis">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
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
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 2)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_1_2"
									<?php if($tmp == 1) { echo 'class="false">non-réservé'; } elseif($tmp == 2) { echo 'class = "true">réservé';  } else { echo 'class="invalide">'; } ?>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td class="infoTableau">
								<?php langue('Soir', 'Dinner'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 2)
								?>
								<td value="<?php echo $value['numero']; ?>_<?php echo $value['mois']; ?>_<?php echo $value['annee']; ?>_0_2"
									<?php if($tmp == 1) { echo 'class="false">non-réservé'; } elseif($tmp == 2) { echo 'class = "true">réservé';  } else { echo 'class="invalide">'; } ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
				<input id="buttonDisconnect" type="submit" onclick="location.href='index.php?section=index&amp;dislog=true';" value="<?php langue('J\'ai fini de réserver et je veux me déconnecter du site', 'I\'ve finished my reservations and I want to disconnet from the website'); ?>">
				<?php } ?><br />
				<!-- FIN CALENDRIER -->
					<script type="text/javascript">
					$(document).ready(function() {
				        $('body').change('#semaineAnneFrank', function() {
				      		var weekValue=$("#semaineAnneFrank").val();
				          	$('#repasAnneFrank').load("index.php?section=restauration&semaineAnneFrank="+weekValue+" "+"#repasAnneFrank");
				       	});
				       	$('body').change('#semaineClairLogis', function() {
				      		var weekValue2=$("#semaineClairLogis").val();
				          	$('#repasClairLogis').load("index.php?section=restauration&semaineClairLogis="+weekValue2+" "+"#repasClairLogis");
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
					       			$.post( "index.php?section=restauration", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  	if(<?php echo $validChange?>==1)
									  	{
									  		$('.false.isselected').html('réservé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
										}
										else
										{
											$('.false.isselected').html('');
											$('.false.isselected').addClass('invalide').removeClass('false').removeClass('isselected');
										}
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true")
								{
					       			$.post( "index.php?section=restauration", {semaineAnneFrank: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  	if(<?php echo $validChange?>==1)
									  	{
									  		$('.true.isselected').html('non-réservé');
									    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
										}
										else
										{
											$('.true.isselected').html('');
											$('.true.isselected').addClass('invalide').removeClass('true').removeClass('isselected');
										}
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
					       			$.post( "index.php?section=restauration", {semaineClairLogis: weekValue2, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  	if(<?php echo $validChange?>==1)
									  	{
									  		$('.false.isselected').html('réservé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
										}
										else
										{
											$('.false.isselected').html('');
											$('.false.isselected').addClass('invalide').removeClass('false').removeClass('isselected');
										}
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true")
								{
					       			$.post( "index.php?section=restauration", {semaineClairLogis: weekValue2, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  	if(<?php echo $validChange?>==1)
									  	{
									  		$('.true.isselected').html('non-réservé');
									    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
										}
										else
										{
											$('.true.isselected').html('');
											$('.true.isselected').addClass('invalide').removeClass('true').removeClass('isselected');
										}
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
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>