<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper contact element">
				<h1>
					Formulaire de contact
				</h1><br />
				<fieldset>
					<label for="email">Adresse mail de retour* : </label>
					<input type="mail" name="email" id="email" /><br />
					<label for="subject">Sujet du mail : </label>
					<input type="text" name="subject" id="subject" /><br />
					<label for="contenu">Contenu : </label><br />
					<textarea name="contenu" id="contenu"></textarea><br />
					<input type="submit">
				</fieldset>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>