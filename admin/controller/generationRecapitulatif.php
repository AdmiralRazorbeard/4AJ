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
	/*$y=1;
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
	}*/
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