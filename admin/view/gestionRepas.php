<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Nombre des repas par jour</h1>
				<p>
					<em><a href="index.php?section=verrouillerRepas">Verrouiller un jour pour les repas</a></em><br />
					<em><a href="index.php?section=menuSemaine">Ajouter un menu de la semaine</a></em><br />
					<em><a href="index.php?section=horaireLimite">Définir un horaire limite de reservation</a></em>
				</p>
				<fieldset>
					<legend>
						Anne Frank
					</legend>
					<form method="post">
						<label for="semaineAnneFrank">Semaine du : </label>
						<select name="semaineAnneFrank" id="semaineAnneFrank">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '-1'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
						<input type="submit">
					</form>
					<table class="gestionRepas">
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
								<td> <!-- ici on affiche le nombre de personne inscrit pour le midi -->
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1); ?>
								</td>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Soir</td>
							<?php
							foreach ($semaineAnneFrank as $key => $value) { ?>
								<td> <!-- ici on affiche le nombre de personne inscrit pour le soir -->
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); ?>
								</td>
					<?php	}
							?>
						</tr>
					</table>
				</fieldset>
								<fieldset>
					<legend>
						Clair Logis
					</legend>
					<form method="post">
						<label for="semaineClairLogis">Semaine du : </label>
						<select name="semaineClairLogis" id="semaineClairLogis">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '-1'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))]; ?></option>
					<?php	$i ++;
							}
							?>
						</select>
						<input type="submit">
					</form>
					<table class="gestionRepas">
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
								<td> <!-- ici on affiche le nombre de personne inscrit pour le midi -->
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2); ?>
								</td>
					<?php	}
							?>
						</tr>
						<tr>
							<td>Soir</td>
							<?php
							foreach ($semaineClairLogis as $key => $value) { ?>
								<td> <!-- ici on affiche le nombre de personne inscrit pour le soir -->
									<?php echo nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); ?>
								</td>
					<?php	}
							?>
						</tr>
					</table>
				</fieldset>
			</div>
			<a href="index.php?section=generationNombreRepas">Télécharger le nombre de prochaines reservations</a>
			<form action="index.php?section=generationRecapitulatif" method="post">
				<select name="moisChoisi">
						<option value="0"><?php echo $mois[date('n', strtotime('now'))]; ?></option>
						<option value="1"><?php echo $mois[date('n', strtotime("first day of last month"))]; ?></option>
						<option value="2"><?php echo $mois[date('n', strtotime("first day of 2 months ago"))]; ?></option>
				</select>
				<input value="Télécharger le récapitulatif des réservations membres" type="submit">
			</form>
		</div>
	</body>
</html>