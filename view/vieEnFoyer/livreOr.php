<?php include_once '/view/includes/header.php'; ?>

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
				<img id="img_livredor" src="/4AJ/view/graphicRessources/livredor.png" alt="livreOr" />
				<?php if($admin) { ?>
				<form method="post">
					<b>Admin</b> : nombre de billet par page : 
					<input type="text" required size="1" placeholder="<?php echo $nbreBilletParPage; ?>" name="nbreBilletParPage" /><input type="submit" colls="2" /><br /><br />
				</form>
				<p>
					<b><a href="admin/index.php?section=livreOrAConfirmer">Partie admin</a></b>
				</p>
				<?php
				// Si l'utilisateur à envoyé un message :
				if(!empty($_SESSION['confirm']))
				{ ?>
					<p>
						<em>
							<?php echo $_SESSION['confirm']; ?>
						</em>
					</p>
					
		<?php	unset($_SESSION['confirm']);
				}
				?>
				<?php } ?>
				<div id="div_livredor">
					<?php	
					// Affiche le livre d'or
					if(!empty($livreOr))
					{
						foreach($livreOr as $k => $v)
						{ ?>
							<b><?php echo $v['nom']; ?></b>

							<!-- Si admin, cela affiche l'adresse mail -->
							<?php if($admin && !empty($v['mail']) && $v['mail'] != "null") { ?>
							(<a href="mailto:<?php echo $v['mail']; ?>"><?php echo $v['mail'];?></a>)
							<?php } ?>
							<!-- Affiche la date -->
							, <?php langue('le '.$v['timeLivreOr'], 'the '.$v['timeLivreOrEN']); ?>
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
						<label for="nom"><?php langue('Votre nom :', 'Your name :'); ?></label>
						<input type="text" name="nom" id="nom" />
						</p>
						<p class="form-field">
						<label for="email"><?php langue('Votre email :', 'Your mail :'); ?></label>
						<input type="text" name="mail" id="email" />
						</p>
						<p class="message_info"> 
						<em>(<?php langue('L\'Email est optionnel et ne sera pas affiché au public, mais peut nous permettre de vous recontacter', 'Your email is optional and won\'t be display in public, this may help us to contact you.'); ?>)</em>
						</p>
						<p class="form-field">
						<label for="contenu"><?php langue('Votre email', 'Content'); ?> : </label>
						<textarea name="contenu" id="contenu" cols="50" rows="10" ></textarea>
						</p>
						<p class="message_info"><em><?php langue('Il vous reste', 'You have'); ?> <span id="carac_reste_textarea_1"></span> <?php langue('caractères', 'characters left'); ?>.</em></p>
						<!-- Script pour le nombre de caractère -->
						<script type="text/javascript">
							<!--
								maxlength_textarea('contenu','carac_reste_textarea_1',500);
							-->
					    </script>
					    <p class="message_info"> 
						<em>(<?php langue('Votre message ne s\'affichera sur la page qu\'après validation de l\'administrateur', 'Your message will be display only after validation by the administrator'); ?>)</em>
						</p>
						<input type="submit" <?php langue('', 'value="Validate"'); ?>><input type="reset" <?php langue('', 'value="Reset"'); ?>>
					</form>
				</fieldset>
			</div>
			<?php include_once '/view/includes/footer.php'; ?>
		</div>
	</body>
</html>