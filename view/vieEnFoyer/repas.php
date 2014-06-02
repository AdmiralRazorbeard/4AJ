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
function confirmerRepas(jour, mois, annee, midi)
{	/*Fonction redirige sur la même page en mettant les paramètres en GET */
	javascript:location.href='index.php?section=repas&semaine=<?php echo $semaineDu; ?>&jour='+jour+'&mois='+mois+'&annee='+annee+'&midi='+midi;
}
</script>
			<div class="contentWrapper">
				<h1>
					Repas
				</h1>
				<form method="post">
					<label for="semaine">Semaine du : </label>
					<select name="semaine" id="semaine">
						<?php
						$i = 0;
						while($i < 8)
						{ ?>
							<option <?php if(!empty($semaineDu) && $semaineDu==$i) { echo 'selected'; } ?> value="<?php if($i == 0) { echo '-1'; } else { echo $i; } ?>"><?php echo date('d', strtotime('this Monday', strtotime('+'.$i.' week'))); ?> <?php echo $mois[date('n', strtotime('this Monday', strtotime('+'.$i.' week')))]; ?></option>
				<?php	$i ++;
						}
						?>
					</select>
					<input type="submit">
				</form>
				<table>
						<!-- Tableau de la semaine -->
					<tr>
						<td>
						</td>
						<th>
							Lundi <?php echo $semaine['lundi']['numero']; ?> <?php echo $mois[$semaine['lundi']['mois']]; ?>
						</th>
						<th>
							Mardi <?php echo $semaine['mardi']['numero']; ?> <?php echo $mois[$semaine['mardi']['mois']]; ?>
						</th>
						<th>
							Mercredi <?php echo $semaine['mercredi']['numero']; ?> <?php echo $mois[$semaine['mercredi']['mois']]; ?>
						</th>
						<th>
							Jeudi <?php echo $semaine['jeudi']['numero']; ?> <?php echo $mois[$semaine['jeudi']['mois']]; ?>
						</th>
						<th>
							Vendredi <?php echo $semaine['vendredi']['numero']; ?> <?php echo $mois[$semaine['vendredi']['mois']]; ?>
						</th>
						<th>
							Samedi <?php echo $semaine['samedi']['numero']; ?> <?php echo $mois[$semaine['samedi']['mois']]; ?>
						</th>
						<th>
							Dimanche <?php echo $semaine['dimanche']['numero']; ?> <?php echo $mois[$semaine['dimanche']['mois']]; ?>
						</th>
					</tr>
					<tr>
						<td>
							Midi
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['lundi']['numero']; ?>, <?php echo $semaine['lundi']['mois']; ?>, <?php echo $semaine['lundi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['lundi']['numero'], $semaine['lundi']['mois'], $semaine['lundi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['lundi']['numero'], $semaine['lundi']['mois'], $semaine['lundi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['mardi']['numero']; ?>, <?php echo $semaine['mardi']['mois']; ?>, <?php echo $semaine['mardi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['mardi']['numero'], $semaine['mardi']['mois'], $semaine['mardi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['mardi']['numero'], $semaine['mardi']['mois'], $semaine['mardi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['mercredi']['numero']; ?>, <?php echo $semaine['mercredi']['mois']; ?>, <?php echo $semaine['mercredi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['mercredi']['numero'], $semaine['mercredi']['mois'], $semaine['mercredi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['mercredi']['numero'], $semaine['mercredi']['mois'], $semaine['mercredi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['jeudi']['numero']; ?>, <?php echo $semaine['jeudi']['mois']; ?>, <?php echo $semaine['jeudi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['jeudi']['numero'], $semaine['jeudi']['mois'], $semaine['jeudi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['jeudi']['numero'], $semaine['jeudi']['mois'], $semaine['jeudi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['vendredi']['numero']; ?>, <?php echo $semaine['vendredi']['mois']; ?>, <?php echo $semaine['vendredi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['vendredi']['numero'], $semaine['vendredi']['mois'], $semaine['vendredi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['vendredi']['numero'], $semaine['vendredi']['mois'], $semaine['vendredi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['samedi']['numero']; ?>, <?php echo $semaine['samedi']['mois']; ?>, <?php echo $semaine['samedi']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['samedi']['numero'], $semaine['samedi']['mois'], $semaine['samedi']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['samedi']['numero'], $semaine['samedi']['mois'], $semaine['samedi']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td onclick="confirmerRepas(<?php echo $semaine['dimanche']['numero']; ?>, <?php echo $semaine['dimanche']['mois']; ?>, <?php echo $semaine['dimanche']['annee']; ?>, 1)" <?php if(boutonReserver($semaine['dimanche']['numero'], $semaine['dimanche']['mois'], $semaine['dimanche']['annee'], 1) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['dimanche']['numero'], $semaine['dimanche']['mois'], $semaine['dimanche']['annee'], 1) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
					</tr>
					<tr>
						<td>
							Soir
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['lundi']['numero']; ?>, <?php echo $semaine['lundi']['mois']; ?>, <?php echo $semaine['lundi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['lundi']['numero'], $semaine['lundi']['mois'], $semaine['lundi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['lundi']['numero'], $semaine['lundi']['mois'], $semaine['lundi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['mardi']['numero']; ?>, <?php echo $semaine['mardi']['mois']; ?>, <?php echo $semaine['mardi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['mardi']['numero'], $semaine['mardi']['mois'], $semaine['mardi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['mardi']['numero'], $semaine['mardi']['mois'], $semaine['mardi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['mercredi']['numero']; ?>, <?php echo $semaine['mercredi']['mois']; ?>, <?php echo $semaine['mercredi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['mercredi']['numero'], $semaine['mercredi']['mois'], $semaine['mercredi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['mercredi']['numero'], $semaine['mercredi']['mois'], $semaine['mercredi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['jeudi']['numero']; ?>, <?php echo $semaine['jeudi']['mois']; ?>, <?php echo $semaine['jeudi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['jeudi']['numero'], $semaine['jeudi']['mois'], $semaine['jeudi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['jeudi']['numero'], $semaine['jeudi']['mois'], $semaine['jeudi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['vendredi']['numero']; ?>, <?php echo $semaine['vendredi']['mois']; ?>, <?php echo $semaine['vendredi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['vendredi']['numero'], $semaine['vendredi']['mois'], $semaine['vendredi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['vendredi']['numero'], $semaine['vendredi']['mois'], $semaine['vendredi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['samedi']['numero']; ?>, <?php echo $semaine['samedi']['mois']; ?>, <?php echo $semaine['samedi']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['samedi']['numero'], $semaine['samedi']['mois'], $semaine['samedi']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['samedi']['numero'], $semaine['samedi']['mois'], $semaine['samedi']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>
						<td  onclick="confirmerRepas(<?php echo $semaine['dimanche']['numero']; ?>, <?php echo $semaine['dimanche']['mois']; ?>, <?php echo $semaine['dimanche']['annee']; ?>, 0)" <?php if(boutonReserver($semaine['dimanche']['numero'], $semaine['dimanche']['mois'], $semaine['dimanche']['annee'], 0) == 1){ echo 'class="false" '; } elseif(boutonReserver($semaine['dimanche']['numero'], $semaine['dimanche']['mois'], $semaine['dimanche']['annee'], 0) == 2) { echo 'class="true" '; } else { echo 'class="invalide" '; } ?>>
						</td>	
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>