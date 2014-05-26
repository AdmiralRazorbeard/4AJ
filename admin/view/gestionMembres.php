<!DOCTYPE html>
<html>
	<head>
			<title>ADMIN | Membres</title>
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
					<th>
						Modifier
					</th>
					<th>
						Supprimer
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
					<td>
						<a href="index.php?section=modifierMembres&modif=<?php echo $value['id']; ?>">
							Modifier
						</a>
					</td>
					<td>
						<!-- Si superAdmin, il ne peut pas être supprimer -->
				<?php 	if($value['isSuperAdmin']) { ?>
							<a href="#" title="Ce membre ne peut pas être supprimer" onclick="alert('Ce membre ne peut pas être supprimer.')">
								Supprimer
							</a>
				<?php 	} else { ?>
							<a href="index.php?section=deleteMembres&delete=<?php echo $value['id']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce membre ?'));">
								Supprimer
							</a>
				<?php 	} ?>
					</td>
				</tr>
		<?php 	}
	?>
			</table>
		</div>
	</body>
</html>