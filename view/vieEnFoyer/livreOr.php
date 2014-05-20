<?php include_once '/view/includes/header.php'; ?>
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
		<div>
			<h1>Livre d'or</h1>
			<hr>
			<fieldset>
				<legend>Laissez un message</legend>
				<form method="post">
					<label for="nom">Votre nom : </label><input type="text" name="nom" id="nom" /><br />
					<label for="mail">Votre email : </label><input type="text" name="mail" id="mail" /> <em>(Ceci est optionnel mais peut nous permettre de vous recontacter)</em><br />
					<label for="contenu">Contenu : </label><br />
					<em>Il vous reste <span id="carac_reste_textarea_1"></span> caractères.</em><br />
					<textarea name="contenu" id="contenu" cols="50" rows="10" ></textarea><br />
					  	<script type="text/javascript">
					        <!--
					            maxlength_textarea('contenu','carac_reste_textarea_1',500);
					        -->
					    </script>
					<input type="submit"><input type="reset">
				</form>
			</fieldset>
		</div>
	</body>
</html>