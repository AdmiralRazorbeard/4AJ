<?php include_once '/view/includes/header.php'; ?>
<?php include_once '/view/includes/footerfunctions.php'; ?>
			<div class="contentWrapper index element">
				<div class="img_index img_index1">
					<a href="index.php?section=plateformeLogement"><img src="/4AJ/view/graphicRessources/testplateforme.jpg" alt="Plateforme Logement"/></a>
				</div>
				<div class="img_index img_index2"></div>
				<div class="img_index img_index3"></div>
				<div class="img_index img_index4"></div>
			</div>
				<!-- Bandeau actualité -->
			<div>
				<?php
				foreach ($allActualite as $key => $value) { ?>
					<h4><?php echo htmlspecialchars($value['titre']); ?>, <em>le <?php echo $value['timestamp']; ?></em></h4>
					<?php if(isAdminActualite()) 
					{ ?>
					<p>
						<a href="admin/index.php?section=modifierNews&amp;id=<?php echo $key; ?>">Modifier</a>
						<a href="admin/index.php?section=supprimerNews&amp;id=<?php echo $key; ?>">Supprimer</a>
					</p>
<?php 				} ?>
					<p><?php echo regexTextBox($value['contenu']); ?></p>
<?php			} ?>
			</div>
		</div>
	</body>
</html>