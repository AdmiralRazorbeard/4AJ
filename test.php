<?php
$tmp = run('SELECT id, nomMembre, prenomMembre, adresse, dateNaissance, telFixe, telPortable, mail, isSuperAdmin 
			FROM membre 
			ORDER BY id ASC'); 
$listeMembre = NULL;
while($donnees = $tmp->fetch_object())
{
	$listeMembre[$donnees->id]['id'] = $donnees->id;
	$listeMembre[$donnees->id]['nomMembre'] = $donnees->nomMembre; 
	$listeMembre[$donnees->id]['prenomMembre'] = $donnees->prenomMembre; 
	$listeMembre[$donnees->id]['adresse'] = $donnees->adresse; 
	$listeMembre[$donnees->id]['dateNaissance'] = $donnees->dateNaissance; 
	$listeMembre[$donnees->id]['telFixe'] = $donnees->telFixe; 
	$listeMembre[$donnees->id]['telPortable'] = $donnees->telPortable; 
	$listeMembre[$donnees->id]['mail'] = $donnees->mail; 
	$fonction = run('	SELECT id_fonction, nomFonctionFR 
						FROM fonction,membrefonction 
						WHERE fonction.id = membrefonction.id_fonction
						AND membrefonction.id = '.$donnees->id.'
						ORDER BY id_fonction DESC');
	while($temp = $fonction->fetch_object())
	{
		$listeMembre[$donnees->id]['fonction'][$temp->id_fonction]['id'] = $temp->id_fonction;
		$listeMembre[$donnees->id]['fonction'][$temp->id_fonction]['nom'] = htmlspecialchars($temp->nomFonctionFR);
	}
	$listeMembre[$donnees->id]['isSuperAdmin'] = $donnees->isSuperAdmin;
}



include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';

$workbook = new PHPExcel;

$sheet = $workbook->getActiveSheet();
$sheet->setCellValue('A1',"ID");
$sheet->setCellValue('B1',"Nom");
$sheet->setCellValue('C1',"Prenom");
$sheet->setCellValue('D1',"Email");
$sheet->setCellValue('E1',"Directeur");
$sheet->setCellValue('F1',"Jeunes");

$sheet->setCellValue('A3',$listeMembre[1]['id']);
$sheet->setCellValue('B3',$listeMembre[1]['nomMembre']);
$sheet->setCellValue('C3',"OUI");
$sheet->setCellValue('D3',"OUI");
$sheet->setCellValue('E3',"OUI");
$sheet->setCellValue('F3',"NON");

$sheet->setCellValue('A4',"10");
$sheet->setCellValue('B4',"Dupond");
$sheet->setCellValue('C4',"Michel");
$sheet->setCellValue('D4',"M@gmail.com");
$sheet->setCellValue('E4',"OUI");
$sheet->setCellValue('F4',"NON");


$writer = new PHPExcel_Writer_Excel2007($workbook);
$writer->setOffice2003Compatibility(true);

header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition:inline;filename=fichier.xlsx ');
$writer->save('php://output');


