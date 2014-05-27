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
					<?php echo $value['nom']; ?>
				</td>	<!-- Création du tableau affichant, ça affiche la couleur, et pouvant être cliqué en utilisant la fonction changerFonction -->
				<td onclick="changerFonction(1, <?php echo $value['id'] ?>);" <?php if($value['isAccesJeunes']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
				<td onclick="changerFonction(2, <?php echo $value['id'] ?>);" <?php if($value['isAdminLivreOr']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
				<td onclick="changerFonction(3, <?php echo $value['id'] ?>);" <?php if($value['isAdminActualite']) { echo 'class="true"'; } else { echo 'class="false"'; } ?>>
				</td>
			</tr>

	<?php	} ?>


		</table>
	</body>
</html>