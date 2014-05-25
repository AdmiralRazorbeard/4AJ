<?php include '/view/includes/header.php'; ?>
		<div>
			<h1>Actualité</h1>
			<?php if($admin) { ?>
			<p>
				<em><a href="admin/index.php?section=actualite">Partie admin</a></em>
				<form method="post">
					<b>Admin</b> : nombre de billet par page : 
					<input type="text" required size="1" placeholder="<?php echo $nbreBilletParPage; ?>" name="nbreBilletParPage" /><input type="submit" colls="2" /><br /><br />
				</form>
				<form method="post">
					<b>Admin</b> : nombre total d'actualité :
					<input type="text" required size="1" placeholder="<?php echo $nbreTotalActualite; ?>" name="nbreTotalActualite" /><input type="submit" colls="2" /><br />

			</p>
			<?php } ?>

			<form method="get">
				Choisir un type : 
				<!-- Liste tout les types d'actualités -->
				<select name="typeActualite">
						<option value="all">Tout</option>
					<?php 
					foreach ($listeTypeActualite as $k => $v) { ?>
						<option value="<?php echo $k; ?>"
				<?php	if(!empty($_GET['typeActualite']) && $k == $_GET['typeActualite']) { echo 'selected'; }?> 
						><?php echo htmlspecialchars($v['nom']); ?></option>
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
						<h4><?php echo htmlspecialchars($value['titre']); ?>, le <?php echo $value['timestamp']; ?>, 
						<?php if($admin) { ?><a href="admin/index.php?section=modifierNews&id=<?php echo $key; ?>">Modifier</a>,
						<a href="admin/index.php?section=supprimerNews&id=<?php echo $key; ?>">Suprimmer</a><?php } ?></h4>
						<p>
							<?php echo regexTextBox($value['contenu']); ?>
						</p>
	<?php			} 
				} 
				else { ?>
					<p><em>Il n'y a pas de news a affiché.</em></p>
		<?php }?>

			</div>
			<!-- Affiche les pages -->
			<p>
				<?php 
				$i = 1;
				for($i; $i <= $nbrePage; $i ++)
				{ ?>
					<?php if($i == $page) {echo '<b>'; }
					if(!empty($_GET['typeActualite']) && (is_numeric($_GET['typeActualite']) || $_GET['typeActualite'] == 'all')) { ?>
					<a href="index.php?section=actualites&typeActualite=<?php echo $_GET['typeActualite']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					<?php } else { ?>					
					<a href="index.php?section=actualites&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					<?php } ?>
					<?php if($i == $page) {echo '</b>'; }?>
		<?php	} ?>
			</p>
		</div>
	</body>
</html>

