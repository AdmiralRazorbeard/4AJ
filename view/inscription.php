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
					<label for="password">Mot de passe* : </label><input type="password" name="password" id="password"><br />
					<em>Les champs marqués d'un * sont obligatoires.</em><br />
					<input type="submit"><input type="reset">
				</form>
			</p>
		</div>
	</body>
</html>