<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="/4AJ/view/styleInscription.css" />
		<link rel="icon" type="image/png" href="/4AJ/view/graphicRessources/favicon.jpg" >
		<meta charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	</head> 
	<body>
		<div class="mainWrapper">
			<div class="contentWrapper">
				<div>
					<h1><?php langue('S\'incrire à 4AJ, un tremplin pour les jeunes', 'Create an account for 4AJ'); ?></h1>
					<p id="info_inscription">
						<a href="index.php?section=index"><?php langue('Retourner à l\'accueil', 'Return to homepage'); ?></a>
					<?php if(isConnect()) { ?><em><?php langue('Vous êtes déjà connecté : ', 'You are already connected :'); ?><a href="index.php?section=index&amp;dislog=true"><?php langue('Se déconnecter', 'Log out'); ?></a></em><?php } ?>
					<?php if(!empty($message))
					{ ?>
						<em><?php echo $message; ?></em><br>
					<?php } ?>
					<?php if(!empty($message2))
					{ ?>
						<em><?php echo $message2; ?></em><br>
					<?php } ?>
					<?php if(!empty($message3))
					{ ?>
						<em><?php echo $message3; ?></em><br>
					<?php } ?>
					<?php if(!empty($message4))
					{ ?>
						<em><?php echo $message4; ?></em><br>
					<?php } ?>
					<?php if(!empty($message5))
					{ ?>
						<em><?php echo $message5; ?></em><br>
					<?php } ?>
					<?php if(!empty($message6))
					{ ?>
						<em><?php echo $message6; ?></em><br>
					<?php } ?>
					<?php if(!empty($message7))
					{ ?>
						<em><?php echo $message7; ?></em><br>
					<?php } ?>
					</p>
					<form method="post">
						<fieldset id="inscription">
							<p class="form-field">
							<label for="nom"><?php langue('Nom* : ', 'Name* : '); ?></label>
							<input required type="text" name="nom" id="nom">
							</p>
							<p class="form-field">
							<label for="prenom"><?php langue('Prénom* : ', 'Firstname* :'); ?></label>
							<input required type="text" name="prenom" id="prenom">
							</p>
							<p class="hp">
    						<label>Si vous êtes un humain, laissez ce champ vide*</label>
   							<input type="text" name="nickname">
							</p>
							<p class="form-field">
							<label for="mail">Email* : </label>
							<input required type="email" name="mail" id="mail">
							</p>
							<p class="form-field">
							<label for="adresse"><?php langue('Adresse : ', 'Adress :'); ?></label>
							<input type="text" name="adresse" id="adresse">
							</p>
							<p class="form-field">
							<label for="telFixe"><?php langue('Téléphone fixe : ', 'Fixed-line telephone : '); ?></label>
							<input type="text" name="telFixe" id="telFixe">
							</p>
							<p class="form-field">
							<label for="telPortable"><?php langue('Téléphone portable : ', 'Mobile phone : '); ?></label>
							<input type="text" name="telPortable" id="telPortable">
							</p>
							<p class="form-field">
							<label for="jourDateNaissance"><?php langue('Date de naissance : ', 'Birthdate : '); ?></label>
							<select id="jourDateNaissance" name="jourDateNaissance">
							<option value="0" selected>---</option>
							<?php
								for($i = 1; $i <= 31; $i++)
								{ ?>
									<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php 	}
								?>
							</select>
							<select id="moisDateNaissance" name="moisDateNaissance">
								<option value="0" selected>-------</option>
								<option value="1"><?php langue('Janvier', 'January'); ?></option>
								<option value="2"><?php langue('Février', 'February'); ?></option>
								<option value="3"><?php langue('Mars', 'March'); ?></option>
								<option value="4"><?php langue('Avril', 'April'); ?></option>
								<option value="5"><?php langue('Mai', 'May'); ?></option>
								<option value="6"><?php langue('Juin', 'June'); ?></option>
								<option value="7"><?php langue('Juillet', 'July'); ?></option>
								<option value="8"><?php langue('Août', 'August'); ?></option>
								<option value="9"><?php langue('Septembre', 'September'); ?></option>
								<option value="10"><?php langue('Octobre', 'October'); ?></option>
								<option value="11"><?php langue('Novembre', 'November'); ?></option>
								<option value="12"><?php langue('Décembre', 'December'); ?></option>
							</select>
							<select id="anneDateNaissance" name="anneDateNaissance">
								<option value="0" selected>-----</option>
								<?php 
								for($i = 1920; $i <= date('Y'); $i++)
								{ ?>
								<option value="<?php echo $i;?>"><?php echo $i; ?></option>
							<?php	} ?>
							</select>
							</p>
							<p class="form-field">
								<label for="recevoirMail"><?php langue('Recevoir des newsletters : ', 'Subscribe to the newsletters'); ?></label>
								<input type="checkbox" name="recevoirMail" id="recevoirMail" checked="checked">
							<p class="form-field">
								<label for="password1"><?php langue('Mot de passe* : ', 'Password* : '); ?></label>
								<input required type="password" name="password1" id="password1">
							</p>
							<p class="form-field">
								<label for="password2"><?php langue('Repeter mot de passe* : ', 'Repeat password* : '); ?></label>
								<input required type="password" name="password2" id="password2">
							</p>
							<p class="inscription_info">
								<em><?php langue('Le mot de passe doit contenir 7 caractères au minimun.', 'The password must contain at least 7 characters.'); ?></em><br>
								<em><?php langue('Les champs marqués d\'un * sont obligatoires.', 'Fields with * are mandatory.'); ?></em>
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
										<select required name="choix_forme" multiple="multiple" size="4">
                                			<option value="0" selected="selected"></option>
                                			<option value="1">Position 1</option>
                                			<option value="2">Position 2</option>
                                			<option value="3">Position 3</option>
                        				</select>
                        			</td>
							   </tr>
							</table>
							<input type="submit" value="<?php langue('Envoyer', 'Submit'); ?>">
							<input type="reset" value="<?php langue('Effacer', 'Reset'); ?>">
						</fieldset>
					</form>
					<script type="text/javascript">
					$("#refreshImg").click(function() {
   						$("#imgCodeVerif").attr("src","controller/codeVerifGen/verifCodeGen.php?r=" + Math.random());
					});
					</script>
					<script type="text/javascript">
					//Pour empecher les copier coller sur les mots de passe
					$("#password1").bind('copy cut paste', function(e) {
					e.preventDefault();
					});
					$("#password2").bind('copy cut paste', function(e) {
					e.preventDefault();
					});
					</script>
				</div>
			</div>
		</div>
	</body>
</html>


