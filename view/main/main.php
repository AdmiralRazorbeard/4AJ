<?php include_once 'view/includes/header.php'; ?>
<?php include_once 'view/includes/footerfunctions.php'; ?>
			<div class="contentWrapper index element">
				<div id="indexContent">
					<?php tinymcetxt('index'); ?>
				</div>
				<div id="aLaUne">
				<!-- Bandeau actualité -->
				<img id="aLaUneImg" src="view/graphicRessources/alaune.png" alt="A la une"/>
					<?php if(isAdminActualite()) 
					{ ?>
					<a href="admin/index.php?section=actualite">Créer une actualité</a>
					<?php } ?>
					<?php
					foreach ($allActualite as $key => $value) { ?>
						<h4><?php echo htmlspecialchars($value['titre']); ?></h4>
						<em class="dateNews"> Posté le <?php echo $value['timestamp']; ?></em>
						<?php if(isAdminActualite()) 
						{ ?>
						<p>
							<a href="admin/index.php?section=modifierNews&amp;id=<?php echo $key; ?>">Modifier</a>
							<a href="admin/index.php?section=supprimerNews&amp;id=<?php echo $key; ?>">Supprimer</a>
						</p>
	<?php 				} ?>
						<p><?php echo regexTextBox($value['contenu']); ?></p>
						<br>
	<?php			} ?>
				</div>
			</div>
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>