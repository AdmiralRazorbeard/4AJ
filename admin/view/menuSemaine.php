<?php
include_once '/view/includes/header.php';
?>
			<div class="contentWrapper">
				<h1>Ajouter un menu pour une semaine</h1>
				<a href="index.php?section=gestionRepas">Retour</a>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
					<label for="semaine">Semaine du : </label>
					<select name="semaine" id="semaine">
			<?php		$numeroWeek = date('W', strtotime('Monday this week')).'-'.date('o', strtotime('Monday this week'));
						$jourWeek = date('j', strtotime('Monday this week'));
						$moisWeek = $mois[date('n', strtotime('Monday this week'))];
						?>
						<option value="<?php echo $numeroWeek; ?>"><?php echo $jourWeek.' '.$moisWeek; ?></option>
			<?php		$numeroWeek = date('W', strtotime('Monday next week')).'-'.date('o', strtotime('Monday next week'));
						$jourWeek = date('j', strtotime('Monday next week'));
						$moisWeek = $mois[date('n', strtotime('Monday next week'))];
						?>
						<option value="<?php echo $numeroWeek; ?>"><?php echo $jourWeek.' '.$moisWeek; ?></option>
			<?php		$numeroWeek = date('W', strtotime('Monday next week', strtotime('+1 week'))).'-'.date('o', strtotime('Monday next week', strtotime('+1 week')));
						$jourWeek = date('j', strtotime('Monday next week', strtotime('+1 week')));
						$moisWeek = $mois[date('n', strtotime('Monday next week', strtotime('+1 week')))];
						?>
						<option value="<?php echo $numeroWeek; ?>"><?php echo $jourWeek.' '.$moisWeek; ?></option>
					</select>
					<select name="residenceChoisie">
							<option value="1">Anne Frank</option>
							<option value="2">Clair Logis</option>
					</select>
					, ajouter le menu (5 Mo maximum) : <input type="file" name="weekFile" /><input type="submit" />
				</form>
			</div>
		</div>
	</body>
</html>