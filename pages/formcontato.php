<?php
	$json_string = $GLOBALS['api']['pages']."/".$GLOBALS['pages']['formcontato']['id']."/sections";
	$jsondata = file_get_contents($json_string);
	$sectionItens = json_decode($jsondata, TRUE);


	foreach ($sectionItens as $section) {
		$_GET['sectionId'] = $section['id'];
		include "pages/section.php";
	}

	
?>


<!-- SCRIPTS -->
<script type="text/javascript" src='<?php echo $GLOBALS["base_url"]."/js/ss-formcontact.js"; ?>'></script>