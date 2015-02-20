<?php 
include_once '/view/includes/header.php'; 
?>
			<div class="contentWrapper contact element edition_mode">
				<?php tinymcetxt('coinPresse'); ?>
				<?php if(!empty($_SESSION['superAdminOn'])) { ?>
					<div id="uploaderFichier">
					<h3>Exporter un fichier PDF</h3>
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
						<input type="hidden" name="page" value="coinPresse" />
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
						Lien vers le fichier <?php echo ($value['nomFichier']); ?>:<br>index.php?section=telechargerAutresPdf&amp;page=<?php echo ($value['page']); ?>&amp;file=<?php echo ($value['nomFichier']); ?><br>
						<a href="index.php?section=coinPresse&amp;delete=<?php echo ($value['nomFichier']); ?>">Supprimer le fichier <?php echo ($value['nomFichier']); ?></a>&emsp;&emsp;Téléchargements: <?php echo $value['telechargement']; ?><br><br>
					<?php } } 
				} ?>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>		
		</div>
	</body>
</html>