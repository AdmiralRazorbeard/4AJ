<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Modifier les heures limite d'inscription</h1>

				<p>
					<em>Ici, il s'agit de changer la limite de l'heure pour s'inscrire à un repas.</em>
				</p>
					<!-- Changer l'horaire midi -->
				<form method="post">
					<label for="midiHeure">Changer l'horaire pour le midi : </label>
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
								<?php echo $i; ?>
							</option>
				<?php	} ?>
					<input type="submit">
				</form><br />
					<!-- Changer l'horaire soir -->
				<form method="post">
					<label for="soirHeure">Changer l'horaire pour le soir &nbsp;: </label>
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
								<?php echo $i; ?>
							</option>
				<?php	} ?>
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>