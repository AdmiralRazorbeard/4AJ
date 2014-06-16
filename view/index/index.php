<?php include_once '/view/includes/header.php'; ?>
<?php include_once '/view/includes/footerfunctions.php'; ?>
			<div class="contentWrapper index element">
				<a href="index.php?section=plateformeLogement"><img id="plateformeImg1" src="/4AJ/view/graphicRessources/plateformelogement1.jpg" alt="Plateforme Logement"/></a>
				<img id="aLaUneImg" src="/4AJ/view/graphicRessources/alaune.png" alt="A la une"/>
				<div id="aLaUne">
				<!-- Bandeau actualité -->
					<?php if(isAdminActualite()) 
					{ ?>
					<a href="admin/index.php?section=actualite">Créer une actualité</a>
					<?php } ?>
					<?php
					foreach ($allActualite as $key => $value) { ?>
						<h4><?php echo htmlspecialchars($value['titre']); ?></h4>
						<em id="dateNews"> Posté le <?php echo $value['timestamp']; ?></em>
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
		</div>
	</body>
</html>