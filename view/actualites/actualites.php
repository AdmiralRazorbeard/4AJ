<?php include '/view/includes/header.php'; ?>
			<div class="contentWrapper actualites">
				<?php if($admin) { ?>
					<em><a href="admin/index.php?section=actualite">Rédiger une nouvelle actualité</a></em>
					<form method="post">
						<label><b>Admin</b> : nombre de billet par page :</label>
						<input type="text" required size="1" placeholder="<?php echo $nbreBilletParPage; ?>" name="nbreBilletParPage" /><input type="submit" colls="2" />
					</form>
					<form method="post">
						<label><b>Admin</b> : nombre total d'actualités :</label>
						<input type="text" required size="1" placeholder="<?php echo $nbreTotalActualite; ?>" name="nbreTotalActualite" /><input type="submit" colls="2" />
					</form>
				<?php } ?>

				<form method="get">
					<em>Choisir un type :</em>
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
							<h2><?php echo htmlspecialchars($value['titre']); ?></h2> 
								<!-- Affiche le timestamp -->
							<p class="a_info" >
								 <?php echo $value['timestamp']; ?>
							</p>
							<?php if($admin) { ?><a href="admin/index.php?section=modifierNews&amp;id=<?php echo $key; ?>">Modifier</a>,
							<a href="admin/index.php?section=supprimerNews&amp;id=<?php echo $key; ?>">Supprimer</a><?php } ?>
								<!-- Affiche le pdf -->
							<?php if($value['fichierPDF'] != '') { ?>
							<p class="pdf">
								<a href="fichierPDF/<?php echo $value['fichierPDF']; ?>">Fichier pdf</a>
							</p>
							<?php } ?>
							<p class="a_content" >
								<?php echo regexTextBox($value['contenu']); ?>
							</p>
		<?php			} 
					} 
					else { ?>
						<p><em>Il n'y a pas de news à afficher.</em></p>
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
						<a href="index.php?section=actualites&amp;typeActualite=<?php echo $_GET['typeActualite']; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php } else { ?>					
						<a href="index.php?section=actualites&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php } ?>
						<?php if($i == $page) {echo '</b>'; }?>
			<?php	} ?>
				</p>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>

