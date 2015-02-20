<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>
					Fonction du membre <?php echo $infoMembre['nomMembre']; ?>
				</h1>
				<a href="index.php?section=modifierMembres&amp;modif=<?php echo $_GET['id'] ?>">Retour</a>
				<div>
					<fieldset class="changeMemberFunction">
					<label>Fonctions actuelles:</label>
					<select>
					<?php 	foreach($infoMembre['fonction'] as $k => $v)
								{ ?>
									<option><?php echo $v['nom']; ?></option>
					<?php		} ?>
					</select>
					</fieldset>
					<form method="post">
						<fieldset class="changeMemberFunction">
						<label for="deleteFonction">Supprimer une de ses fonctions: </label>
						<!-- Affiche toutes les fonctions du membres -->
						<select name="deleteFonction" id="deleteFonction">
						<?php 	foreach($infoMembre['fonction'] as $k => $v)
									{ ?>
										<option value="<?php echo $v['id']; ?>" <?php if($v['id'] == 1) { echo 'disabled'; } ?>><?php echo $v['nom']; ?></option>
						<?php		} ?>
						</select>
						<input type="submit" value="Enregistrer" />
						</fieldset>
					</form>

					<?php
					if(!empty($allFonction))
						// Vérification pour être sûr qu'il reste des fonctions à attribué
					{ ?>
						<form method="post">
							<fieldset class="changeMemberFunction">
							<label for="addFonction">Ajouter une fonction: </label>
							<!-- Affiche toutes les fonctions dont le membre ne fait pas parti -->
							<select name="addFonction" id="addFonction">
							<?php 	foreach ($allFonction as $k => $v) { ?>
									<option value="<?php echo $v['id']; ?>"><?php echo $v['nom']; ?></option>
							<?php	} ?>
							</select>
							<input type="submit" value="Enregistrer" />
							</fieldset>
						</form>
					<?php
					} else { ?>
					<em>Il n'y a pas d'autres fonctions disponibles</em>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>