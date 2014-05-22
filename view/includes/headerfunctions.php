<?php
function openSection($page)
//permet de regarder quelle section est ouverte et creer un classe active pour les boutons du menu
{
	if($_GET['section'] == $page)
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_vieEnFoyer()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'vieEnFoyer' || $_GET['section'] == 'services' || $_GET['section'] == 'repas' || $_GET['section'] == 'livreOr')
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_devenirResidant()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'devenirResidant' || $_GET['section'] == 'conditions' || $_GET['section'] == 'logements')
	{
		return true;
	}
	return false;
}
?>
<?php
function openSous_Section_contact()
//idem que openSection sauf que cette classe active ne s'appliquera que sur le bouton principal lorsque l'un des boutons sera utilisé du menu déroulant
{
	if($_GET['section'] == 'contact' || $_GET['section'] == 'faq' || $_GET['section'] == 'memento' || $_GET['section'] == 'faireUnDon')
	{
		return true;
	}
	return false;
}
?>