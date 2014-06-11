<?php include_once 'view/includes/header.php'; ?>
			<div class="contentWrapper contact element">
				<h1>
					Formulaire de contact
				</h1><br />
				<fieldset id="mainContact">
					<form method="post">
						<p class="form-field">
						<label for="email">Adresse mail de retour* : </label>
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
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>