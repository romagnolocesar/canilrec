<?php
	include "config/globals.php";
	include "includes/conect_db.php";

	$page = $_GET['page'];


	// Getting Page
	$json_string = $GLOBALS['api']['pages']."/".$GLOBALS['pages'][$page]['id'];
	$jsondata = file_get_contents($json_string);
	$pageInfo = json_decode($jsondata, TRUE);

	// Getting all sections of current page
	$json_string = $GLOBALS['api']['pages']."/".$GLOBALS['pages'][$page]['id']."/sections";
	$jsondata = file_get_contents($json_string);
	$pageSections = json_decode($jsondata, TRUE);


?>
<html>
<head>
	<?php 
		include "includes/header.php"; 
		echo "<title>".utf8_decode($GLOBALS['sitename'])." - ".utf8_decode($pageInfo['title'])."</title>";
		echo "<link rel=stylesheet href='".$GLOBALS['base_url']."/css/slider.css'>";
		echo "<link rel=stylesheet href='".$GLOBALS['base_url']."/css/menu.css'>";
		echo "<link rel=stylesheet href='".$GLOBALS['base_url']."/css/footernavbar.css'>";

		//Put the styles of sections
		foreach ($pageSections as $pageSection) {
			echo "<link rel=stylesheet href='".$GLOBALS['base_url']."/css/".$pageSection['cssfile']."'>";
		}

	?>
</head>
<body>
	<div id="main-app">
		<?php
			include "pages/sections/ss-slider.php";
			include "pages/sections/ss-mainmenu.php";

			switch ($page) {
				case 'home':
					include "pages/homepage.php";
					break;
				case 'profile':
					include "pages/profile.php";
					break;
				case 'trackdetail':
					include "pages/trackdetail.php";
					break;
				case 'formcontato':
					include "pages/formcontato.php";
					break;
				case 'tracks':
					include "pages/tracks.php";
					break;
			}

			include "pages/sections/ss-navbar.php";
		?>
	</div>
</body>

</html>