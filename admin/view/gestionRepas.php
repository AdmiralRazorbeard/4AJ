<?php
include_once '/view/includes/header.php';
?>
<style type="text/css">
table {
    border-collapse: collapse; /* Les bordures du tableau seront collées (plus joli) */
    border: 1px solid black;
}
td {
	border: 1px solid black;
}
th {
	border: 1px solid black;
	width : 150px;
}
.true
{
	background-color: green;
	cursor:pointer;
}
.false
{
	background-color: red;
	cursor:pointer;
}
.invalide
{
	background-color: grey;
	cursor:not-allowed;
}
</style>
			<div class="contentWrapper">
				<h1>Nombre des repas par jours</h1>
				<p>
					<em><a href="index.php?section=verrouillerRepas">Verrouiller un jour pour les repas</a></em><br />
					<em><a href="index.php?section=menuSemaine">Ajouter un menu de la semaine</a></em><br />
					<em><a href="index.php?section=horaireLimite#">Définir un horaire limite de reservation</a></em>
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
					<table>
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
					<table>
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
		</div>
	</body>
</html>