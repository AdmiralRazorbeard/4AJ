<?php
include_once 'request/gestionMembres.php';
if(isAdminMembres())
{
	$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable, mail, isSuperAdmin 
				FROM membre 
				ORDER BY nomMembre ASC'); 
	$listeMembre = NULL;
	$i=0;
	while($donnees = $tmp->fetch_object())
	{
		$listeMembre[$i]['id'] = $donnees->id;
		$listeMembre[$i]['nomMembre'] = $donnees->nomMembre; 
		$listeMembre[$i]['prenomMembre'] = $donnees->prenomMembre; 
		$listeMembre[$i]['adresse'] = $donnees->adresse; 
		$listeMembre[$i]['dateNaissance'] = $donnees->dateNaissance; 
		$listeMembre[$i]['telFixe'] = $donnees->telFixe; 
		$listeMembre[$i]['telPortable'] = $donnees->telPortable; 
		$listeMembre[$i]['mail'] = $donnees->mail; 
		$fonction = run('	SELECT id_fonction, nomFonctionFR 
							FROM fonction,membrefonction 
							WHERE fonction.id = membrefonction.id_fonction
							AND membrefonction.id = '.$donnees->id.'
							ORDER BY id_fonction DESC');
		while($temp = $fonction->fetch_object())
		{
			$listeMembre[$i]['fonction'][$temp->id_fonction]['id'] = $temp->id_fonction;
			$listeMembre[$i]['fonction'][$temp->id_fonction]['nom'] = htmlspecialchars($temp->nomFonctionFR);
		}
		$listeMembre[$i]['isSuperAdmin'] = $donnees->isSuperAdmin;
	$i++;
	}
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	$styleA1 = $sheet->getStyle('A1:J1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->getColumnDimension('B')->setWidth(18);
	$sheet->getColumnDimension('C')->setWidth(18);
	$sheet->getColumnDimension('D')->setWidth(28);
	$sheet->getColumnDimension('E')->setWidth(15);
	$sheet->getColumnDimension('F')->setWidth(11);
	$sheet->getColumnDimension('G')->setWidth(11);
	$sheet->getColumnDimension('H')->setWidth(26);
	$sheet->getColumnDimension('I')->setWidth(13);
	$sheet->setCellValue('A1',"ID");
	$sheet->setCellValue('B1',"Nom");
	$sheet->setCellValue('C1',"Prenom");
	$sheet->setCellValue('D1',"Adresse");
	$sheet->setCellValue('E1',"Date Naissance");
	$sheet->setCellValue('F1',"Tel Fixe");
	$sheet->setCellValue('G1',"Tel Portable");
	$sheet->setCellValue('H1',"Mail");
	$sheet->setCellValue('I1',"SuperAdmin");
	$sheet->setCellValue('J1',"Fonctions");
	$y=2;
	$z=9;
	foreach($listeMembre as $key => $value) 
	{
		$sheet->setCellValueByColumnAndRow(0, $y, $value['id']);
		$sheet->setCellValueByColumnAndRow(1, $y, $value['nomMembre']);
		$sheet->setCellValueByColumnAndRow(2, $y, $value['prenomMembre']);
		if($value['adresse']=="NULL"){
			$sheet->setCellValueByColumnAndRow(3, $y, "Inconnue");
		}
		else{
			$sheet->setCellValueByColumnAndRow(3, $y, $value['adresse']);
		}
		if($value['dateNaissance']=="0000-00-00"){
			$sheet->setCellValueByColumnAndRow(4, $y, "Inconnue");
		}
		else{
			$sheet->setCellValueByColumnAndRow(4, $y, $value['dateNaissance']);
		}
		if($value['telFixe']==0){
			$sheet->setCellValueByColumnAndRow(5, $y, "Inconnu");
		}
		else{
			$sheet->setCellValueExplicitByColumnAndRow(5, $y, $value['telFixe'],PHPExcel_Cell_DataType::TYPE_STRING);
		}
		if($value['telPortable']==0){
			$sheet->setCellValueByColumnAndRow(6, $y, "Inconnu");
		}
		else{
			$sheet->setCellValueExplicitByColumnAndRow(6, $y, $value['telPortable'],PHPExcel_Cell_DataType::TYPE_STRING);
		}
		$sheet->setCellValueByColumnAndRow(7, $y, $value['mail']);
		if($value['isSuperAdmin']==0){
			$sheet->setCellValueByColumnAndRow(8, $y, "non");
		}
		else{
			$sheet->setCellValueByColumnAndRow(8, $y, "oui");
			$coord='I'.(string)$y;
			$styleI = $sheet->getStyle($coord);
			$styleFont = $styleI->getFont();
			$styleFont->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
		}
		foreach($value['fonction'] as $k => $value2)
		{
			if($value2['nom']!= 'Public')
			{
			$sheet->setCellValueByColumnAndRow($z, $y, $value2['nom']);
			$z++;
			}
		}
		$y++;
		$z=9;
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