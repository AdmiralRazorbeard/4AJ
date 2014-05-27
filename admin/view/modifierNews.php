<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper">
				<h1>Modifier la news n°<?php echo $infoNews['id']; ?></h1>
				<form method="post">
					<input type="text" value="<?php echo $infoNews['titre']; ?>" name="titre"/><br />
					<textarea name="contenu" id="contenu" cols="50" rows="15"><?php echo $infoNews['contenu']; ?></textarea><br />
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>