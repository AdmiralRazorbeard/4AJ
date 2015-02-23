<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper viderReservations">
				<h1>Vider les anciens enregistrements de réservations</h1>
				<a href="index.php?section=gestionRepas">Retour</a>
				<?php if($message!=NULL) ?>
					<br><?php echo $message; 
				?>
				<p>
					<em>Le bouton permet de supprimer les enregistrements qui datent d'il y a plus de 3 mois.</em><br>
					<em>Cela permet de libérer de l'espace dans la base de données et d'accélerer le chargement des calendriers pour les réservations.</em><br>
					<em>Avant de cliquez sur le bouton, assurez-vous d'avoir téléchargé le récapitulatif des réservations membre (dernier bouton au bas de la page précédente) pour les trois derniers mois et pour les deux résidences (afin de garder une trace des réservations).</em>
				</p>
				<input type="submit" onclick="location.href='index.php?section=viderReservations&amp;delete=true';" value="Vider les anciens enregistrements de réservations">
			</div>
		</div>
	</body>
</html>