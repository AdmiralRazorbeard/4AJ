<?php 
include_once '/view/includes/header.php';
include_once '/view/includes/submenuPlateformeLogement.php';
?>
			<div class="contentWrapper plateformeLogement edition_mode element">
			<?php tinymcetxt('contact_plateformeLogement'); ?><br /><br />
				<fieldset id="plateformeLogementContact">
					<form method="post">
						<p class="form-field">
						<label for="email">Votre adresse mail* : </label>
						<input type="mail" name="email" id="email" />
						</p>
						<p class="form-field">
						<label for="subject">Sujet du mail : </label>
						<input type="text" name="subject" id="subject" />
						</p>
						<p class="form-field-contenu">
						<label for="contenu">Contenu : </label>
						<textarea name="contenu" id="contenu"></textarea>
						<input type="submit">
					</form>
				</fieldset>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>		
	</body>
</html>