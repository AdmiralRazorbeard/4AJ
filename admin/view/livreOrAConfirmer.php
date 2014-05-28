<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper">
			<h1>Gestion du livre d'or </h1>
			<?php
			if($nbreLivreOrAConfirmer <= 0)
			{
				echo '<em>Il n\'y a plus de commentaire à confirmer.</em>';
			}
			else
			{
				foreach ($allLivreOr as $key => $value) { ?>
						<!-- Affiche tous les nouveaux billets du livre d'or pas encore confirmé -->
					<h4><?php echo $value['nom']; ?>
					<?php if($value['mail'] != 'null') { echo ', <a href="mailto:'.$value['mail'].'">'.$value['mail'].'</a>'; } ?></h4>	
					<p>
						<?php echo $value['contenu']; ?><br /><br />
						<em><a href="index.php?section=livreOrAConfirmer&confirm=<?php echo $key; ?>">Confirmer</a></em><br />
						<em><a href="index.php?section=livreOrAConfirmer&delete=<?php echo $key; ?>">Supprimer</a></em>
					</p>
	<?php		}
			}
			?>
			</div>
		</div>
	</body>
</html>