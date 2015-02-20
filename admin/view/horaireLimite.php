<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper horaireLimite">
				<h1>Modifier la période limite de réservation</h1>
				<a href="index.php?section=gestionRepas">Retour</a>
				<p>
					<em>Ici, il s'agit de definir la période limite pour s'inscrire à un repas.</em>
				</p>
					<!-- Changer l'horaire midi -->
				<form method="post">
					<label>Changer l'horaire pour le midi :</label>
					<select name="midiHeure">
						<?php for ($i=0; $i < 24; $i++) {  ?>
							<option value="<?php echo $i;?>" <?php if($i == $horaireLimite[0][0]) { echo 'selected'; } ?>>
								<?php echo $i; ?>
							</option>
				<?php	} ?>
					</select> : 
					<select name="midiMinute">
						<?php for ($i=0; $i <  60; $i = $i+15) { ?>
							<option value="<?php echo $i;?>" <?php if($i == $horaireLimite[0][1]) { echo 'selected'; } ?>>
								<?php if($i == 0)
								{
									echo "00";
								}
								else
								{
								echo $i;
								}?>
							</option>
				<?php	} ?>
					</select>
					<input value="Enregistrer" type="submit">
				</form><br />
					<!-- Changer l'horaire soir -->
				<form method="post">
					<label>Changer l'horaire pour le soir &nbsp;:</label>
					<select name="soirHeure">
						<?php for ($i=0; $i < 24; $i++) {  ?>
							<option value="<?php echo $i;?>" <?php if($i == $horaireLimite[1][0]) { echo 'selected'; } ?>>
								<?php echo $i; ?>
							</option>
				<?php	} ?>
					</select> : 
					<select name="soirMinute">
						<?php for ($i=0; $i <  60; $i = $i+15) { ?>
							<option value="<?php echo $i;?>" <?php if($i == $horaireLimite[1][1]) { echo 'selected'; } ?>>
								<?php if($i == 0)
								{
									echo "00";
								}
								else
								{
								echo $i;
								}?>
							</option>
				<?php	} ?>
					</select>
					<input value="Enregistrer" type="submit">
				</form>
				<br>
					<!-- Changer le nombre de jour en plus -->
				<form method="post">
					<label>Changer le nombre de jours avec lequel les membres doivent réserver en avance:</label>
                    <input type="number" name="jourEnPlus" value="<?php echo($horaireLimite[2]); ?>">
					<input value="Enregistrer" type="submit">
				</form>			
			</div>
		</div>
	</body>
</html>