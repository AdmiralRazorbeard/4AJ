<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Creer une actualité</h1>
				<em><a href="../index.php?section=index">Retourner à la liste des actualités</a></em>
				<?php if($message != NULL){ ?>
					<br><em><?php echo $message; ?></em> 
				<?php }?>
				<fieldset id="actualite">
					<form method="post"  enctype="multipart/form-data">
						<div class="form-field">
						<label for="titre">Titre :</label>
						<input required type="text" name="titre" id="titre" />
						</div>
						<div class="form-field-visibilite">
						<p>L'actualité sera visible pour :</p>
							<!-- Affiche toutes les autres "fonction" -->
								<?php foreach ($allFonction as $k => $value) { ?>
									<div class="form-field-visibilite-element">
										<input type="checkbox" <?php if($k == 1) { echo 'checked'; } ?> name="<?php echo $k; ?>" id="<?php echo $k; ?>">
										<label for="<?php echo $k; ?>"><?php if($value['nom']=='Public'){echo "Tout le monde";}else{echo $value['nom'];} ?></label>
									</div>
								<?php } ?>
						</div>
						<div class="form-field-contenu">
							<p id="p_form-field-contenu">Contenu:</p>
							<?php toolBox('actualite'); ?>
							<input type="submit">
						</div>
					</form>
				</fieldset>
			</div>
		</div>	
	</body>
</html>
