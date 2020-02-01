<?php
	$json_string = $GLOBALS['api']['pages']."/".$GLOBALS['pages']['tracks']['id']."/sections";
	$jsondata = file_get_contents($json_string);
	$sectionItens = json_decode($jsondata, TRUE);

	foreach ($sectionItens as $section) {
		$_GET['sectionId'] = $section['id'];
		include "pages/section.php";
	}

	
?>
