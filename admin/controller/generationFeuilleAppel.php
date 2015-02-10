<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas()){
	$annee=$mysqli->real_escape_string($_GET['annee']);
	$mois=$mysqli->real_escape_string($_GET['mois']);
	$jour=$mysqli->real_escape_string($_GET['jour']);
	$midi=$mysqli->real_escape_string($_GET['midi']);
	$residence=$mysqli->real_escape_string($_GET['residence']);
	$date = $annee.'-'.$mois.'-'.$jour;
	$s_midi=NULL;
	$s_residence=NULL;
	if($midi==1){
		$s_midi="Midi";
	}
	else{
		$s_midi="Soir";
	}
	if($residence==1){
		$s_residence="Anne Frank";
	}
	else{
		$s_residence="Clair Logis";
	}
	$count = run('SELECT COUNT(*) as nbre FROM verrouillerjourrepas WHERE dateVerouiller = "'.$date.'" AND midi = '.$midi.' AND residence = '.$residence)->fetch_object();
	#requete: permet de savoir si cette partie de la journée est verrouillée#
	$listeMembre = NULL;
	$tmp = run("SELECT nomMembre, prenomMembre
				FROM reserverepas, membre 
				WHERE reserverepas.id_membre = membre.id 
				AND reserverepas.midi = '".$midi."'
				AND residence = '".$residence."'
				AND dateReserve = '".$date."'
				ORDER BY nomMembre ASC");
	#requete: prélève la liste des membres de cette partie de la journée pour cette residence#
	if($tmp){
		$i=0;
		while($donnees = $tmp->fetch_object()){
			$listeMembre[$i]['nomMembre'] = $donnees->nomMembre; 
			$listeMembre[$i]['prenomMembre'] = $donnees->prenomMembre; 
		$i++;
		}
	}
	$tmp2 = run('SELECT COUNT(*) as nbre FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$midi.' AND residence='.$residence)->fetch_object();
	$total=$tmp2->nbre;
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	$styleA1 = $sheet->getStyle('A3:B3');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->setCellValue('A1',(string)date('d-m-Y', strtotime($date)).' '.$s_midi);
	$sheet->setCellValue('B1',$s_residence);
	$sheet->setCellValue('A3',"Nom");
	$sheet->setCellValue('B3',"Prenom");
	$sheet->getColumnDimension('A')->setWidth(15);
	$sheet->getColumnDimension('B')->setWidth(15);
	$sheet->getColumnDimension('C')->setWidth(3);
	$sheet->getStyle('A1:B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	if($count->nbre >= 1)
	{
		$sheet->setCellValue('A2',"Total: 0");
		$sheet->setCellValue('B2',"Reservation Interdite");
	}
	else
	{
		$sheet->setCellValue('A2',"Total: ".$total);
		if($listeMembre!=NULL){
			$y=4;
			foreach($listeMembre as $key => $value){
				$sheet->setCellValueByColumnAndRow(0, $y, $value['nomMembre']);
				$sheet->setCellValueByColumnAndRow(1, $y, $value['prenomMembre']);
				$sheet->getStyle('C'.(string)$y)->getBorders()->applyFromArray(
			    		array(
			    			'allborders' => array(
			    				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
			    				'color' => array(
			    					'rgb' => '000000'
			    				)
			    			)
			    		)
			    );
				$y++;
			}
		}
	}
	$nomFichier=NULL;
	if($residence==1){
		$nomFichier = "Anne_Frank_".$s_midi."_".(string)date('d-m-Y', strtotime($date));
	}
	else
	{
		$nomFichier = "Clair_Logis_".$s_midi."_".(string)date('d-m-Y', strtotime($date));
	}
	$writer = new PHPExcel_Writer_Excel2007($workbook);
	$writer->setOffice2003Compatibility(true);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition:inline;filename='.$nomFichier.'.xlsx ');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	$writer->save('php://output');
}
else
{
	header('location:index.php?section=error');
}