<?php
include_once '/view/includes/header.php';
?>
		<div id="mainWrapper">
			<div class="contentWrapper memberGestion">
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
							<div>
								<?php echo $value['id']; ?>
							</div>
						</td>
						<td>
							<div>
								<?php echo $value['nomMembre']; ?>
							</div>
						</td>
						<td>
							<div>
							<?php echo $value['prenomMembre']; ?>
							</div>
						</td>
						<td>
							<div>
							<?php echo $value['mail']; ?>
							</div>
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
			<?php 	}	?>
				</table>
					<!-- Affiche les pages -->
					<p>
						<?php 
						$i = 1;
						for($i; $i <= $nbrePage; $i ++)
						{ ?>
							<?php if($i == $page) {echo '<b>'; }?>
							<a href="index.php?section=gestionMembres&page=<?php echo $i; ?>"><?php echo $i; ?></a>
							<?php if($i == $page) {echo '</b>'; }?>
				<?php	} ?>
					</p>
			</div>
		</div>
	</body>
</html>