<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas())
{
	/*$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineClairLogis = semaine(0);
	$semaineAnneFrank = semaine(0);
	$semaineClairLogis2 = semaine(1);
	$semaineAnneFrank2 = semaine(1);*/

	/*nombre jours entre deux périodes
	$nbjours = round((strtotime($date1) - strtotime($date2))/(60*60*24)-1);*/
	$dateDebut=NULL;
	$dateFin=NULL;
	if($_POST["moisChoisi"]==0){
		$dateDebut=date('Y-m-d', strtotime("first day of this month"));
		$dateFin=date('Y-m-d', strtotime("now"));
	}
	elseif($_POST["moisChoisi"]==1){
		$dateDebut=date('Y-m-d', strtotime("first day of last month"));
		$dateFin=date('Y-m-d', strtotime("last day of last month"));
	}
	elseif($_POST["moisChoisi"]==2){
		$dateDebut=date('Y-m-d', strtotime("first day of 2 months ago"));
		$dateFin=date('Y-m-d', strtotime("last day of 2 months ago"));
	}
	$period = new DatePeriod(
    new DateTime($dateDebut),
    new DateInterval('P1D'),
    new DateTime($dateFin)
	);
	$tmp = run('SELECT id, nomMembre, prenomMembre
			FROM membre 
			ORDER BY nomMembre ASC'); 
	$listeMembre = NULL;
	$i=0;
	while($donnees = $tmp->fetch_object())
	{
		$listeMembre[$i]['id'] = $donnees->id;
		$listeMembre[$i]['nomMembre'] = $donnees->nomMembre; 
		$listeMembre[$i]['prenomMembre'] = $donnees->prenomMembre; 
		$reservation = run("SELECT id, dateReserve, midi, residence 
							FROM reserverepas 
							WHERE reserverepas.id_membre = '.$donnees->id.'
							AND reserverepas BETWEEN '.$dateDebut.' AND '.$dateFin.'");
		if($reservation){
			$y=0;
			while($temp = $reservation->fetch_object())
				{
					$listeMembre[$i]['reservation'][$y]['id'] = $reservation->id;
					$listeMembre[$i]['reservation'][$y]['dateReserve'] = $reservation->dateReserve;
					$listeMembre[$i]['reservation'][$y]['midi'] = $reservation->midi;
					$listeMembre[$i]['reservation'][$y]['residence'] = $reservation->residence;
					$y++;
				}
		}
	$i++;
	}
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	$styleA1 = $sheet->getStyle('A1:F1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->setCellValue('A1',"Nom");
	$sheet->setCellValue('B1',"Prenom");
	$sheet->setCellValue('C1',"Total Anne Frank");
	$sheet->setCellValue('D1',"Total Clair Logis");
	$sheet->setCellValue('E1',"Anne Frank");
	$sheet->setCellValue('F1',"Clair Logis");
	$z=0;
	foreach($period as $dt)
	{
		$sheet->setCellValueExplicitByColumnAndRow($z+6, 1, $dt->format("m-d"),PHPExcel_Cell_DataType::TYPE_STRING);
		$z++;
	}
	$ordonne=2;
	foreach($listeMembre as $key => $value) 
	{
		$sheet->setCellValueByColumnAndRow(0, $ordonne, $value['nomMembre']);
		$sheet->setCellValueByColumnAndRow(1, $ordonne, $value['prenomMembre']);
		if(isset($value['reservation'])){
			foreach($value['reservation'] as $k => $value2)
			{
				$emplacement=(int)date('d', strtotime($value2['dateReserve']));
				if($value2['midi']==1){
					$sheet->setCellValueByColumnAndRow(($enplacement+5), $ordonne, "oui");
				}
				else{
					$sheet->setCellValueByColumnAndRow(5, 5, "oui");
				}
			}
		}
		$ordonne=$ordonne+2;
	}
	$writer = new PHPExcel_Writer_Excel2007($workbook);
	$writer->setOffice2003Compatibility(true);
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition:inline;filename=fichier.xlsx ');
	$writer->save('php://output');
}
else
{
	header('location:index.php?section=error');
}