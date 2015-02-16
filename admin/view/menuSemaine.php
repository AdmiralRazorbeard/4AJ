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
			<?php		for($i=0; $i<9; $i++){
						$numeroWeek = date('W', strtotime('Monday this week', strtotime('+'.$i.' week'))).'-'.date('o', strtotime('Monday this week', strtotime('+'.$i.' week')));
						$jourWeek = date('j', strtotime('Monday this week', strtotime('+'.$i.' week')));
						$moisWeek = $mois[date('n', strtotime('Monday this week', strtotime('+'.$i.' week')))];
						?>
						<option <?php if($i==0){ echo "selected ";} ?>value="<?php echo $numeroWeek; ?>"><?php echo $jourWeek.' '.$moisWeek; ?></option>
						<?php } ?>
					</select>
					<select name="residenceChoisie">
							<option selected value="1">Anne Frank</option>
							<option value="2">Clair Logis</option>
					</select>
					, ajouter le menu (5 Mo maximum) : <input type="file" name="weekFile" /><input type="submit" />
				</form>
				<!-- On affiche les differents menus mis en ligne pour pouvoir ensuite les supprimer-->
				<?php if($listeMenu != NULL){
				 		foreach($listeMenu as $key => $value){ 
				?>
					<?php if($value['residence']==1){$residence='Anne Frank';}else{$residence='Clair Logis';} 
						$timeStampPremierJanvier = strtotime($value['annee'] . '-01-01');
						//jour du premier janvier au format numérique
						$jourPremierJanvier = date('w', $timeStampPremierJanvier);
						//recherche du N° de semaine du 1er janvier
						$numSemainePremierJanvier = date('W', $timeStampPremierJanvier);
						//nombre à ajouter en fonction du numéro précédent
						$decallage = ($numSemainePremierJanvier == 1) ? $value['semaine'] - 1 : $value['semaine'];
						//timestamp du jour dans la semaine recherchée
						$timeStampDate = strtotime('+' . $decallage . ' weeks', $timeStampPremierJanvier);
						//recherche du lundi de la semaine en fonction de la ligne précédente
						$jourDebutSemaine = ($jourPremierJanvier == 1) ? date('d', $timeStampDate) : date('d', strtotime('last monday', $timeStampDate));
					 	$moisDebutSemaine = ($jourPremierJanvier == 1) ? $mois[date('n', $timeStampDate)] : $mois[date('n', strtotime('last monday', $timeStampDate))];
					?>
					<a href="index.php?section=menuSemaine&amp;delete=<?php echo ($value['semaine'].'_'.$value['annee'].'_'.$value['residence']); ?>">Supprimer le menu du <?php echo $jourDebutSemaine.' '.$moisDebutSemaine; ?> pour la residence <?php echo $residence; ?></a>&emsp;&emsp;Téléchargements: <?php echo $value['telechargement']; ?><br>
				<?php } }
				?>
			</div>
		</div>
	</body>
</html>