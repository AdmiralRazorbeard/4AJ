<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas())
{
	$mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$semaineClairLogis = semaine(0);
	$semaineAnneFrank = semaine(0);
	$semaineClairLogis2 = semaine(1);
	$semaineAnneFrank2 = semaine(1);
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	/*$styleA1 = $sheet->getStyle('A1:J1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);*/
	for ($col = 'A'; $col != 'I'; $col++) {
		$sheet->getColumnDimension($col)->setWidth(18);
	}
	$styleA1 = $sheet->getStyle('A1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$styleA2 = $sheet->getStyle('A9');
	$styleFont2 = $styleA2->getFont();
	$styleFont2->setBold(true);
	$sheet->setCellValue('A1',"Anne Frank");
	$sheet->setCellValue('A3',"Midi");
	$sheet->setCellValue('A4',"Soir");
	$sheet->setCellValue('A6',"Midi");
	$sheet->setCellValue('A7',"Soir");
	$sheet->setCellValue('A9',"Clair Logis");
	$sheet->setCellValue('A11',"Midi");
	$sheet->setCellValue('A12',"Soir");
	$sheet->setCellValue('A14',"Midi");
	$sheet->setCellValue('A15',"Soir");
	$y=1;
	foreach ($semaineAnneFrank as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 2, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 3, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 4, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineAnneFrank2 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 5, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 6, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 7, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 10, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 11, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 12, $nbInscritSoir);
		$y++;
	}
	$y=1;
	foreach ($semaineClairLogis2 as $key => $value) {
		$jour=ucfirst($key)." ".$value['numero']." ".$mois[$value['mois']];
		$sheet->setCellValueByColumnAndRow($y, 13, $jour);
		$nbInscritMidi=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 1, 1);
		$sheet->setCellValueByColumnAndRow($y, 14, $nbInscritMidi);
		$nbInscritSoir=nbreInscrit($value['numero'], $value['mois'], $value['annee'], 0, 1); 
		$sheet->setCellValueByColumnAndRow($y, 15, $nbInscritSoir);
		$y++;
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