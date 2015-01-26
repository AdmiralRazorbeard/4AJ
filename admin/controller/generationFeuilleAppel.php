<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas()){
	$annee=$_GET['annee'];
	$mois=$_GET['mois'];
	$jour=$_GET['jour'];
	$midi=$_GET['midi'];
	$residence=$_GET['residence'];
	$date = $annee.'-'.$mois.'-'.$jour;
	$s_midi=NULL;
	if($midi==1){
		$s_midi="Midi";
	}
	else{
		$s_midi="Soir";
	}
	/*$count = run('SELECT COUNT(*) as nbre FROM verrouillerjourrepas WHERE dateVerouiller = "'.$date.'" AND midi = '.$midi.' AND residence = '.$residence)->fetch_object();
	//si verrouillé alors il y a forcement 0 inscrit
	if($count->nbre >= 1)
	{
		return 0;
	}*/
	$listeMembre = NULL;
	$tmp = run("SELECT nomMembre, prenomMembre
				FROM reserverepas, membre 
				WHERE reserverepas.id_membre = membre.id 
				AND reserverepas.midi = '".$midi."'
				AND residence = '".$residence."'
				AND dateReserve = '".$date."'
				ORDER BY nomMembre ASC");
	if($tmp){
		$i=0;
		while($donnees = $tmp->fetch_object()){
			$listeMembre[$i]['nomMembre'] = $donnees->nomMembre; 
			$listeMembre[$i]['prenomMembre'] = $donnees->prenomMembre; 
		$i++;
		}
	}
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	$styleA1 = $sheet->getStyle('A3:C3');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->setCellValue('A1',"Date:");
	$sheet->setCellValue('B1',(string)date('d-m-Y', strtotime($date)));
	$sheet->setCellValue('C1',$s_midi);
	$sheet->setCellValue('A3',"Nom");
	$sheet->setCellValue('B3',"Prenom");
	if($listeMembre!=NULL){
		$y=4;
		foreach($listeMembre as $key => $value){
			$sheet->setCellValueByColumnAndRow(0, $y, $value['nomMembre']);
			$sheet->setCellValueByColumnAndRow(1, $y, $value['prenomMembre']);
			$y++;
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
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition:inline;filename='.$nomFichier.'.xlsx ');
	$writer->save('php://output');
}
else
{
	header('location:index.php?section=error');
}