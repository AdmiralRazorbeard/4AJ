<div id="footer">
	<div id="visiteurs">
		<?php 
		if($_SESSION['langue'] == 2)	{ echo 'Number of visitors : '.nombreVisiteur(); }
		else 							{ echo 'Nombre de visiteurs : '.nombreVisiteur(); }	?>
	</div>
</div>