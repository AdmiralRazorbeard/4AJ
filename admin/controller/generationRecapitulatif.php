<?php
include_once 'request/gestionRepas.php';
if(isAdminRepas())
{
	$dateDebut=NULL;
	$dateFin=NULL;
	$residence=1;
	if($_POST["moisChoisi"]==0)
	//Gère le mois choisi par l'utilisateur
	{
		$dateDebut=date('Y-m-d', strtotime("first day of this month"));
		$dateFin=date('Y-m-d', strtotime("now"));
	}
	elseif($_POST["moisChoisi"]==1)
	{
		$dateDebut=date('Y-m-d', strtotime("first day of last month"));
		$dateFin=date('Y-m-d', strtotime("last day of last month"));
	}
	elseif($_POST["moisChoisi"]==2)
	{
		$dateDebut=date('Y-m-d', strtotime("first day of 2 months ago"));
		$dateFin=date('Y-m-d', strtotime("last day of 2 months ago"));
	}
	if($_POST["residenceChoisie"]==1)
	//Choix de la résidence
	{
		$residence=1;
	}
	elseif($_POST["residenceChoisie"]==2)
	{
		$residence=2;
	}
	$period = new DatePeriod(
    new DateTime($dateDebut),
    new DateInterval('P1D'),
    new DateTime(date("Y-m-d", strtotime($dateFin." +1 day")))
	);
	//Selection des membres
	$tmp = run('SELECT membre.id, membre.nomMembre, membre.prenomMembre
			FROM membre, membrefonction
			WHERE membre.id = membrefonction.id
			AND membrefonction.id_fonction = '.$mysqli->real_escape_string($_POST["fonctionChoisie"]).'
			ORDER BY nomMembre ASC');
	$listeMembre = NULL;
	$listeReservationInterdites = NULL;
	if($tmp){
		$i=0;
		while($donnees = $tmp->fetch_object())
		//Les membres sont stockés dans la variable $listeMembre avec les réservations si elles existent
		{
			$listeMembre[$i]['id'] = $donnees->id;
			$listeMembre[$i]['nomMembre'] = $donnees->nomMembre; 
			$listeMembre[$i]['prenomMembre'] = $donnees->prenomMembre; 
			$reservation = run("SELECT id, dateReserve, midi
								FROM reserverepas 
								WHERE reserverepas.id_membre = '".$donnees->id."'
								AND residence = '".$residence."'
								AND dateReserve BETWEEN '".$dateDebut."' AND '".$dateFin."'");
			if($reservation){
				$y=0;
				while($temp = $reservation->fetch_object())
					{
						$listeMembre[$i]['reservation'][$y]['dateReserve'] = $temp->dateReserve;
						$listeMembre[$i]['reservation'][$y]['midi'] = $temp->midi;
						$y++;
					}
			}
		$i++;
		}
	}
	//Selection des jours interdits pour plus tard annuler les reservations concernées dans le tableur
	$reservationInterdites = run("SELECT dateVerouiller, midi
						FROM verrouillerjourrepas 
						WHERE residence = '".$residence."'
						AND dateVerouiller BETWEEN '".$dateDebut."' AND '".$dateFin."'");
	if($reservationInterdites)
	{
		$y=0;
		while($temp2 = $reservationInterdites->fetch_object())
			{
				$listeReservationInterdites[$y]['dateVerouiller'] = $temp2->dateVerouiller;
				$listeReservationInterdites[$y]['midi'] = $temp2->midi;
				$y++;
			}
	}
	//On utilise PhpExcel pour générer les fichiers excel
	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';
	$workbook = new PHPExcel;
	$sheet = $workbook->getActiveSheet();
	//Insertion de style et d'élément fixes
	$styleA1 = $sheet->getStyle('A1:D1');
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$sheet->getColumnDimension('A')->setWidth(12);
	$sheet->getColumnDimension('B')->setWidth(12);
	$sheet->getColumnDimension('C')->setWidth(7);
	$sheet->getColumnDimension('D')->setWidth(11);
	for ($col = 'E'; $col != 'AJ'; $col++) 
	{
		$sheet->getColumnDimension($col)->setWidth(4);
	}
	$sheet->setCellValue('A1',"Nom");
	$sheet->setCellValue('B1',"Prenom");
	$sheet->setCellValue('C1',"Total");
	if($residence==1)
	{
		$sheet->setCellValue('D1',"Anne Frank");
	}
	else
	{
		$sheet->setCellValue('D1',"Clair Logis");
	}
	$z=0;
	foreach($period as $dt)
	{
		//On affiche les dates sur la toute première ligne 
		$sheet->setCellValueExplicitByColumnAndRow($z+4, 1, $dt->format("d"),PHPExcel_Cell_DataType::TYPE_STRING);
		$z++;
	}
	$ordonne=2;
	if($listeMembre != NULL)
	{
		foreach($listeMembre as $key => $value) 
		{
			if(isset($value['reservation']))
			//Si les réservations existent pour le membre
			{
				$sheet->setCellValueByColumnAndRow(0, $ordonne, $value['nomMembre']);
				$sheet->setCellValueByColumnAndRow(1, $ordonne, $value['prenomMembre']);
				$sheet->setCellValueByColumnAndRow(3, $ordonne, "Midi");
				$sheet->setCellValueByColumnAndRow(3, ($ordonne+1), "Soir");
				//On definit pour chaque membre le total midi et soir
				$sheet->setCellValue('C'.(string)$ordonne,'=SUM(G'.(string)$ordonne.':AL'.(string)$ordonne.')');
				$sheet->setCellValue('C'.(string)($ordonne+1),'=SUM(G'.(string)($ordonne+1).':AL'.(string)($ordonne+1).')');
				//On applique les deux bordures
				$styleTop = $sheet->getStyle('A'.(string)$ordonne.':AI'.(string)$ordonne);
		        $styleTop->applyFromArray(array(
		            'borders'=>array(
		                'top'=>array(
		                    'style'=>PHPExcel_Style_Border::BORDER_MEDIUM))));
		        $styleBottom = $sheet->getStyle('A'.(string)($ordonne+1).':AI'.(string)($ordonne+1));
		        $styleBottom->applyFromArray(array(
		            'borders'=>array(
		                'bottom'=>array(
		                    'style'=>PHPExcel_Style_Border::BORDER_MEDIUM))));
					foreach($value['reservation'] as $k => $value2)
					//On parcours les reservations
					{
						$emplacement=(int)date('d', strtotime($value2['dateReserve']));
						if($value2['midi']==1)
						//Si la réservation se passe le midi
						{
						$sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)$ordonne)->applyFromArray(array(
							'fill'=>array(
								'type'=>PHPExcel_Style_Fill::FILL_SOLID,
		                			'color'=>array(
		                    			'argb'=>'008000'))));
						//On insere la valeur 1 pour une reservation 
						$sheet->setCellValueByColumnAndRow(($emplacement+3), $ordonne, 1);
						}
						else
						{
						$sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)($ordonne+1))->applyFromArray(array(
						    'fill'=>array(
						        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
						            'color'=>array(
						                'argb'=>'008000'))));
						//On insere la valeur 1 pour une reservation 
						$sheet->setCellValueByColumnAndRow(($emplacement+3), ($ordonne+1), 1);
						}
					}
					if(isset($listeReservationInterdites))
					//On va annuler dans le tableur les réservations qui ont été interdites
					{
						foreach($listeReservationInterdites as $k => $value3)
						//On parcours les reservations
						{
							$emplacement=(int)date('d', strtotime($value3['dateVerouiller']));
							if($value3['midi']==1)
							//Si la réservation se passe le midi
							{
							$sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)$ordonne)->applyFromArray(array(
								'fill'=>array(
									'type'=>PHPExcel_Style_Fill::FILL_SOLID,
			                			'color'=>array(
			                    			'argb'=>'808080'))));
							//On insere la valeur 1 pour une reservation 
							$sheet->setCellValueByColumnAndRow(($emplacement+3), $ordonne, 0);
							}
							else
							{
							$sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($emplacement+3).(string)($ordonne+1))->applyFromArray(array(
							    'fill'=>array(
							        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
							            'color'=>array(
							                'argb'=>'808080'))));
							//On insere la valeur 1 pour une reservation 
							$sheet->setCellValueByColumnAndRow(($emplacement+3), ($ordonne+1), 0);
							}
						}
					}
				//un saut de deux à chaque car il y a le midi et le soir
				$ordonne=$ordonne+2;
			}
		}
	}
	if($ordonne >= 4)
	//Si au moins un membre qui a fait une réservation
	{
		$sheet->setCellValue('B'.(string)$ordonne,"Totaux:");
		$styleA1 = $sheet->getStyle('B'.(string)$ordonne);
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		//On calcule le total global
		$sheet->setCellValue('C'.(string)$ordonne,'=SUM(C2:C'.(string)($ordonne-1).')');
		for ($i = 4; $i <= 34; $i++)
		//Permet de calculer le total de chaque jour
		{
			$a1=PHPExcel_Cell::stringFromColumnIndex($i);
			$sheet->setCellValue($a1.(string)$ordonne,'=SUM('.$a1.'2:'.$a1.(string)($ordonne-1).')');
		}
		$sheet->getStyle('C1:AI'.(string)$ordonne)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
	if($residence==1)
	{
		$nomFichier = "Anne_Frank_".(string)date('m-Y', strtotime($dateDebut))."_recapitulatif_reservations";
	}
	else
	{
		$nomFichier = "Clair_Logis_".(string)date('m-Y', strtotime($dateDebut))."_recapitulatif_reservations";
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