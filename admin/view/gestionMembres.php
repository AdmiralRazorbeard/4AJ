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
</style>
	<body>
		<div>
			<h1>Gestion des membres</h1>
			<h4>Liste des membres</h4>
			<table>
				<tr>
					<th>
						ID
					</th>
					<th>
						Nom
					</th>
					<th>
						Prénom
					</th>
					<th>
						Email
					</th>
					<th>
						Fonction
					</th>
				</tr>
	<?php 		foreach ($listeMembre as $key => $value) 
				{ ?>
				<tr>
					<td>
						<?php echo $value['id']; ?>
					</td>
					<td>
						<?php echo $value['nomMembre']; ?>
					</td>
					<td>
						<?php echo $value['prenomMembre']; ?>
					</td>
					<td>
						<?php echo $value['mail']; ?>
					</td>
					<td>
						<select>
					<?php 	foreach($value['fonction'] as $k => $v)
							{ ?>
								<option><?php echo $v['nom']; ?></option>
				<?php		} ?>
						</select>
					</td>
				</tr>
		<?php 	}
	?>
			</table>
		</div>
	</body>
</html>