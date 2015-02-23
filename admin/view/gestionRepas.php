<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Gestion restauration</h1>
				<p>
					<em><a href="index.php?section=verrouillerRepas">Interdire/Bloquer des journées pour les repas</a></em><br />
					<em><a href="index.php?section=menuSemaine">Ajouter un menu pour la semaine</a></em><br />
					<em><a href="index.php?section=horaireLimite">Définir une période limite de réservation</a></em><br />
					<em><a href="index.php?section=bloquerReservations">Activer/Désactiver la possibilité de réserver</a></em><br />
					<em><a href="index.php?section=viderReservations">Vider les anciens enregistrements de réservations</a></em>
				</p>
				<hr>
				<div id="repasAnneFrank">
					<p>
						<em>Cliquez sur les cases ci-dessous pour générer des feuilles d'appel</em>
					</p>
					<label>
						Anne Frank
					</label>
					<form method="post">
						<label for="semaineAnneFrank">Semaine du : </label>
						<select name="semaineAnneFrank" id="semaineAnneFrank">
							<?php
							$i = 0;
							while($i < 8+$semaineDePlus)
							{ ?>
								<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
					<table class="gestionRepas2">
						<tr>
							<td></td>
							<?php
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<th>	<!-- On affiche les jours -->
									<?php echo ucfirst($key); ?> <?php echo $value['numero']; ?> <?php echo $mois[$value['mois']]; ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Midi</td>
							<?php
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<td <?php echo ('class="cliquable '.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_1"');?>>
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1); ?>
								</td>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Soir</td>
							<?php
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<td <?php echo ('class="cliquable '.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_1"');?>>
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); ?>
								</td>
					<?php	}
							?>
						</tr>
					</table>
				</div>
				<br>
				<div id="repasClairLogis">
					<label>
						Clair Logis
					</label>
					<form method="post">
						<label for="semaineClairLogis">Semaine du : </label>
						<select name="semaineClairLogis" id="semaineClairLogis">
							<?php
							$i = 0;
							while($i < 8+$semaineDePlus)
							{ ?>
								<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '0'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
					</form>
					<table class="gestionRepas2">
						<tr>
							<td></td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<th>	<!-- On affiche les jours -->
									<?php echo ucfirst($key); ?> <?php echo $value['numero']; ?> <?php echo $mois[$value['mois']]; ?>
								</th>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Midi</td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<td <?php echo ('class="cliquable '.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_1_2"');?>>
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2); ?>
								</td>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Soir</td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<td <?php echo ('class="cliquable '.$value['numero'].'_'.$value['mois'].'_'.$value['annee'].'_0_2"');?>>
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); ?>
								</td>
					<?php	}
							?>
						</tr>
					</table>
				</div>
				<br>
				<p>
					<em>NB: Dans le tableau, H signifie Halal. Exemple: 15/(H:4) signifie 15 réservations dont 4 Halal.</em>
					<input type="submit" onclick="location.href='index.php?section=generationNombreRepas';" value="Télécharger le récapitulatif du tableau ci-dessus">
				</p>
				<hr>
				<br>
				<form action="index.php?section=generationRecapitulatif" method="post">
					<input value="Télécharger le récapitulatif des réservations membres" type="submit">
					<select name="moisChoisi">
							<option value="0"><?php echo $mois[date('n', strtotime('now'))]; ?></option>
							<option value="1"><?php echo $mois[date('n', strtotime("first day of last month"))]; ?></option>
							<option value="2"><?php echo $mois[date('n', strtotime("first day of 2 months ago"))]; ?></option>
							<option value="3"><?php echo $mois[date('n', strtotime("first day of 3 months ago"))]; ?></option>
					</select>
					<select name="residenceChoisie">
							<option value="1">Anne Frank</option>
							<option value="2">Clair Logis</option>
					</select>
					<select name="fonctionChoisie">
                    <?php foreach ($membreFonction as $key => $listeFonction) { ?>
                    	<option value="<?php echo $listeFonction['id']; ?>"><?php if($listeFonction['nom']=="Public"){ echo "Tout le monde"; }else{ echo $listeFonction['nom'];} ?></option>
                    <?php } ?>
					</select>
				</form>
				<em>NB: Veillez à télécharger ce fichier tous les mois pour chaque résidence (le téléchargement peut prendre quelques secondes).</em>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
			        $('body').change('#semaineAnneFrank', function() {
			      		var weekValue=$("#semaineAnneFrank").val();
			          	$('#repasAnneFrank').load("index.php?section=gestionRepas&semaineAnneFrank="+weekValue+" "+"#repasAnneFrank");
			       	});
			       	$('body').change('#semaineClairLogis', function() {
			      		var weekValue2=$("#semaineClairLogis").val();
			          	$('#repasClairLogis').load("index.php?section=gestionRepas&semaineClairLogis="+weekValue2+" "+"#repasClairLogis");
			       	});
					$('body').on('click', 'td', function() {
			      		var informations=$(this).attr('class');
			      		var tmp = informations.split(' ');
			      		var donnees = tmp[1].split('_');
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
		       			$(location).attr('href',"index.php?section=generationFeuilleAppel&semaine="+weekValue+"&jour="+donnees[0]+"&mois="+donnees[1]+"&annee="+donnees[2]+"&midi="+donnees[3]+"&residence="+donnees[4]);
					});
				});
			</script>
		</div>
	</body>
</html>