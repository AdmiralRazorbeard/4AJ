<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Ajouter un menu pour une semaine</h1>
				<form method="post" enctype="multipart/form-data">
					<label for="semaine">Semaine du : </label>
					<select name="semaine" id="semaine">
				<?php 	for ($i = 0; $i <= 4; $i++) 
						{ 
							$numeroWeek = date('W', strtotime('+'.$i.' weeks'));
							$jourWeek = date('j', strtotime('Monday this week', strtotime('+'.$i.' weeks')));
							$moisWeek = $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' weeks')))];
							?>
							<option value="<?php echo $numeroWeek; ?>"><?php echo $numeroWeek.' '.$moisWeek; ?></option>
<?php					} ?>
					</select>, ajouter le menu : <input type="file" name="weekFile" />. <input type="submit" />
				</form>
			</div>
		</div>
	</body>
</html>