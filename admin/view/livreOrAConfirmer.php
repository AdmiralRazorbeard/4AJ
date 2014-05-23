<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Livre d'or</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="design.css" />
	</head> 
	<body>
		<div>
			<h1>Gestion du livre d'or </h1>
			<?php
			if($nbreLivreOrAConfirmer <= 0)
			{
				echo '<em>Il n\'y a plus de commentaire à confirmer.</em>';
			}
			else
			{
				foreach ($allLivreOr as $key => $value) { ?>
					<h4><?php echo $value['nom']; ?>
					<?php if($value['mail'] != 'null') { echo ', <a href="mailto:'.$value['mail'].'">'.$value['mail'].'</a>'; } ?></h4>	
					<p>
						<?php echo $value['contenu']; ?><br /><br />
						<em><a href="index.php?section=livreOrAConfirmer&confirm=<?php echo $key; ?>">Confirmer</a></em><br />
						<em><a href="index.php?section=livreOrAConfirmer&delete=<?php echo $key; ?>">Supprimer</a></em>
					</p>
	<?php		}
			}
			?>
		</div>
	</body>
</html>