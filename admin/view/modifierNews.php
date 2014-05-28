<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper">
				<h1>Modifier la news n°<?php echo $infoNews['id']; ?></h1>
				<form method="post">
					<input type="text" value="<?php echo $infoNews['titre']; ?>" name="titre"/><br />
					<label for="contenu">Contenu: </label>
					<?php toolBox('contenu', $infoNews['contenu']); ?>
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>