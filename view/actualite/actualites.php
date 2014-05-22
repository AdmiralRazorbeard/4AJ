<?php include '/view/includes/header.php'; ?>
		<div>
			<h1>Actualité</h1>
			<?php if($admin) { ?>
			<p>
				<em><a href="admin/index.php?section=actualite">Partie admin</a></em>
			</p>
			<?php } ?>
			<div>
				<?php
				foreach ($listeActualite as $key => $value) { ?>
					<h4><?php echo $value['titre']; ?></h4>
					<p>
						<?php echo $value['contenu']; ?>
					</p>
<?php			} ?>

			</div>
		</div>
	</body>
</html>

