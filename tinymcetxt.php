<?php
function tinymcetxt($page)
{
	$mysqli = connection();
	if(isset($_POST['contenuFR']) || isset($_POST['contenuEN']) && isSuperAdmin())
	{
		if(isset($_POST['contenuFR']) && strlen($_POST['contenuFR']) <= 64000)
		{
			run('UPDATE informationpage SET contenu="'.$mysqli->real_escape_string($_POST['contenuFR']).'" WHERE page="'.$page.'"');
		}
		elseif(isset($_POST['contenuEN']) && strlen($_POST['contenuEN']) <= 64000)
		{
			run('UPDATE informationpage SET contenuEN="'.$mysqli->real_escape_string($_POST['contenuEN']).'" WHERE page="'.$page.'"');
		}
	}
	$contenu = run('SELECT contenu, contenuEN FROM informationpage WHERE page="'.$page.'"')->fetch_object();
	if(!empty($_SESSION['superAdminOn']) && isSuperAdmin())
	{ 
		// Evite d'avoir une valeur vide pour ensuite l'afficher sinon cela provoque une erreur
		if($_SESSION['langue'] == 1) 
		{
			if(empty($contenu->contenu)) { $contenuFR = ""; }
			else { $contenuFR = $contenu->contenu; } ?>
			<form method="post">
				Version Française : 
    				<textarea id="txtarea" name="contenuFR"><?php echo $contenuFR; ?></textarea>
    				<input type="submit" value="Enregistrer" />		
				</form>
		<?php 
		}
		if($_SESSION['langue'] == 2) 
		{ ?>
	<?php	if(empty($contenu->contenuEN)) { $contenuEN = ""; }
			else { $contenuEN = $contenu->contenuEN; } ?>
			<form method="post">
				Version Anglaise : 
    				<textarea id="txtarea" name="contenuEN"><?php echo $contenuEN; ?></textarea>
    				<input type="submit" value="Enregistrer" />
				</form>
<?php 	} ?>
<?php
	}
	else
	{	
		if(!empty($contenu->contenuEN) && $_SESSION['langue'] == 2)
		{
			echo $contenu->contenuEN;
		}
		else
		{
			echo $contenu->contenu;
		}
	}
}
?>