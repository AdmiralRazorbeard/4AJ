<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper memberGestion">
				<h1>Gestion des membres</h1>
				<h4>Liste des membres (Les super administrateurs sont affichés en rouge)</h4>
				<form method="post">
                    <p class="form-field">
                        <label>Trier par:</label>
                        <select id="orderBy" name="orderBy">
                        	<option value="1" <?php if($selected==1){ ?>selected="selected" <?php } ?>>Nom</option>
                        	<option value="2" <?php if($selected==2){ ?>selected="selected" <?php } ?>>Prenom</option>
                            <option value="3" <?php if($selected==3){ ?>selected="selected" <?php } ?>>Ordre d'inscription</option>
                        </select>
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
					<tr <?php if($value['isSuperAdmin']) { echo 'class="superAdminMembre"'; } ?>>
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
								<button value="<?php echo $value['id']; ?>" class="dellmb">Supprimer</button>
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
					<input type="submit" onclick="location.href='index.php?section=generationListeMembres';" value="Télécharger la liste des membres">
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
	        $('body').on('click', '.dellmb', function() {
	      		var value=$(this).attr('value');
	      		if(confirm('Attention ! Si le membre a reservé des repas, les enregistrements dans la base de données seront supprimés, souhaitez-vous continuer?')){
	          		$('.contentWrapper').load("index.php?section=gestionMembres&page=<?php echo $page; ?>&orderBy=<?php echo $orderBy; ?>&delete="+value+" "+".contentWrapper");
	          	}
	       	});
	       	$('body').change('#orderBy', function () {
				var value2 = $("#orderBy" ).val();
				$('.contentWrapper').load("index.php?section=gestionMembres "+".contentWrapper",{ orderBy:value2});
			});
		});
	</script>	
	</body>
</html>