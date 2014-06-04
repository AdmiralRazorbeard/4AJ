<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper">
				<h1>Changer de mot de passe</h1>
				<?php if(!empty($message)) { ?>
				<p>
					<em><?php echo $message; ?></em>
				</p>
				<?php } ?>
				<form method="post">
					<legend for="email">Votre adresse mail : </legend>
					<input type="text" name="email" id="email"/>
					<input type="submit">
				</form>
			</div>
		</div>		
	</body>
</html>