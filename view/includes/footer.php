<div id="footer">
	<div id="visiteurs">
		<?php 
		if($_SESSION['langue'] == 2){ 
			echo 'Total visitors : '.nombreVisiteur(); 
		}
		else{ echo 'Total visiteurs : '.nombreVisiteur(); 
		}	
		?>
	</div>
</div>