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
    new DateTime(date("Y-m-d", strtotime($dateFin." +1 day")))
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
							WHERE reserverepas.id_membre = '".$donnees->id."'
							AND dateReserve BETWEEN '".$dateDebut."' AND '".$dateFin."'");
		if($reservation){
			$y=0;
			while($temp = $reservation->fetch_object())
				{
					$listeMembre[$i]['reservation'][$y]['id'] = $temp->id;
					$listeMembre[$i]['reservation'][$y]['dateReserve'] = $temp->dateReserve;
					$listeMembre[$i]['reservation'][$y]['midi'] = $temp->midi;
					$listeMembre[$i]['reservation'][$y]['residence'] = $temp->residence;
					$y++;
				}
		}
	$i++;
	}
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	$styleA1 = $sheet->getStyle('A1:D1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->getColumnDimension('A')->setWidth(12);
	$sheet->getColumnDimension('B')->setWidth(12);
	$sheet->getColumnDimension('C')->setWidth(7);
	$sheet->getColumnDimension('D')->setWidth(9);
	for ($col = 'E'; $col != 'AJ'; $col++) {
		$sheet->getColumnDimension($col)->setWidth(3);
	}
	$sheet->setCellValue('A1',"Nom");
	$sheet->setCellValue('B1',"Prenom");
	$sheet->setCellValue('C1',"Total");
	$sheet->setCellValue('D1',"Anne Frank");
	$z=0;
	foreach($period as $dt)
	{
		$sheet->setCellValueExplicitByColumnAndRow($z+4, 1, $dt->format("d"),PHPExcel_Cell_DataType::TYPE_STRING);
		$z++;
	}
	$ordonne=2;
	foreach($listeMembre as $key => $value) 
	{
		if(isset($value['reservation'])){
		$sheet->setCellValueByColumnAndRow(0, $ordonne, $value['nomMembre']);
		$sheet->setCellValueByColumnAndRow(1, $ordonne, $value['prenomMembre']);
		$sheet->setCellValueByColumnAndRow(3, $ordonne, "Midi");
		$sheet->setCellValueByColumnAndRow(3, ($ordonne+1), "Soir");
		$sheet->setCellValue('C'.(string)$ordonne,'=SUM(G'.(string)$ordonne.':AL'.(string)$ordonne.')');
		$sheet->setCellValue('C'.(string)($ordonne+1),'=SUM(G'.(string)($ordonne+1).':AL'.(string)($ordonne+1).')');
			foreach($value['reservation'] as $k => $value2)
			{
				$emplacement=(int)date('d', strtotime($value2['dateReserve']));
				if($value2['midi']==1){
				 $sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)$ordonne)->applyFromArray(array(
				            'fill'=>array(
				                'type'=>PHPExcel_Style_Fill::FILL_SOLID,
				                'color'=>array(
				                    'argb'=>'008000'))));
					$sheet->setCellValueByColumnAndRow(($emplacement+3), $ordonne, 1);
				}
				else{
					 $sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)($ordonne+1))->applyFromArray(array(
				            'fill'=>array(
				                'type'=>PHPExcel_Style_Fill::FILL_SOLID,
				                'color'=>array(
				                    'argb'=>'008000'))));
					$sheet->setCellValueByColumnAndRow(($emplacement+3), ($ordonne+1), 1);
				}
			}
		$ordonne=$ordonne+2;
		}
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