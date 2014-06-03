<?php include_once '/view/includes/header.php'; ?>
<style type="text/css">
table {
    border-collapse: collapse; /* Les bordures du tableau seront collées (plus joli) */
    border: 1px solid black;
}
td {
	border: 1px solid black;
}
th {
	border: 1px solid black;
	width : 150px;
}
.true
{
	background-color: green;
	cursor:pointer;
}
.false
{
	background-color: red;
	cursor:pointer;
}
.invalide
{
	background-color: grey;
	cursor:not-allowed;
}
</style>
<script type="text/javascript">
function confirmerRepas(jour, mois, annee, midi, residence){	/*Fonction redirige sur la même page en mettant les paramètres en GET */
	if(residence == 1)
	{
		javascript:location.href='index.php?section=repas&semaineAnneFrank=<?php echo $semaineDuAnneFrank; ?>&jour='+jour+'&mois='+mois+'&annee='+annee+'&midi='+midi+'&residence='+residence;
	}
	else
	{
		if(residence == 2)
		{
			javascript:location.href='index.php?section=repas&semaineClairLogis=<?php echo $semaineDuClairLogis; ?>&jour='+jour+'&mois='+mois+'&annee='+annee+'&midi='+midi+'&residence='+residence;
		}
	}
}
</script>
			<div class="contentWrapper">
				<h1>Verrouiller un jour</h1>
