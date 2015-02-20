<?php
include_once 'view/includes/header.php'; 
?>

<!-- Script pour nombre de caractère -->
<script type="text/javascript">
<!--
function maxlength_textarea(id, crid, max)
{
    var txtarea = document.getElementById(id);
    document.getElementById(crid).innerHTML=max-txtarea.value.length;
    txtarea.onkeypress=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
    txtarea.onblur=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
    txtarea.onkeyup=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
    txtarea.onkeydown=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
}
function v_maxlength(id, crid, max)
{
    var txtarea = document.getElementById(id);
    var crreste = document.getElementById(crid);
    var len = txtarea.value.length;
    if(len>max)
    {
        txtarea.value=txtarea.value.substr(0,max);
    }
    len = txtarea.value.length;
    crreste.innerHTML=max-len;
}
-->
</script>
			<div class="contentWrapper">	
				<img id="img_livredor" src="view/graphicRessources/<?php langue('livredor', 'guestbook'); ?>.png" alt="livreOr" />
				<?php if($admin) { ?>
				<form method="post">
					<b>Admin</b> : nombre de billet par page : 
					<input type="text" required size="1" placeholder="<?php echo $nbreBilletParPage; ?>" name="nbreBilletParPage" /><input type="submit"/><br /><br />
				</form>
				<p>
					<b><a href="admin/index.php?section=livreOrAConfirmer">Partie admin</a></b>
				</p>
				<?php } ?>
				<div id="div_livredor">
				<?php if(!empty($confirmationMessage))
				{ ?>
					<em><?php echo $confirmationMessage; ?></em></br>
				<?php } ?>
					<?php	
					// Affiche le livre d'or
					if(!empty($livreOr))
					{
						foreach($livreOr as $k => $v)
						{ ?>
							<b><?php echo $v['nom'].','; ?></b>

							<!-- Si admin, cela affiche l'adresse mail -->
							<?php if($admin && !empty($v['mail']) && $v['mail'] != "null") { ?>
							(<a href="mailto:<?php echo $v['mail']; ?>"><?php echo $v['mail'];?></a>)
							<?php } ?>
							<!-- Affiche la date -->
							<?php langue('le '.$v['timeLivreOr'], 'the '.$v['timeLivreOrEN']); ?>
							<!-- Rajoute un bouton supprimer si admin -->
							<?php if($admin) { ?>
							<a href="index.php?section=livreOr&amp;delete=<?php echo $v['id']; ?>">Supprimer</a> 
							<?php } ?>
							 : <br />
							<?php echo $v['contenu']; ?><br /><br />
				<?php	}
					} 
					?>
					<!-- Affiche les pages -->
					<p>
						<?php 
						$i = 1;
						for($i; $i <= $nbrePage; $i ++)
						{ ?>
							<?php if($i == $page) {echo '<b>'; }?>
							<a href="index.php?section=livreOr&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a>
							<?php if($i == $page) {echo '</b>'; }?>
				<?php	} ?>
					</p>	
				</div>
				<fieldset id="message_livredor">
					<legend><?php langue('Laissez un message', 'Leave a message'); ?></legend>
					<form method="post">
						<p class="form-field">
						<label for="nom"><?php langue('Votre nom* :', 'Your name* :'); ?></label>
						<input required type="text" name="nom" id="nom" />
						</p>
						<p class="form-field">
						<label for="email"><?php langue('Votre email* :', 'Your mail* :'); ?></label>
						<input required type="email" name="mail" id="email" />
						</p>
						<p class="hp">
    						<label>Si vous êtes un humain, laissez ce champ vide*</label>
   							<input type="text" name="nickname">
						</p>
						<p class="form-field">
						<label for="contenu"><?php langue('Contenu*', 'Content*'); ?> : </label>
						<textarea required name="contenu" id="contenu" cols="50" rows="10" ></textarea>
						</p>
						<p class="message_info"><em><?php langue('Il vous reste', 'You have'); ?> <span id="carac_reste_textarea_1"></span> <?php langue('caractères', 'characters left'); ?>.</em></p>
						<!-- Script pour le nombre de caractère -->
						<script type="text/javascript">
							<!--
								maxlength_textarea('contenu','carac_reste_textarea_1',500);
							-->
					    </script>
					    <p class="message_info"> 
						<em>(<?php langue('Votre message ne s\'affichera sur la page qu\'après validation de l\'administrateur', 'Your message will be display only after validation by the administrator'); ?>)</em><br>
						<em><?php langue('Les champs marqués d\'un * sont obligatoires.', 'Fields with * are mandatory.'); ?></em>
						</p>
						<em><?php langue('Répondez aux deux questions de securité*:', 'Answer the two security questions*:'); ?></em><br>
							<table id="tableCaptcha">
							   <tr>
							       <td><em><?php langue('Quelle est le nombre indiqué ci-dessous?', 'What is the number below?'); ?></em>
							       </td>
							       <td>								
										<?php if($_SESSION['aleat_nbr_forme']==1)
										{ ?>
										<em><?php langue('Quelle est la position du carré ?', 'Where is the square?'); ?></em><br>
										<?php } ?>
										<?php if($_SESSION['aleat_nbr_forme']==2)
										{ ?>
										<em><?php langue('Quelle est la position du cercle ?', 'Where is the circle?'); ?></em><br>
										<?php } ?>
										<?php if($_SESSION['aleat_nbr_forme']==3)
										{ ?>
										<em><?php langue('Quelle est la position du triangle ?', 'Where is the triangle?'); ?></em><br>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td>
										<img id="refreshImg" src="controller/codeVerifGen/refresh.png" alt="Refresh image" /><img src="controller/codeVerifGen/verifCodeGen.php" alt="Code de vérification" id="imgCodeVerif"/><input required type="text" name="verif_code" />
									</td>
									<td>
										<img src="controller/codeVerifGen/fond_verif_img2.png" alt="Code de vérification2" />
										<select required name="choix_forme" multiple="multiple" size="4">
                                			<option value="0" selected="selected"></option>
                                			<option value="1">Position 1</option>
                                			<option value="2">Position 2</option>
                                			<option value="3">Position 3</option>
                        				</select>
                        			</td>
							   </tr>
							</table>
						<input type="submit" value="<?php langue('Envoyer', 'Send'); ?>"><input type="reset" value="<?php langue('Réinitialiser', 'Reset'); ?>">
					</form>
				<script type="text/javascript">
				$("#refreshImg").click(function() {
					$("#imgCodeVerif").attr("src","controller/codeVerifGen/verifCodeGen.php?r=" + Math.random());
				});
				</script>
				</fieldset>
			</div>
			<?php include_once 'view/includes/footer.php'; ?>
		</div>
	</body>
</html>