<?php 
include_once '/view/includes/header.php'; 
?>
			<div class="contentWrapper contact element edition_mode">
					<?php tinymcetxt('nousSoutenir'); ?>
					<?php if(!empty($_SESSION['superAdminOn']) && isAdminMembres()) { ?>
						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
							<input type="text" name="nomFichier"/>
							, ajouter le fichier (5 Mo maximum) : <input type="file" name="fichierNousSoutenir" /><input type="submit" />
						</form>
						<!-- On affiche les differents fichiers mis en ligne pour pouvoir ensuite les supprimer-->
						<?php if($listePdf != NULL){
						 		foreach($listePdf as $key => $value){ 
						?>
							<a href="index.php?section=nousSoutenir&amp;delete=<?php echo ($value['nomFichier']); ?>">Supprimer le fichier <?php echo ($value['nomFichier']); ?></a><br>
						<?php } } 
					} ?>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>