<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper parameters">
				<form method="post">
					<fieldset id="changeMember">
						<input type="hidden" name="modification" value="on" />
						<p class="form-field">
						<label for="nom">Nom : </label><input type="text" id="nom" name="nom" value="<?php echo $infoMembre['nomMembre']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="prenom">Prénom : </label><input type="text" id="prenom" name="prenom" value="<?php echo $infoMembre['prenomMembre']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="adresse">Adresse : </label><input type="text" id="adresse" name="adresse" value="<?php echo $infoMembre['adresse']; ?>"  />
						</p>
						<p class="form-field">
						<label for="dateNaissance">Date de naissance : </label><input type="text" name="dateNaissance" id="dateNaissance" value="<?php echo $infoMembre['dateNaissance']; ?>" disabled />
						</p>
						<p class="form-field">
						<label for="telFixe">Téléphone fixe : </label><input type="text" name="telFixe" id="telFixe" value="<?php echo $infoMembre['telFixe']; ?>" />
						</p>
						<p class="form-field">
						<label for="telPortable">Téléphone portable : </label><input type="text" name="telPortable" id="telPortable" value="<?php echo $infoMembre['telPortable']; ?>" />
						</p>
						<p class="form-field">
						<label for="fonction">Fonction : </label>
						<select>
					<?php 	foreach($infoMembre['fonction'] as $k => $v)
								{ ?>
									<option><?php echo $v['nom']; ?></option>
					<?php		} ?>
						</select>
						<br><br></p>
						<p class="form-field">
						<label>Changer le mot de passe :</label><br>
						<?php if(!empty($messageMdp))
						{ ?>
						<em><?php echo $messageMdp; ?></em>
						<?php } ?>
						</p>
						<p class="form-field">
						<label for="changePassword1">Ancien mot de passe : </label><input type="password" id="changePassword1" name="password1"/>
						</p>
						<p class="form-field">
						<label for="changePassword2">Nouveau mot de passe : </label><input type="password" id="changePassword2" name="password2"/>
						</p>
						<p class="form-field">
						<label for="changePassword3">Repeter mot de passe : </label><input type="password" id="changePassword3" name="password3"/>
						</p>
						<input type="submit" />
					</fieldset>
				</form>
				<form method="post">
					<fieldset>
						<input type="hidden" name="recevoirMail" value="true"/>
						<p>
							<label for="recevoirMailQuandNews">Autoriser la reception de newsletters : </label><input type="checkbox"  id="recevoirMailQuandNews" <?php if($infoMembre['recevoirMailQuandNews']) { echo 'checked'; } ?> name="recevoirMailQuandNews"> 
						</p>
						<input type="submit">
					</fieldset>
				</form>
				<?php 	
				if(isSuperAdmin() == false) { ?>
				<!-- Si superAdmin: impossible de se désinscrire -->
				<form action="index.php?section=deleteAccount" method="post" enctype="multipart/form-data" >
                	<fieldset>
                        <label>Se désinscrire :</label> <input type="checkbox" name="deleteAccount" onclick="return(confirm('Etes-vous sûr de vouloir supprimer votre compte définitivement? Si oui: Ok puis Envoyer'));"/>                      
                    	<input type="submit" class="submit" name="send" value="Envoyer"/>
                	</fieldset>
            	</form>
            	<?php }	?>
			</div>	
		</div>		
	</body>
</html>