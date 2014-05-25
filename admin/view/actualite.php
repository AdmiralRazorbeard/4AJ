<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Actualité</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="../view/style.css" />
	</head> 

	<body>
		<div>
			<h1>Gestion des actualités </h1>
			<form method="post">
				<label for="titre">Titre : </label><input type="text" name="titre" id="titre" /><br />
				<label for="typeActualite">Type d'actualité : </label>
				<select name="typeActualite" id="typeActualite"onchange="
					if(this.selectedIndex == <?php echo $nbreTypeActualite; ?>)
					{
						javascript:location.href='index.php?section=typeActualite'
					}">
					<?php 
					foreach ($typeActualite as $k => $v) { ?>
						<option value="<?php echo $k; ?>"><?php echo $v['nom']; ?></option>
			<?php   } ?>
						<!-- Redirige vers la page "new type actualité" -->
						<option value="0">Ajouter un nouveau type d'actualité</option>
				</select><br />
				<label for="visiblePar">News visible par : </label><br />
				<!-- Affiche toutes les autres "fonction" -->
					<?php foreach ($allFonction as $k => $v) { ?>
						<input type="checkbox" <?php if($k == 1) { echo 'checked'; } ?> name="<?php echo $k; ?>" id="<?php echo $k; ?>"><label for="<?php echo $k; ?>"><?php echo $v['nom']; ?></label>
		<?php       } ?>
				</div>
				<label for="contenu">Contenu : </label><br />
					<?php toolBox('contenu'); ?>
				<input type="submit">

			</form>
		</div>
	</body>
</html>