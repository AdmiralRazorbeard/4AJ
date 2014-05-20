<!DOCTYPE html>
<html>
	<head>
			<title>4AJ, un tremplin pour les jeunes</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="design.css" />
	</head> 
	<body>
		<div>
			<h1>S'incrire à 4AJ, un tremplin pour les jeunes</h1>
			<?php if(isConnect()) { ?><em>Vous êtes déjà connecter : <a href="index.php?section=connection&dislog=true">Se déconnecter</a></em><?php } ?>
			<?php if(!empty($message))
			{ ?>
			<p>
				<em><?php echo $message; ?></em>
			</p>
			<?php } ?>
			<p>
				<form method="post">
					<label for="nom">Votre nom* : </label><input type="text" name="nom" id="nom"><br />
					<label for="prenom">Votre prénom* : </label><input type="text" name="prenom" id="prenom"><br />
					<label for="mail">Votre email* : </label><input type="text" name="mail" id="mail"><br />
					<label for="adresse">Votre adresse : </label><input type="text" name="adresse" id="adresse"><br />
					<label for="telFixe">Votre Téléphone fixe : </label><input type="text" name="telFixe" id="telFixe"><br />
					<label for="telPortable">Votre téléphone portable : </label><input type="text" name="telPortable" id="telPortable"><br />
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
						<option value="5">Mail</option>
						<option value="6">>Juin</option>
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
					</select><br />
					<label for="password">Mot de passe* : </label><input type="password" name="password" id="password"><br />
					<em>Les champs marqués d'un * sont obligatoires.</em><br />
					<input type="submit"><input type="reset">
				</form>
			</p>
		</div>
	</body>
</html>