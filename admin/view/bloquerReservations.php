<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper bloquerReservations">
				<h2>Activer/Désactiver la possibilité de réserver</h2>
                <a href="index.php?section=gestionRepas">Retour</a>
                <p>
				    <em>Les réservations sont actuellement <?php if($blocage==1){?>désactivées<?php }else{ ?>activées<?php } ?></em>
                </p>
				<form method="post">
                    <p class="form-field-list">
                        <input type="radio" name="choix" checked="checked" value="2"/> <label>Activer les réservations</label>
                        <input type="radio" name="choix" value="1"/><label>Désactiver les réservations</label>
                    </p>
                    <p class="form-field">
                        <label>Raison de la désactivation (sera affiché pour les utilisateurs sur la page restauration):</label>
                        <br>
                        <input type="text" name="raison" value="<?php echo($raison); ?>">
                    </p>
                    <input type="submit" value="Enregistrer" onclick="return(confirm('Etes-vous sûr de vouloir activer/désactiver les réservations ?'))">
                </form>
			</div>
		</div>		
	</body>
</html>