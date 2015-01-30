<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper parameters">
				<form method="post">
					<fieldset id="changeMember">
						<input type="hidden" name="modification" value="on" />
						<p class="form-field">
						<label for="nom"><?php langue('Nom', 'Name'); ?> : </label><input type="text" id="nom" name="nom" value="<?php echo $infoMembre['nomMembre']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="prenom"><?php langue('Prénom', 'Firstname'); ?> : </label><input type="text" id="prenom" name="prenom" value="<?php echo $infoMembre['prenomMembre']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="adresse"><?php langue('Adresse', 'Adress'); ?> : </label><input type="text" id="adresse" name="adresse" value="<?php echo $infoMembre['adresse']; ?>"  />
						</p>
						<p class="form-field">
						<label for="dateNaissance"><?php langue('Date de naissance', 'Birthdate'); ?> : </label><input type="text" name="dateNaissance" id="dateNaissance" value="<?php echo $infoMembre['dateNaissance']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="telFixe"><?php langue('Téléphone fixe', 'Fixed-line telephone'); ?> : </label><input type="text" name="telFixe" id="telFixe" value="<?php echo $infoMembre['telFixe']; ?>" />
						</p>
						<p class="form-field">
						<label for="telPortable"><?php langue('Téléphone portable', 'Mobile phone'); ?> : </label><input type="text" name="telPortable" id="telPortable" value="<?php echo $infoMembre['telPortable']; ?>" />
						</p>
						<p class="form-field">
						<label>Fonction : </label>
						<select>
					<?php 	foreach($infoMembre['fonction'] as $k => $v)
								{ ?>
									<option><?php echo $v['nom']; ?></option>
					<?php		} ?>
						</select>
						<br><br></p>
						<p class="form-field">
						<label><?php langue('Changer le mot de passe', 'Change password'); ?></label><br>
						<?php if(!empty($messageMdp))
						{ ?>
						<em><?php echo $messageMdp; ?></em>
						<?php } ?>
						</p>
						<p class="form-field">
						<label for="changePassword1"><?php langue('Ancien mot de passe', 'Old password'); ?> : </label><input type="password" id="changePassword1" name="password1"/>
						</p>
						<p class="form-field">
						<label for="changePassword2"><?php langue('Nouveau mot de passe', 'New password'); ?> : </label><input type="password" id="changePassword2" name="password2"/>
						</p>
						<p class="form-field">
						<label for="changePassword3"><?php langue('Repeter mot de passe', 'Repeat password'); ?> : </label><input type="password" id="changePassword3" name="password3"/>
						</p>
						<input type="submit" />
					</fieldset>
				</form>
				<form method="post">
					<fieldset>
						<input type="hidden" name="recevoirMail" value="true"/>
						<p>
							<label for="recevoirMailQuandNews"><?php langue('Autoriser la réception de newsletters', 'Receive newsletters'); ?> : </label><input type="checkbox"  id="recevoirMailQuandNews" <?php if($infoMembre['recevoirMailQuandNews']) { echo 'checked'; } ?> name="recevoirMailQuandNews"> 
						</p>
						<input type="submit" <?php langue('value=Valider', 'value=Validate'); ?>>
					</fieldset>
				</form>
				<?php 	
				if(isSuperAdmin() == false) { ?>
				<!-- Si superAdmin: impossible de se désinscrire -->
				<form method="post">
					<fieldset>
						<?php if(!empty($messageSuppressionCompte))
						{ ?>
							<em><?php echo $messageSuppressionCompte; ?></em><br>
						<?php } ?>
						<input type="hidden" name="supprimerMembre" value="true"/>
						<input type="submit" value="<?php langue('Supprimer mon compte', 'Delete my account'); ?>" onclick="return(confirm('Etes-vous certain de vouloir supprimer votre compte?'))"/>
					</fieldset>
				</form>
				<?php }	?>
				<script>
				//Pour empecher le copier coller sur certain champs du formulaire
				$("#changePassword1").bind('copy cut paste', function(e) {
				e.preventDefault();
				});
				$("#changePassword2").bind('copy cut paste', function(e) {
				e.preventDefault();
				});
				$("#changePassword3").bind('copy cut paste', function(e) {
				e.preventDefault();
				});
				</script>
			</div>	
		</div>		
	</body>
</html>