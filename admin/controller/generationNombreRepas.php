<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas())
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineClairLogis = semaine(0);
	$semaineAnneFrank = semaine(0);
	$semaineClairLogis2 = semaine(1);
	$semaineAnneFrank2 = semaine(1);
	$semaineClairLogis3 = semaine(2);
	$semaineAnneFrank3 = semaine(2);
	$semaineClairLogis4 = semaine(3);
	$semaineAnneFrank4 = semaine(3);
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	/*$styleA1 = $sheet->getStyle('A1:J1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);*/
	for ($col = 'A'; $col != 'I'; $col++) {
		$sheet->getColumnDimension($col)->setWidth(19);
	}
	$styleA1 = $sheet->getStyle('A1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$styleA2 = $sheet->getStyle('A15');
	$styleFont2 = $styleA2->getFont();
	$styleFont2->setBold(true);
	$sheet->setCellValue('A1',"Anne Frank");
	$sheet->setCellValue('A2',"Midi");
	$sheet->setCellValue('A3',"Soir");
	$sheet->setCellValue('A5',"Midi");
	$sheet->setCellValue('A6',"Soir");
	$sheet->setCellValue('A8',"Midi");
	$sheet->setCellValue('A9',"Soir");
	$sheet->setCellValue('A11',"Midi");
	$sheet->setCellValue('A12',"Soir");
	$sheet->setCellValue('A15',"Clair Logis");
	$sheet->setCellValue('A16',"Midi");
	$sheet->setCellValue('A17',"Soir");
	$sheet->setCellValue('A19',"Midi");
	$sheet->setCellValue('A20',"Soir");
	$sheet->setCellValue('A22',"Midi");
	$sheet->setCellValue('A23',"Soir");
	$sheet->setCellValue('A25',"Midi");
	$sheet->setCellValue('A26',"Soir");
	$y=1;
	foreach ($semaineAnneFrank as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 1, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 2, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 3, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineAnneFrank2 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 4, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 5, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 6, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineAnneFrank3 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 7, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 8, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 9, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineAnneFrank4 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 10, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 11, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 12, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 15, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2);
		$sheet->setCellValueByColumnAndRow($y, 16, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); 
		$sheet->setCellValueByColumnAndRow($y, 17, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis2 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 18, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2);
		$sheet->setCellValueByColumnAndRow($y, 19, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); 
		$sheet->setCellValueByColumnAndRow($y, 20, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis3 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 21, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2);
		$sheet->setCellValueByColumnAndRow($y, 22, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); 
		$sheet->setCellValueByColumnAndRow($y, 23, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis4 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 24, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 2);
		$sheet->setCellValueByColumnAndRow($y, 25, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 2); 
		$sheet->setCellValueByColumnAndRow($y, 26, $nbInscritSoir);
		$y++;
	}
	$y=2;
	$t=0;
	for ($z = 0; $z <= 1; $z++)
	{
		for($i = 'A'; $i < 'I'; $i++)

		{ 
			$styleRight = $sheet->getStyle($i.($t+1).':'.$i.($t+12));
	        $styleRight->applyFromArray(array(
	            'borders'=>array(
	                'right'=>array(
	                    'style'=>PHPExcel_Style_Border::BORDER_MEDIUM))));
	    }
		for ($i = 0; $i <= 3; $i++)
		//permet de créer les barres horizontales
		{
			$styleTop = $sheet->getStyle('A'.(string)$y.':H'.(string)$y);
	        $styleTop->applyFromArray(array(
	            'borders'=>array(
	                'top'=>array(
	                    'style'=>PHPExcel_Style_Border::BORDER_MEDIUM))));
	        $styleBottom = $sheet->getStyle('A'.(string)($y+1).':H'.(string)($y+1));
	        $styleBottom->applyFromArray(array(
	            'borders'=>array(
	                'bottom'=>array(
	                    'style'=>PHPExcel_Style_Border::BORDER_MEDIUM))));
	   		$y=$y+3;
		}
		$y=$y+2;
		$t=14;
	}
	$sheet->getStyle('A1:H26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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