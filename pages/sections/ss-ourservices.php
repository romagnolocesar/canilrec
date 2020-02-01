
<div class="container">	
	<div class="row">

		<?php
		foreach ($jsonItens as $item) {
			$iconUrl = $GLOBALS['base_url']."/api/iconsService.php?iconcode=".$item['icon'];
			$iconData = file_get_contents($iconUrl);
		?>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="item" class="clearfix">	
					<center>
						<div id="ss-ourservices-icon">
		<?php
							echo $iconData;
		?>
						</div>
						<div id="ss-ourservices-title">
		<?php
							echo utf8_decode($item["title"]);
		?>
						</div>
						<div id="ss-ourservices-description">
		<?php
							echo utf8_decode($item["text"]);
		?>
						</div>
						<div id="ss-ourservices-button">
		<?php
							echo utf8_decode($item["button"]);
		?>
						</div>
					</center>
				</div>
			</div>
		<?php

		}

		?>


	</div>
</div>