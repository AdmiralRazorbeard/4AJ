<?php 
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Changer de mot de passe</h1>
				<?php if(!empty($error)) { ?>
				<p>
					<em><?php echo $error; ?></em>
				</p>
				<?php } ?>
				<form method="post">
					<label for="email"><?php langue('Votre adresse mail : ', 'Your mail adress : '); ?></label>
					<input required type="text" name="email" id="email"/><br>
					<p class="hp">
    					<label>Si vous êtes un humain, laissez ce champ vide*</label>
   						<input type="text" name="name">
					</p>
					<em><?php langue('Répondez aux deux questions de securité*:', 'Answer the two security questions*:'); ?></em><br>
							<table id="tableCaptcha">
							   <tr>
							       <td><em><?php langue('Quelle est le nombre indiqué ci-dessous?', 'What is the number below?'); ?></em>
							       </td>
							       <td>								
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
									<td>
										<img id="refreshImg" src="controller/codeVerifGen/refresh.png" alt="Refresh image" /><img src="controller/codeVerifGen/verifCodeGen.php" alt="Code de vérification" id="imgCodeVerif"/><input required type="text" name="verif_code" />
									</td>
									<td>
										<img src="controller/codeVerifGen/fond_verif_img2.png" alt="Code de vérification2" />
										<select required name="choix_forme" size="4">
                                			<option value="0" selected="selected"></option>
                                			<option value="1">Position 1</option>
                                			<option value="2">Position 2</option>
                                			<option value="3">Position 3</option>
                        				</select>
                        			</td>
							   </tr>
							</table>
					<input type="submit" value="<?php langue('Envoyer', 'Send'); ?>">
				</form>
				<script type="text/javascript">
				$("#refreshImg").click(function() {
					$("#imgCodeVerif").attr("src","controller/codeVerifGen/verifCodeGen.php?r=" + Math.random());
				});
				</script>
			</div>
		</div>		
	</body>
</html>