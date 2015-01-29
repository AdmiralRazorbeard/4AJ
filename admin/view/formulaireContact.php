<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper fonction">
				<h1>Choisir les mails auxquels les formulaires se destinent</h1>
				<fieldset id="formulaireContact">
					<form method="post">
						<p class="form-field">
						<label for="mailMain">Pour l'onglet contact principal : </label>
						<input type="text" name="mailMain" id="mailMain" value='<?php echo $mailFormulaire["mailMain"]; ?>'><input type="submit">
						</p>
						
					</form>
					<form method="post">
						<p class="form-field">
						<label for="mailPlateformeLogement">Pour la plateforme logement : </label>
						<input type="text" name="mailPlateformeLogement" id="mailPlateformeLogement" value="<?php echo $mailFormulaire['mailPlateformeLogement']; ?>"><input type="submit">
						</p>
					</form>
				</fieldset>
			</div>
		</div>
	</body>
</html>