<?php include_once '/view/includes/header.php'; ?>
<?php include_once '/view/includes/footerfunctions.php'; ?>
			<div>
				<?php if(!empty($_SESSION['changerMotDePasse']))
				{
					echo '<em>'.$_SESSION['changerMotDePasse'].'</em>'; 
					unset($_SESSION['changerMotDePasse']);
				} ?>
				<div id="img_index">

					<!-- Gaffe, doit pas y avoir deux ids :O -->
				<div class="img_index img_index1"></div>
				<div class="img_index img_index2"></div>
				<div class="img_index img_index3"></div>
				<div class="img_index img_index4"></div>
				</div>
			</div>
			<div>
				<h1>4AJ, un tremplin pour les jeunes</h1>
				<p>
					<a href="admin/">Partie admin</a><br />
					<a href="membre/">Partie jeunes</a><br />
					<a href="index.php?section=livreor">Livre d'or</a>
				</p>
			</div>
		</div>
	</body>
</html>