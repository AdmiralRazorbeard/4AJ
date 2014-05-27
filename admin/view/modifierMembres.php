<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Modifier membre</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="../view/style.css" />
	</head>
	<body>
		<div>
			<h1>Modifier <em><?php echo $infoMembre['nomMembre']; ?></em></h1>
			<form method="post">
				<?php if(!empty($message))
				{ echo '<em>'.$message.'</em><br />'; } ?>
				<input type="hidden" name="id" value="<?php echo $infoMembre['id']; ?>" />
				<label for="nom">Nom : </label><input type="text" id="nom" name="nom" value="<?php echo $infoMembre['nomMembre']; ?>"  /><br />
				<label for="prenom">Prénom : </label><input type="text" id="prenom" name="prenom" value="<?php echo $infoMembre['prenomMembre']; ?>" /><br />
				<label for="email">Email : </label><input type="mail" id="email" name="email" value="<?php echo $infoMembre['mail']; ?>" disabled /><br />
				<label for="adresse">Adresse : </label><input type="text" id="adresse" name="adresse"value="<?php echo $infoMembre['adresse']; ?>"  /><br />
				<label for="dateNaissance">Date de naissance : </label><input type="text" name="dateNaissance" id="dateNaissance" value="<?php echo $infoMembre['dateNaissance']; ?>"  /><br />
				<label for="telFixe">Téléphone fixe : </label><input type="text" name="telFixe" id="telFixe" value="<?php echo $infoMembre['telFixe']; ?>" /><br />
				<label for="telPortable">Téléphone portable : </label><input type="text" name="telPortable" id="telPortable" value="<?php echo $infoMembre['telPortable']; ?>" /><br />
				<label for="fonction">Fonction : </label>
				<select>
			<?php 	foreach($infoMembre['fonction'] as $k => $v)
						{ ?>
							<option><?php echo $v['nom']; ?></option>
			<?php		} ?>
				</select>
				<a href="index.php?section=modifierFonctionMembres&id=<?php echo $infoMembre['id']; ?>">Changer les fonctions du membres </a><br />
				<label for="password">Changer le mot de passe : </label><input type="password" id="password" name="password"/><br />
				<label for="isSuperAdmin">Super Administrateur : </label><input type="checkbox" id="isSuperAdmin" name="isSuperAdmin" <?php if($infoMembre['isSuperAdmin']) { echo 'checked'; } ?> /><br />
				<input type="submit" /><br /><br />
			</form>
		</div>
	</body>
</html>