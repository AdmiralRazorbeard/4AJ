<?php
date_default_timezone_set('Europe/Paris');
$date = '10.00.2010';
if(date('d.m.Y', strtotime($date)) == $date)
{
	echo 'meuh';
}
?>