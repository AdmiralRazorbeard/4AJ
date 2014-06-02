<!DOCTYPE html>
<html>
	<head>
		<title>4AJ, un tremplin pour les jeunes</title>
		<link rel="stylesheet" type="text/css" href="/4AJ/view/styleInscription.css" />
		<link rel="icon" type="image/png" href="/4AJ/view/graphicRessources/favicon.jpg" >
		<meta charset="utf-8">
	</head> 
	<body>
		<div class="mainWrapper">
			<div class="contentWrapper">
				<div>
					<h1>S'incrire à 4AJ, un tremplin pour les jeunes</h1>
					<p id="info_inscription">
						<a href="index.php?section=index">Retourner a l'accueil</a>
					<?php if(isConnect()) { ?><em>Vous êtes déjà connecté : <a href="index.php?section=connection&dislog=true">Se déconnecter</a></em><?php } ?>
					<?php if(!empty($message))
					{ ?>
						<em><?php echo $message; ?></em></br>
					<?php } ?>
					<?php if(!empty($message2))
					{ ?>
						<em><?php echo $message2; ?></em></br>
					<?php } ?>
					<?php if(!empty($message3))
					{ ?>
						<em><?php echo $message3; ?></em></br>
					<?php } ?>
					</p>
					<form method="post">
						<fieldset id="inscription">
							<p class="form-field">
							<label for="nom">Votre nom* : </label>
							<input required type="text" name="nom" id="nom">
							</p>
							<p class="form-field">
							<label for="prenom">Votre prénom* : </label>
							<input required type="text" name="prenom" id="prenom">
							</p>
							<p class="form-field">
							<label for="mail">Votre email* : </label>
							<input required type="text" name="mail" id="mail">
							</p>
							<p class="form-field">
							<label for="adresse">Votre adresse : </label>
							<input type="text" name="adresse" id="adresse">
							</p>
							<p class="form-field">
							<label for="telFixe">Votre Téléphone fixe : </label>
							<input type="text" name="telFixe" id="telFixe">
							</p>
							<p class="form-field">
							<label for="telPortable">Votre téléphone portable : </label>
							<input type="text" name="telPortable" id="telPortable">
							</p>
							<p class="form-field">
							<label for="jourDateNaissance">Date de naissance : </label>
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
								<option value="1">Janvier</option>
								<option value="2">Février</option>
								<option value="3">Mars</option>
								<option value="4">Avril</option>
								<option value="5">Mai</option>
								<option value="6">Juin</option>
								<option value="7">Juillet</option>
								<option value="8">Août</option>
								<option value="9">Septembre</option>
								<option value="10">Octobre</option>
								<option value="11">Novembre</option>
								<option value="12">Décembre</option>
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
								<label for="password">Mot de passe* : </label>
								<input required type="password" name="password" id="password">
							</p>
							<p class="inscription_info">
								<em>Les champs marqués d'un * sont obligatoires.</em>
							</p>
							<input type="submit">
							<input type="reset">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>