<?php include_once 'view/includes/header.php'; ?>
			<div class="contentWrapper contact element edition_mode">
			<?php tinymcetxt('contact'); ?><br /><br />
				<?php if(!empty($confirmationContact))
				{ ?>
					<em><?php echo $confirmationContact; ?></em></br>
				<?php } ?>
				<fieldset id="mainContact">
					<form method="post">
						<p class="form-field">
						<label for="email"><?php langue('Votre adresse mail* : ', 'Your mail adress* : '); ?></label>
						<input type="mail" name="email" id="email" />
						</p>
						<p class="form-field">
						<label for="subject"><?php langue('Sujet du mail* : ', 'Mail subject* : '); ?></label>
						<input type="text" name="subject" id="subject" />
						</p>
						<p class="hp">
    						<label>Si vous êtes un humain, laissez ce champ vide</label>
   							<input type="text" name="name">
						</p>
						<p class="form-field-contenu">
						<label for="contenu"><?php langue('Contenu* : ', 'Content* :'); ?></label>
						<textarea name="contenu" id="contenu"></textarea><br>
						<em><?php langue('Les champs marqués d\'un * sont obligatoires.', 'Fields with * are mandatory.'); ?></em><br><br>
						<em><?php langue('Répondez aux deux questions de securité*:', 'Answer the two security questions*:'); ?></em><br>
							<table id="tableCaptcha">
							   <tr>
							       <td align="center"><em><?php langue('Quelle est le nombre indiqué ci-dessous?', 'What is the number below?'); ?></em>
							       </td>
							       <td align="center">								
										<?php if($_SESSION['aleat_nbr_forme']==1)
										{ ?>
										<em><?php langue('Quelle est la position du carré ?', 'Where is the square?'); ?></em><br>
										<?php } ?>
										<?php if($_SESSION['aleat_nbr_forme']==2)
										{ ?>
										<em><?php langue('Quelle est la position du cercle ?', 'Where is the circle?'); ?></em><br>
										<?php } ?>
										<?php if($_SESSION['aleat_nbr_forme']==3)
										{ ?>
										<em><?php langue('Quelle est la position du triangle ?', 'Where is the triangle?'); ?></em><br>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td align="center">
										<img id="refreshImg" src="controller/codeVerifGen/refresh.png" alt="Refresh image" /><img src="controller/codeVerifGen/verifCodeGen.php" alt="Code de vérification" id="imgCodeVerif"/><input type="text" name="verif_code" />
									</td>
									<td align="center">
										<img src="controller/codeVerifGen/fond_verif_img2.png" alt="Code de vérification2" />
										<select name="choix_forme" multiple="multiple" size="3">
                                			<option value="1" selected="selected">Position 1</option>
                                			<option value="2">Position 2</option>
                                			<option value="3">Position 3</option>
                        				</select>
                        			</td>
							   </tr>
							</table>
						<input type="submit" <?php if($_SESSION['langue']==2) { echo 'value="Validate"'; } ?>>
					</form>
					<script type="text/javascript">
					$("#refreshImg").click(function() {
						$("#imgCodeVerif").attr("src","controller/codeVerifGen/verifCodeGen.php?r=" + Math.random());
					});
					</script>
				</fieldset>
			</div>
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>