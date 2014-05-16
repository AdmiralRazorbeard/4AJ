<!DOCTYPE html>
<html>
	<head>
			<title>Page de connection</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="design.css" />
	</head> 
	<body>
		<div>
			<h1>Page de connection</h1>
			<?php
			if(!empty($message))
			{
				echo '<em>'.$message.'</em><br />'; 
			} ?><br />
			<br />
			<a href="index.html">Accueil</a>
			<form method="post">
				<legend for="mail">Votre email : </legend><input type="name" id="mail" name="mail" /><br />
				<legend for="password">Mot de passe : </legend><input type="password" id="password" name="password" /><br />
				<input type="submit"/>
			</form>
		</div>
	</body>
</html>