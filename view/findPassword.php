<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper">
				<h1>Changer le mot de passe de <?php echo $infoMembre['nomMembre']; ?></h1>
				<?php
				if(!empty($_SESSION['erreur']) && !empty($_SESSION['count']))
				{ ?>
					<em><?php echo $_SESSION['erreur']; ?></em>
		<?php		if($_SESSION['count'] == 2)
					{	$_SESSION['count']--; }
					else 
					{ unset($_SESSION['erreur']);
					  unset($_SESSION['count']); }
				} ?>
				<form method="post">
					<input type="hidden" name="securite" value="<?php echo $id; ?>">
					<legend for="password">Votre nouveau mot de passe : </legend>
					<input type="password" name="password" id="password"/>
					<input type="submit">
				</form>
			</div>
		</div>		
	</body>
</html>