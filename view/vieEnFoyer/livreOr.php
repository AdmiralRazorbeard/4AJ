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
		<div id="mainWrapper">
			<div class="contentWrapper">	
				<img id="img_livredor" src="/4AJ/view/graphicRessources/livredor.png" alt="livreOr" />
				<?php if($admin) { ?>
				<form method="post">
					<b>Admin</b> : nombre de billet par page : 
					<input type="text" required size="1" placeholder="<?php echo $nbreBilletParPage; ?>" name="nbreBilletParPage" /><input type="submit" colls="2" /><br /><br />
				</form>
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
							(<a href="mailto:<?php echo $v['mail']; ?>"><?php echo $v['mail']; ?></a>)
							<?php } ?>
							<!-- Affiche la date -->
							, le <?php echo $v['timeLivreOr']; ?>
							<!-- Rajoute un bouton supprimer si admin -->
							<?php if($admin) { ?>
							<a href="index.php?section=livreOr&delete=<?php echo $v['id']; ?>">Supprimer</a> 
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
							<a href="index.php?section=livreOr&page=<?php echo $i; ?>"><?php echo $i; ?></a>
							<?php if($i == $page) {echo '</b>'; }?>
				<?php	} ?>
					</p>	
				</div>
				<fieldset id="message_livredor">
					<legend>Laissez un message</legend>
					<form method="post">
						<p class="form-field">
						<label for="nom">Votre nom : </label>
						<input type="text" name="nom" id="nom" />
						</p>
						<p class="form-field">
						<label for="mail">Votre email : </label>
						<input type="text" name="mail" id="mail" />
						</p>
						<p class="message_info"> 
						<em>(Ceci est optionnel et ne sera pas afficher au public, mais peut nous permettre de vous recontacter)</em>
						</p>
						<p class="form-field">
						<label for="contenu">Contenu : </label>
						<textarea name="contenu" id="contenu" cols="50" rows="10" ></textarea>
						</p>
						<p class="message_info"><em>Il vous reste <span id="carac_reste_textarea_1"></span> caractères.</em></p>
						<!-- Script pour le nombre de caractère -->
						<script type="text/javascript">
							<!--
								maxlength_textarea('contenu','carac_reste_textarea_1',500);
							-->
					    </script><br />
						<input type="submit"><input type="reset">
					</form>
				</fieldset>
			</div>	
		</div>
	</body>
</html>