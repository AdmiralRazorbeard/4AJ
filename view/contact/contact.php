<?php include_once 'view/includes/header.php'; ?>
			<div class="contentWrapper contact element edition_mode">
			<?php tinymcetxt('contact'); ?><br /><br />
				<fieldset id="mainContact">
					<form method="post">
						<p class="form-field">
						<label for="email">
							<?php if($_SESSION['langue'] == 2) { echo 'Your mail address : '; }
								else { echo 'Votre addresse mail :'; } ?> </label>
						<input type="mail" name="email" id="email" />
						</p>
						<p class="form-field">
						<label for="subject">
							<?php if($_SESSION['langue'] == 2) { echo 'Mail subject : '; }
							else { echo 'Sujet du mail : '; } ?></label>
						<input type="text" name="subject" id="subject" />
						</p>
						<p class="form-field-contenu">
						<label for="contenu">
							<?php if($_SESSION['langue'] == 2) { echo 'Content : '; } 
							else { echo 'Contenu : '; } ?></label>
						<textarea name="contenu" id="contenu"></textarea>
						<input type="submit" <?php if($_SESSION['langue']==2) { echo 'value="Validate"'; } ?>>
					</form>
				</fieldset>
			</div>
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>