<!DOCTYPE html>
<html>
	<head>
			<title>4AJ, un tremplin pour les jeunes</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="design.css" />
	</head> 
	<body>
		<div id="association">
			<h1>4AJ, un tremplin pour les jeunes</h1>
			<p>
				<?php if(!empty($message)) { ?>
				<p>
					<?php echo $message; ?>
				</p>
				<?php }	?>
				<?php
				if(isConnect()) {?>
					<a href="connection-dislog=true.html">Se déconnecter</a><br />
					<?php } else { ?>
					<a href="connection.html">Se connecter</a>
				<?php } ?><br />
				<a href="admin/">Partie admin</a><br />
			</p>
		</div>
	</body>
</html>