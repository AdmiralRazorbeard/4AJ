<?php include_once '/view/includes/header.php'; ?>
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
<script type="text/javascript">
function confirmerRepas(jour, mois, annee, midi, residence){	
	/*Fonction redirige sur la même page en mettant les paramètres en GET */
	if(residence == 1)
	{
		javascript:location.href='index.php?section=restauration&semaineAnneFrank=<?php echo $semaineDuAnneFrank; ?>&jour='+jour+'&mois='+mois+'&annee='+annee+'&midi='+midi+'&residence='+residence;
	}
	else
	{
		if(residence == 2)
		{
			javascript:location.href='index.php?section=restauration&semaineClairLogis=<?php echo $semaineDuClairLogis; ?>&jour='+jour+'&mois='+mois+'&annee='+annee+'&midi='+midi+'&residence='+residence;
		}
	}
}
</script>
			<div class="vieEnFoyer element contentWrapper edition_mode">
				<h1>
					<?php langue('Repas', 'Meal'); ?>
				</h1><br />
				<?php if($accessRepas) { ?> 
				<fieldset>
					<legend><?php langue('Repas Anne Frank', 'Anne Frank meal'); ?></legend>
					<form method="post">
						<label for="semaineAnneFrank"><?php langue('Semaine du', 'Week of'); ?> : </label>
						<select name="semaineAnneFrank" id="semaineAnneFrank">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuAnneFrank) && $semaineDuAnneFrank==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '-1'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
					<?php	$i ++;
							}
							?>
						</select>
						<input type="submit">
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
							<td>
								<?php langue('Midi', 'Lunch'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 1)
								?>
								<td onclick="confirmerRepas(<?php echo $value['numero']; ?>, <?php echo $value['mois']; ?>, <?php echo $value['annee']; ?>, 1, 1)" <?php if($tmp == 1) { echo 'class="false"'; } elseif($tmp == 2) { echo 'class = "true"';  } else { echo 'class="invalide"'; } ?>>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td>
								<?php langue('Soir', 'Dinner'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineAnneFrank as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 1)
								?>
								<td onclick="confirmerRepas(<?php echo $value['numero']; ?>, <?php echo $value['mois']; ?>, <?php echo $value['annee']; ?>, 0, 1)" <?php if($tmp == 1) { echo 'class="false"'; } elseif($tmp == 2) { echo 'class = "true"';  } else { echo 'class="invalide"'; } ?>>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</fieldset>

						<!--  REPAS CLAIR LOGIS -->

				<fieldset>
					<legend><?php langue('Repas Clair Logis', 'Clair Logis meal'); ?></legend>
					<form method="post">
						<label for="semaineClairLogis"><?php langue('Semaine du', 'Week of'); ?> : </label>
						<select name="semaineClairLogis" id="semaineClairLogis">
							<?php
							$i = 0;
							while($i < 8)
							{ ?>
								<option <?php if(!empty($semaineDuClairLogis) && $semaineDuClairLogis==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '-1'; } else { echo $i; } ?>"><?php echo date('d', strtotime('Monday this week', strtotime('+'.$i.' week'))); langue('', date('S', strtotime('Monday this week', strtotime('+'.$i.' week')))); echo ' '; langue($mois[date('n', strtotime('Monday this Week', strtotime('+'.$i.' week')))], date('F', strtotime('Monday this week', strtotime('+'.$i.' week')))); ?></option>
					<?php	$i ++;
							}
							?>
						</select>
						<input type="submit">
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
							<td>
								<?php langue('Midi', 'Lunch'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 1, 2)
								?>
								<td onclick="confirmerRepas(<?php echo $value['numero']; ?>, <?php echo $value['mois']; ?>, <?php echo $value['annee']; ?>, 1, 2)" <?php if($tmp == 1) { echo 'class="false"'; } elseif($tmp == 2) { echo 'class = "true"';  } else { echo 'class="invalide"'; } ?>>
								</td>
					<?php	} ?>
						</tr>
						<tr>
							<td>
								<?php langue('Soir', 'Dinner'); ?>
							</td>
							<?php 	/*Affiche les cases pour réserver ou non (ici pour le soir)*/
							foreach ($semaineClairLogis as $key => $value) { 
							$tmp = boutonReserver($value['numero'], $value['mois'], $value['annee'], 0, 2)
								?>
								<td onclick="confirmerRepas(<?php echo $value['numero']; ?>, <?php echo $value['mois']; ?>, <?php echo $value['annee']; ?>, 0, 2)" <?php if($tmp == 1) { echo 'class="false"'; } elseif($tmp == 2) { echo 'class = "true"';  } else { echo 'class="invalide"'; } ?>>
								</td>
					<?php	} ?>
						</tr>
					</table>
				</fieldset>
				<?php } ?><br />
				<?php pageDynamique('restauration'); ?>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>