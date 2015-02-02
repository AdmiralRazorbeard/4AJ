<?php include_once '/view/includes/header.php'; ?>

			<div class="contentWrapper">
				<h1>Interdire/Bloquer des journées</h1>
				<a href="index.php?section=gestionRepas">Retour</a><br>
					<p>	
						<em>Différences entre interdire et bloquer:</em><br>
						<em>-Si vous interdisez une journée, plus personne ne pourra réserver pour cette journée; si une personne a réservé avant que vous ayez réalisé une interdiction sur cette journée alors sa réservation sera considérée comme nulle.</em><br>
						<em>-L'interdiction est idéale pour interdire des journées comme des jours fériés, des vacances etc ...</em><br>
						<em>-Si vous bloquez une journée les personnes ne pourront plus réserver, mais si des personnes ont reservé avant que vous n'ayez réalisé un blocage alors leurs réservations seront bien comptabilisées.</em><br>
						<em>-Le blocage est idéal si vous voulez créer par exemple une limite de réservation dans le temps.</em><br>
						<em>-Vous pouvez créer des blocages différents en fonction des fonctions possédées par les membres (contrairement aux interdictions qui s'appliquent à tout le monde).</em><br>
					</p>
					<!-- Choix de l'interdiction ou du simple blocage -->
					<input type="radio" name="choixDeLinterdictionAnneFrank" class="choixDeLinterdictionAnneFrank" checked="checked" value="interdire"/> <label>Interdire les réservations</label>
                    <input type="radio" name="choixDeLinterdictionAnneFrank" class="choixDeLinterdictionAnneFrank" value="bloquer"/> <label>Bloquer les réservations</label>
                    <select disabled id="fonctionChoisieAnneFrank" name="fonctionChoisieAnneFrank">
                    <?php foreach ($membreFonction as $key => $listeFonction) { ?>
                    	<option value="<?php echo $listeFonction['id']; ?>"><?php if($listeFonction['nom']=="Public"){ echo "Tout le monde"; }else{ echo $listeFonction['nom'];} ?></option>
                    <?php } ?>
					</select>

				<div id="repasAnneFrank">
					<label>
						Verrouiller un jour de repas à résidence Anne Frank
					</label>
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
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 1, 1);
								?>
								<td <?php if($tmp) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 false">vérouillé');} 
										else{
											$tmp2 = boutonBloquer($value['numero'], $value['mois'], $value['annee'], 1, 1, $fonctionChoisieAnneFrank);
											if($tmp2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 blocked">bloqué');}else{ echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1 true">non-vérouillé');}
										} ?>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td class="infoTableau">
								Soir
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonVerrouiller($value['numero'], $value['mois'], $value['annee'], 0, 1);
								?>
								<td <?php if($tmp) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 false">vérouillé');} 
										else{
											$tmp2 = boutonBloquer($value['numero'], $value['mois'], $value['annee'], 0, 1, $fonctionChoisieAnneFrank);
											if($tmp2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 blocked">bloqué');}else{ echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1 true">non-vérouillé');}
										} ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
				<br>

			<!-- Choix de l'interdiction ou du simple blocage -->
				<input type="radio" name="choixDeLinterdictionClairLogis" class="choixDeLinterdictionClairLogis" checked="checked" value="interdire"/> <label>Interdire les réservations</label>
                <input type="radio" name="choixDeLinterdictionClairLogis" class="choixDeLinterdictionClairLogis" value="bloquer"/> <label>Bloquer les réservations</label>
                <select disabled id="fonctionChoisieClairLogis" name="fonctionChoisieClairLogis">
                <?php foreach ($membreFonction as $key => $listeFonction) { ?>
                	<option value="<?php echo $listeFonction['id']; ?>"><?php if($listeFonction['nom']=="Public"){ echo "Tout le monde"; }else{ echo $listeFonction['nom'];} ?></option>
                <?php } ?>
				</select>
				<div id="repasClairLogis">
					<label>
						Verrouiller un jour de repas à résidence Clair Logis
					</label>
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
								<td <?php if($tmp) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 false">vérouillé');} 
										else{
											$tmp2 = boutonBloquer($value['numero'], $value['mois'], $value['annee'], 1, 2, $fonctionChoisieAnneFrank);
											if($tmp2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 blocked">bloqué');}else{ echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2 true">non-vérouillé');}
										} ?>
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
								<td <?php if($tmp) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 false">vérouillé');} 
										else{
											$tmp2 = boutonBloquer($value['numero'], $value['mois'], $value['annee'], 0, 2, $fonctionChoisieAnneFrank);
											if($tmp2) { echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 blocked">bloqué');}else{ echo ('class="'.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2 true">non-vérouillé');}
										} ?>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</div>
			</div>
			<script type="text/javascript">
					$(document).ready(function() {
						//Mise a jour de la semaine en fonction du numéro de la semaine et de la fonction sélectionnée
				        $('body').on('change', '#semaineAnneFrank, #fonctionChoisieAnneFrank', function() {
				      		var weekValue=$("#semaineAnneFrank").val();
				      		var fonctionChoisie1=$("#fonctionChoisieAnneFrank").val();
				          	$('#repasAnneFrank').load("index.php?section=verrouillerRepas&semaineAnneFrank="+weekValue+"&fonctionAnneFrank="+fonctionChoisie1+" "+"#repasAnneFrank");
				       	});
				       	$('body').on('change', '#semaineClairLogis, #fonctionChoisieClairLogis', function() {
				      		var weekValue2=$("#semaineClairLogis").val();
				      		var fonctionChoisie2=$("#fonctionChoisieClairLogis").val();
				          	$('#repasClairLogis').load("index.php?section=verrouillerRepas&semaineClairLogis="+weekValue2+"&fonctionClairLogis="+fonctionChoisie2+" "+"#repasClairLogis");
				       	});
				       	//Deux fonction pour desactiver le select avec les differentes fonction lorsque l'on est sur une interdiction et non un blocage
				       	$('body').on('click', '.choixDeLinterdictionAnneFrank', function() {
				      		var selection=$(".choixDeLinterdictionAnneFrank:checked").val();
				      		if(selection=="bloquer"){
				      			$('#fonctionChoisieAnneFrank').removeAttr('disabled');
				      		}
				      		if(selection=="interdire"){
				      			$('#fonctionChoisieAnneFrank').attr('disabled', 'disabled');
				      		}
				       	});
				       	$('body').on('click', '.choixDeLinterdictionClairLogis', function() {
				      		var selection=$(".choixDeLinterdictionClairLogis:checked").val();
				      		if(selection=="bloquer"){
				      			$('#fonctionChoisieClairLogis').removeAttr('disabled');
				      		}
				      		if(selection=="interdire"){
				      			$('#fonctionChoisieClairLogis').attr('disabled', 'disabled');
				      		}
				       	});
				       	//Mise a jour des boutons
				       	$('body').on('click', 'td', function() {
				      		//On collecte puis on traite les infos de la case que l'on a coché
				      		var informations=$(this).attr('class');
			      			var tmp = informations.split(' ');
			      			var donnees = tmp[0].split('_');
				      		var classe=tmp[1];
				      		$(this).addClass('isselected');
				      		var residence="";
				      		var semaine="semaine";
				      		var typeInterdiction=null;
				      		if(donnees[4]==1){
				      			residence="AnneFrank";
				      			semaine+=residence;
				      			typeInterdiction=$(".choixDeLinterdiction"+residence+":checked").val();
				      		}
				      		else{
				      			residence="ClairLogis";
				      			semaine+=residence;
				      			typeInterdiction=$(".choixDeLinterdiction"+residence+":checked").val();
				      		}
			      			var weekValue=$("#semaine"+residence).val();
			      			var fonctionChoisie=$("#fonctionChoisie"+residence).val();
			      			if(typeInterdiction == "interdire"){
			      			//Si on est dans l'interdiction et non dans le blocage
			      				if (classe=="false"){
				       				$.post( "index.php?section=verrouillerRepas", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.false.isselected').html('non-vérouillé');
									    	$('.false.isselected').addClass('true').removeClass('false').removeClass('isselected');
									  })
									  .fail(function(){
									   alert('Erreur');
									  })
								}
								if (classe=="true"){
					       			$.post( "index.php?section=verrouillerRepas", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.true.isselected').html('vérouillé');
									    	$('.true.isselected').addClass('false').removeClass('true').removeClass('isselected');
									  })
									  .fail(function(){
										alert('Erreur');
									  })
								}
								if (classe=="blocked"){
									$.post( "index.php?section=verrouillerRepas", {semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
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
					       			$.post( "index.php?section=verrouillerRepas", {fonction: fonctionChoisie, semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.true.isselected').html('bloqué');
									    	$('.true.isselected').addClass('blocked').removeClass('true').removeClass('isselected');
									  })
									  .fail(function(){
										alert('Erreur');
									  })
								}
								if (classe=="blocked"){
					       			$.post( "index.php?section=verrouillerRepas", {fonction: fonctionChoisie, semaine: weekValue, jour: donnees[0], mois: donnees[1], annee: donnees[2], midi: donnees[3], residence: donnees[4] })
									  .done(function() {
									  		$('.blocked.isselected').html('non-vérouillé');
									    	$('.blocked.isselected').addClass('true').removeClass('blocked').removeClass('isselected');
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
