<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Modifier la news n°<?php echo $infoNews['id']; ?></h1>
				<em><a href="../index.php?section=actualites">Retourner à la section: actualités</a></em>
				<fieldset id="modifierNews">
					<form method="post">
						<div class="form-field">
						<label for="titre">Titre :</label>
						<input type="text" value="<?php echo $infoNews['titre']; ?>" name="titre"/><br />
						</div>
						<div class="form-field-contenu">
						<p id="p_form-field-contenu">Contenu:</p>
						<?php toolBox('contenu', $infoNews['contenu']); ?>
						<input type="submit">
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</body>
</html>