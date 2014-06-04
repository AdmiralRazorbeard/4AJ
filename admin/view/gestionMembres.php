<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper memberGestion">
				<h1>Gestion des membres</h1>
				<h4>Liste des membres</h4>
				<form method="post">
                    <p class="form-field">
                        <label>Trier par:</label>
                        <select name="orderBy">
                        	<option value="1" <?php if($selected==1){ ?>selected="selected" <?php } ?>>Nom</option>
                        	<option value="2" <?php if($selected==2){ ?>selected="selected" <?php } ?>>Prenom</option>
                            <option value="3" <?php if($selected==3){ ?>selected="selected" <?php } ?>>Ordre d'inscription</option>
                        </select>
                        <input type="submit">
                    </p>
                </form>
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
							<a href="index.php?section=modifierMembres&amp;modif=<?php echo $value['id']; ?>">
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
								<a href="index.php?section=deleteMembres&amp;delete=<?php echo $value['id']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce membre ?'));">
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
							<a href="index.php?section=gestionMembres&amp;page=<?php echo $i; ?>&amp;orderBy=<?php echo $orderBy; ?>"><?php echo $i; ?></a>
							<?php if($i == $page) {echo '</b>'; }?>
				<?php	} ?>
					</p>
			</div>
		</div>
	</body>
</html>