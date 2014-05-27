<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Actualité</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="../view/style.css" />
	</head>
	<style>
		table
		{
		    border-collapse: collapse; /* Les bordures du tableau seront collées (plus joli) */
		    background-color:white;
		}
		td
		{
		    border: 1px solid black;
		}
		th
		{
			width: 150px;
			border-left:1px solid black;
		}
		.false
		{
			background-color:red;
			cursor:pointer;
		}
		.true
		{
			background-color: green;
			cursor:pointer;
		}
	</style> 
	<script type="text/javascript">
	function changerFonction(type, id)
	{	/*Fonction redirige sur la même page en mettant les paramètres en GET */
		javascript:location.href='index.php?section=fonction&type='+type+'&id='+id;
	}
	</script>
	<body>
		<h1>Ajouter, modifier les fonctions</h1>
		<p>
			<em>Vous pouvez modifier les droits en cliquants</em>
		</p>
		<table>
			<tr>
				<th>
					Nom Fonction
				</th>
				<th>
					Accès Partie Jeune
				</th>
				<th>
					Admin Livre Or
				</th>
				<th>
					Admin Actualité
				</th>
			</tr>
			<?php
			foreach ($allFonction as $key => $value) { ?>
			<tr>
				<td>
					<a href="index.php?section=fonction&fonction=<?php echo $value['id']; ?>">
						<!-- Ceci permettra d'afficher les membres de la fonction -->
						<?php echo $value['nom']; ?>
					</a>
				</td>	
				<!-- Création du tableau affichant, ça affiche la couleur, et pouvant être cliqué en utilisant la fonction changerFonction -->
				<td onclick="changerFonction(1, <?php echo $value['id'] ?>);" <?php if($value['isAccesJeunes']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
				<td onclick="changerFonction(2, <?php echo $value['id'] ?>);" <?php if($value['isAdminLivreOr']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
				<td onclick="changerFonction(3, <?php echo $value['id'] ?>);" <?php if($value['isAdminActualite']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
				<?php if($value['id'] != 1) { ?>
				<!-- On ne peut pas supprimer la fonction "public" -->
				<td>
					<a href="index.php?section=fonction&delete=<?php echo $value['id']; ?>">Supprimer</a>
				</td>
				<?php } ?>
			</tr>
	<?php	} ?>
		</table>
		<form method="post">
			<!-- Ajout d'une nouvelle fonction -->
			<label for="nom">Ajouter une nouvelle fonction : </label><input type="text" name="nom" id="nom" />
			<input type="submit" />
		</form>
		<hr />
		<?php if(!empty($_GET['fonction']) && !empty($allFonction[$_GET['fonction']]['nom']))
			// Si l'utilisateur à choisi une fonction, on affiche la liste des membres 
		{ ?>
			<h3>
				Fonction <?php echo $allFonction[$_GET['fonction']]['nom']; ?>
			</h3>
	<?php	if(!empty($allMembreIn)) { ?>
				<!-- Si il ya des membres dans la fonction, on les affiches -->
			<ul>
				<?php foreach ($allMembreIn as $key => $value) { ?>
				<!-- On affiche la liste des membres -->
				<li><?php echo $value['nom']; ?>
					<?php if($_GET['fonction'] != 1) { ?>
					<!-- On ne peut supprimer un membre d'une fonction que si ce n'est pas la fonction public -->
					, <a href="index.php?section=fonction&fonction=<?php echo $_GET['fonction']; ?>&supprimerMembre=<?php echo $value['id']; ?>">Supprimer</a></li>
					<?php } ?>
		<?php	} ?>
			</ul>
	<?php 	} 
			/* FIN DE SI */
			/* --------- */
			if(!empty($allMembreNotInFonction))
				// Si il reste des membres qui ne sont pas dans la fonction, on propose de les ajouters 
			{ ?>
			<form method="post">
				<input type="hidden" name="idFonction" value="<?php echo $_GET['fonction']; ?>" />
				<select name="addMembreInFonction">
				<?php foreach ($allMembreNotInFonction as $key => $value) { ?>
					<option value="<?php echo $value['id']; ?>">
						<?php echo $value['nom']; ?>
					</option>
		<?php		} ?>
				</select>
				<input type="submit" value="Ajouter à la fonction" />
			</form>
	<?php 	} 
		} ?>
	</body>
</html>