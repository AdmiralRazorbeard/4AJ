<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper fonction">
				<h1>Choisir les mails d'envoie des formulaires</h1>
				<form method="post">
					<label for="mailMain">Pour l'onglet contact principal : </label>
					<input type="mail" name="mailMain" id="mailMain" value='<?php echo $mailFormulaire["mailMain"]; ?>'><input type="submit"><br />
				</form>
				<form method="post">
					<label for="mailPlateformeLogement">Pour la plateforme logement : </label>
					<input type="mail" name="mailPlateformeLogement" id="mailPlateformeLogement" value="<?php echo $mailFormulaire['mailPlateformeLogement']; ?>"><input type="submit"><br />
				</form>
			</div>
		</div>
	</body>
</html>