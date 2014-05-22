<?php include '/view/includes/header.php'; ?>
		<div>
			<h1>Actualité</h1>
			<?php if($admin) { ?>
			<p>
				<em><a href="admin/index.php?section=actualite">Partie admin</a></em>
			</p>
			<?php } ?>
			<form method="post">
				Choisir un type : 
				<!-- Liste tout les types d'actualités -->
				<select name="typeActualite">
						<option value="0">Tout</option>
					<?php 
					foreach ($listeTypeActualite as $k => $v) { ?>
						<option value="<?php echo $k; ?>"><?php echo $v['nom']; ?></option>
			<?php	} ?>
				</select>
				<input type="submit" />
			</form>
			<div>
				<?php
				if(!empty($listeActualite))
					// Ceci est pour s'assurer qu'il y a quelque chose a affiché, sinon on affiche
					// un message d'erreur
				{
					foreach ($listeActualite as $key => $value) { ?>
						<h4><?php echo $value['titre']; ?>, le <?php echo $value['timestamp']; ?>, 
						<?php if($admin) { ?><a href="admin/index.php?section=modifierNews&id=<?php echo $key; ?>">Modifier</a>,
						<a href="admin/index.php?section=supprimerNews&id=<?php echo $key; ?>">Suprimmer</a><?php } ?></h4>
						<p>
							<?php echo $value['contenu']; ?>
						</p>
	<?php			} 
				} 
				else { ?>
					<p><em>Il n'y a pas de news a affiché.</em></p>
		<?php }?>

			</div>
		</div>
	</body>
</html>

