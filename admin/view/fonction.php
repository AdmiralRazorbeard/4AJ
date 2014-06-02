<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper fonction">
				<script type="text/javascript">
				function changerFonction(type, id)
				{	/*Fonction redirige sur la même page en mettant les paramètres en GET */
					javascript:location.href='index.php?section=fonction&type='+type+'&id='+id;
				}
				</script>
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
						<th>
							Autorisation manger midi
						</th>
						<th>
							Autorisation manger soir et week end
						</th>
					</tr>
					<?php
					foreach ($allFonction as $key => $value) { ?>
					<tr>
						<td>
							<div>
								<a href="index.php?section=fonction&amp;fonction=<?php echo $value['id']; ?>">
									<!-- Ceci permettra d'afficher les membres de la fonction -->
									<?php echo $value['nom']; ?>
								</a>
							</div>
						</td>	
						<!-- Création du tableau affichant, ça affiche la couleur, et pouvant être cliqué en utilisant la fonction changerFonction -->
						<td onclick="changerFonction(1, <?php echo $value['id'] ?>);" <?php if($value['isAccesJeunes']) { echo 'class="true"><img src="view/graphicRessources/true.png"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png"/>'; } ?>
						</td>
						<td onclick="changerFonction(2, <?php echo $value['id'] ?>);" <?php if($value['isAdminLivreOr']) { echo 'class="true"><img src="view/graphicRessources/true.png"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png"/>'; } ?>
						</td>
						<td onclick="changerFonction(3, <?php echo $value['id'] ?>);" <?php if($value['isAdminActualite']) { echo 'class="true"><img src="view/graphicRessources/true.png"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png"/>'; } ?>
						</td>
						<td onclick="changerFonction(4, <?php echo $value['id'] ?>);" <?php if($value['autorisationMangerMidi']) { echo 'class="true"><img src="view/graphicRessources/true.png"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png"/>'; } ?>
						</td>
						<td onclick="changerFonction(5, <?php echo $value['id'] ?>);" <?php if($value['autorisationMangerSoir']) { echo 'class="true"><img src="view/graphicRessources/true.png"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png"/>'; } ?>
						</td>

						<?php if($value['id'] != 1) { ?>
						<!-- On ne peut pas supprimer la fonction "public" -->
						<td>
							<a href="index.php?section=fonction&amp;delete=<?php echo $value['id']; ?>">Supprimer</a>
						</td>
						<?php }
						else {?>
						<td>
							<p id="impossible">Supprimer</p>
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
							, <a href="index.php?section=fonction&amp;fonction=<?php echo $_GET['fonction']; ?>&amp;supprimerMembre=<?php echo $value['id']; ?>">Supprimer</a></li>
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
			</div>
		</div>
	</body>
</html>