<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper">
				<h1>Gestion des actualités </h1>
				<fieldset id="actualite">
				<form method="post">
						<p class="form-field">
						<label for="titre">Titre :</label>
						<input type="text" name="titre" id="titre" />
						</p>
						<p class="form-field">
						<label for="typeActualite">Type d'actualité : </label>
						<select name="typeActualite" id="typeActualite"onchange="
							if(this.selectedIndex == <?php echo $nbreTypeActualite; ?>)
							{
								javascript:location.href='index.php?section=typeActualite'
							}">
							<?php 
							foreach ($typeActualite as $k => $v) { ?>
								<option value="<?php echo $k; ?>"><?php echo $v['nom']; ?></option>
					<?php   } ?>
								<!-- Redirige vers la page "new type actualité" -->
								<option value="0">Ajouter un nouveau type d'actualité</option>
						</select>
						</p>
						<p class="form-field-visibilite">
						<label for="visiblePar">News visible par : </label><br>
						<!-- Affiche toutes les autres "fonction" -->
							<?php foreach ($allFonction as $k => $v) { ?>
								<div class="form-field-visibilite-element">
									<input type="checkbox" <?php if($k == 1) { echo 'checked'; } ?> name="<?php echo $k; ?>" id="<?php echo $k; ?>">
									<label for="<?php echo $k; ?>"><?php echo $v['nom']; ?></label>
								</div>
				<?php       } ?>
						</p>
						<p class="form-field-contenu">
						<label for="contenu">Contenu: </label>
						<?php toolBox('contenu'); ?>
						<input type="submit">
						</p>
					</form>
				</fieldset>
			</div>
		</div>	
	</body>
</html>
