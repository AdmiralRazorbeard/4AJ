<?php include_once '../includes/header.php'; ?>
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
					<a href="index.php?section=connection&dislog=true">Se déconnecter</a><br />
					<?php } else { ?>
					<a href="index.php?section=connection">Se connecter</a>
				<?php } ?><br />
				<a href="admin/">Partie admin</a><br />
				<a href="membre/">Partie jeunes</a><br />
			</p>
		</div>
	</body>
</html>