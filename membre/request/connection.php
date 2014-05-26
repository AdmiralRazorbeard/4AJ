<?php
function isConnect()
// Return true si connecté, false sinon
{
	if(!empty($_SESSION['log']) && $_SESSION['log'] == 1 && !empty($_SESSION['mail']))
	{
		return true;
	}
	return false;
}
?>