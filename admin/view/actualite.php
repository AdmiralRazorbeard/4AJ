<?php
include_once 'view/includes/header.php';
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
							<!-- Affiche toutes les fonction mais pas reservation halal qui est une fonction particulière servant juste de repère -->
								<?php foreach ($allFonction as $k => $value) { ?>
											<div class="form-field-visibilite-element">
												<input type="checkbox" <?php if($k == 1) { echo 'checked'; } ?> name="<?php echo $k; ?>" id="<?php echo $k; ?>">
												<label for="<?php echo $k; ?>"><?php if($value['nom']=='Public'){echo "Tout le monde";}else{echo $value['nom'];} ?></label>
											</div>
								<?php } ?>
						</div>
						<div class="form-field-visibilite">
						<p>Comment sera envoyée l'actualité ?</p>
						<select required name="destination" size="3">
                			<option value="1" selected="selected">Fil d'actualité du site</option>
                			<option value="2">Mail</option>
                			<option value="3">Fil d'actualité du site + Mail</option>
        				</select>
        				</div>
						<div class="form-field-contenu">
							<p id="p_form-field-contenu">Contenu:</p>
							<?php toolBox('actualite'); ?>
							<input type="submit">
						</div>
					</form>
				</fieldset>
				<div id="uploaderFichier">
				<h3>Exporter un fichier PDF</h3>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
					<input type="hidden" name="page" value="actualite" />
					<label>Nom du fichier (sans accents):</label>
					<input type="text" name="nomFichier"/><br>
					<label>Selectionner le fichier (5Mo maximum) :</label>
					<input type="file" name="fichier"/><br>
					<input type="submit" value="Envoyer"/>
				</form>
				</div>
				<!-- On affiche les differents fichiers mis en ligne pour pouvoir ensuite les supprimer-->
				<?php if($listePdf != NULL){
				 		foreach($listePdf as $key => $value){ 
				?>	
					Lien vers le fichier <?php echo ($value['nomFichier']); ?>:<br>http://www.4aj.eu/index.php?section=telechargerAutresPdf&amp;page=<?php echo ($value['page']); ?>&amp;file=<?php echo ($value['nomFichier']); ?>&amp;protectHash=<?php echo ($value['protectHash']); ?><br>
					<a href="index.php?section=actualite&amp;delete=<?php echo ($value['nomFichier']); ?>">Supprimer le fichier <?php echo ($value['nomFichier']); ?></a>&emsp;&emsp;Téléchargements: <?php echo $value['telechargement']; ?><br><br>
				<?php } } ?>
			</div>
		</div>	
	</body>
</html>
