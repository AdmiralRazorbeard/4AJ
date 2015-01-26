<?php
include_once 'request/gestionMembres.php';
if(isAdminMembres())
{
	function nbreInscrit($jour, $mois, $annee, $midi, $residence)
	$date = $annee.'-'.$mois.'-'.$jour;
	$count = run('SELECT COUNT(*) as nbre FROM verrouillerjourrepas WHERE dateVerouiller = "'.$date.'" AND midi = '.$midi.' AND residence = '.$residence)->fetch_object();
	//si verrouillé alors il y a forcement 0 inscrit
	if($count->nbre >= 1)
	{
		return 0;
	}
	$tmp = run('SELECT COUNT(*) as nbre FROM reserverepas WHERE dateReserve="'.$date.'" AND midi = '.$midi.' AND residence='.$residence)->fetch_object();
	return $tmp->nbre;
	


	$nomFichier ="liste_membres_repas_".(string)date('m-Y', strtotime("now"));
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