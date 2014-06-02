<?php include_once '/view/includes/header.php'; ?>
			<div class="contentWrapper memberParameters">
				<?php 	
				if(isSuperAdmin() == false) { ?>
				<!-- Si superAdmin: impossible de se désinscrire -->
				<form action="index.php?section=deleteAccount" method="post" enctype="multipart/form-data" >
                	<fieldset>
                        <label>Se désinscrire :</label> <input type="checkbox" name="deleteAccount" onclick="return(confirm('Etes-vous sûr de vouloir supprimer votre compte définitivement? Si oui: Ok puis Envoyer'));"/>                      
                    	<input type="submit" class="submit" name="send" value="envoyer"/>
                	</fieldset>
            	</form>
            	<?php }	?>
			</div>
		</div>		
	</body>
</html>