<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Type d'actualité</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="design.css" />
	</head> 
	<body>
		<h1>Modifier la news n°<?php echo $infoNews['id']; ?></h1>
		<form method="post">
			<input type="text" value="<?php echo $infoNews['titre']; ?>" name="titre"/><br />
			<textarea name="contenu" id="contenu" cols="50" rows="15"><?php echo $infoNews['contenu']; ?></textarea><br />
			<input type="submit">
		</form>
	</body>
</html>