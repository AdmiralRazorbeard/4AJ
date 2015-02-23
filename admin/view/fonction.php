<?php
include_once 'view/includes/header.php';
?>
			<div class="contentWrapper fonction">
				<h1>Fonctions des membres</h1>
				<?php if(!empty($_GET['fonction']) && !empty($allFonction[$_GET['fonction']]['nom']))
					// Si l'utilisateur à choisi une fonction, on affiche la liste des membres 
				{ ?>
					<h3>
						Fonction <?php echo $allFonction[$_GET['fonction']]['nom']; ?>
					</h3>
					<div id="listeDesMembres">
			<?php	if(!empty($allMembreIn)) 
					{ ?>
						<!-- Si il ya des membres dans la fonction, on les affiches -->
						<h4>Liste des membres possédant la fonction <?php echo $allFonction[$_GET['fonction']]['nom']; ?> :</h4>
							<?php foreach ($allMembreIn as $key => $value) { ?>
							<!-- On affiche la liste des membres -->
							<?php if($_GET['fonction'] != 1) { ?>
							<button value="<?php echo $value['id']; ?>" class="deleteFonction">Enlever la fonction</button>
							<?php } ?>
								<!-- On ne peut supprimer un membre d'une fonction que si ce n'est pas la fonction public -->
								&nbsp;<?php echo $value['nom'].' '.$value['prenom']; ?>&emsp;<?php echo $value['mail']; ?><br>
					<?php	} ?>
						<p>	
							<em>Page : 
								<?php 
								$j = 1;
								for($j; $j <= $nbrePageIn; $j++) 
								{ ?>
									<?php if($j == $pageSupprimer) { echo '<b>'; } ?>
									<a href="index.php?section=fonction&amp;fonction=<?php echo $_GET['fonction']; ?>&amp;pageSupprimer=<?php echo $j; ?>"><?php echo $j; ?></a> 
									<?php if($j == $pageSupprimer) { echo '</b>'; } ?>
						<?php 	} ?>
							</em>
						</p>
			<?php 	} 
					/* FIN DE SI */
					/* --------- */
					if(!empty($allMembreNotInFonction))
						// Si il reste des membres qui ne sont pas dans la fonction, on propose de les ajouters 
					{ ?>
						<br>
						<h4>Liste des membres ne possédant pas la fonction <?php echo $allFonction[$_GET['fonction']]['nom']; ?> :</h4>
							<?php foreach ($allMembreNotInFonction as $key => $value) {  ?>
									<button value="<?php echo $value['id']; ?>" class="addFonction">Ajouter la fonction</button>
									&nbsp;<?php echo $value['nom'].' '.$value['prenom']; ?>&emsp;<?php echo $value['mail']; ?><br>
							<?php } ?>
						<p>	
							<em>Page : 
								<?php 
								$j = 1;
								for($j; $j <= $nbrePageNotIn; $j++) 
								{ ?>
									<?php if($j == $pageAjouter) { echo '<b>'; } ?>
									<a href="index.php?section=fonction&amp;fonction=<?php echo $_GET['fonction']; ?>&amp;pageAjouter=<?php echo $j; ?>"><?php echo $j; ?></a> 
									<?php if($j == $pageAjouter) { echo '</b>'; } ?>
						<?php 	} ?>
							</em>
						</p>
			<?php 	} 
				?>
				</div><hr /><?php 
				} ?>
				<p>	
					<em>Informations:</em><br>
					<em>-Vous pouvez modifier les droits de chaque fonction en cliquant sur les cases (les super administrateurs ont eux tous les droits).</em><br>
					<em>-Assignez ou supprimez des fonctions aux membres en cliquant sur l'intitulé de la fonction (dans la colonne "Nom fonction").</em><br>
					<em>-Toute personne qui s'inscrit sur le site reçoit la fonction "public" par défaut.</em><br>
					<em>-Un membre peut cumuler plusieurs fonctions à la fois, on ne peut pas lui retirer la fonction "public"</em><br>
					<em>-Comment se cumulent les fonctions? Réponse: (Exemple) Si un membre possède à la fois une fonction A qui lui autorise à réserver le midi ET une fonction B qui lui interdit de réserver le midi alors le membre pourra réserver le midi.</em><br>
				</p>
				<table>
					<tr>
						<th>
							Nom Fonction
						</th>
						<th>
							Admin Livre Or
						</th>
						<th>
							Admin Actualité
						</th>
						<th>
							Admin Repas
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
						<td onclick="changerFonction(2, <?php echo $value['id'] ?>);" <?php if($value['isAdminLivreOr']) { echo 'class="true"><img src="view/graphicRessources/true.png" alt="true"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png" alt="false"/>'; } ?>
						</td>
						<td onclick="changerFonction(3, <?php echo $value['id'] ?>);" <?php if($value['isAdminActualite']) { echo 'class="true"><img src="view/graphicRessources/true.png" alt="true"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png" alt="false"/>'; } ?>
						</td>
						<td onclick="changerFonction(4, <?php echo $value['id'] ?>);" <?php if($value['isAdminRepas']) { echo 'class="true"><img src="view/graphicRessources/true.png" alt="true"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png" alt="false"/>'; } ?>
						</td>	
						<td onclick="changerFonction(5, <?php echo $value['id'] ?>);" <?php if($value['autorisationMangerMidi']) { echo 'class="true"><img src="view/graphicRessources/true.png" alt="true"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png" alt="false"/>'; } ?>
						</td>
						<td onclick="changerFonction(6, <?php echo $value['id'] ?>);" <?php if($value['autorisationMangerSoir']) { echo 'class="true"><img src="view/graphicRessources/true.png" alt="true"/>'; } else { echo 'class="false"><img src="view/graphicRessources/false.png" alt="false"/>'; } ?>
						</td>

						<?php if($value['id'] != 1 && $value['id'] != 2) { ?>
						<!-- On ne peut pas supprimer la fonction "public" -->
						<td>
							<a href="index.php?section=fonction&amp;delete=<?php echo $value['id']; ?>" onclick="return(confirm('Attention ! Si vous supprimez la fonction, cette fonction sera retirée de tous les membres qui la possèdent. Voulez-vous continuer ?'))">Supprimer</a>
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
					<input type="submit" value="Enregistrer"/>
				</form>
				<p>	
					<em>Pour donner des fonctions aux membres, cliquez sur le nom de la fonction correspondante dans la première colonne du tableau.</em><br>
				</p>
				<hr />
				<script type="text/javascript">
				function changerFonction(type, id)
				/*Fonction redirige sur la même page en mettant les paramètres en GET */
				{
					if(id!=1 && id!=2)
					{
						window.location='index.php?section=fonction&type='+type+'&id='+id;
					}
				}
				</script>
				<?php if(isset($_GET['fonction']))
				// Le script pour ajouter des membres n'est affiché que lorsque Get['fonction'] existe
				{ ?>
				<script type="text/javascript">
				$(document).ready(function() {
				        $('body').on('click', '.deleteFonction', function() {
				      		var value=$(this).attr('value');
				      		console.log(value);
				          	$('#listeDesMembres').load("index.php?section=fonction&fonction=<?php echo $_GET['fonction']; ?>&pageSupprimer=<?php echo $pageSupprimer; ?>&supprimerMembre=" +value+" "+"#listeDesMembres");  
				       	});
				       	$('body').on('click', '.addFonction', function() {
				      		var value=$(this).attr('value');
				      		console.log(value);
				          	$('#listeDesMembres').load("index.php?section=fonction&fonction=<?php echo $_GET['fonction']; ?>&pageAjouter=<?php echo $pageAjouter; ?>&ajouterMembre=" +value+" "+"#listeDesMembres");   
				       	}); 
			       	}); 
				</script>
				<?php } ?>
			</div>
		</div>
	</body>
</html>