<div id="footer">
	<span id="visiteurs">
		<?php 
		if($_SESSION['langue'] == 2){ 
			echo 'Total visitors : '.nombreVisiteur(); 
		}
		else{ echo 'Total visiteurs : '.nombreVisiteur(); 
		}	
		?>
	</span>
	<a href="index.php?section=mentionsLegales">Mentions légales</a>
</div>