<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper">
				<h1>Type d'actualité</h1>
				<?php if(isset($fonctionne) && !$fonctionne) { ?>
				<p>
					<em>Un type d'actualité porte déjà le même nom.</em>
				</p>
				<?php } ?>
				<form method="post">
					<label for="delete">Supprimer un type d'actualité : </label>
					<select name="delete" id="delete" >
						<!-- Liste toutes les actualités -->
						<?php 
						foreach ($typeActualite as $k => $v) { ?>
							<option value="<?php echo $k; ?>" <?php if($k == 1) { echo 'disabled'; } ?>><?php echo $v['nom']; ?></option>	
				<?php	}	?>
					</select>
					<input type="submit" value="Supprimer">
				</form><br /><br />
				<form method="post">
					<label for="add">Ajouter un type d'actualité, nom : </label>
					<input type="text" name="add" id="add" />
					<input type="submit"><br />
				</form>
			</div>
		</div>
	</body>
</html>