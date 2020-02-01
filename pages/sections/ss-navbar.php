<?php
	$json_string = $GLOBALS['api']['socialmidias'];
	$jsondata = file_get_contents($json_string);
	$jsonItens = json_decode($jsondata, TRUE);
?>
<section id="ss-navbar" class="text-center sm-auto">
	<div class="container">
		<div class="row">
			<div class="col-12 social_midias_logo">
				<img class="img-responsive img-fluid" src="<?php echo $GLOBALS['base_url']; ?>/img/footer-logo.png">
			</div>
		</div>
		<div class="row">
			<div class="social_midias_bar">
				<?php
				foreach ($jsonItens as $item) {
					$iconUrl = $GLOBALS['base_url']."/api/iconsService.php?iconcode=".$item['icon'];
					$iconData = file_get_contents($iconUrl);
					echo "<a href='".$item['link']."' target='_blank'><div class='social_midias_buttons'>".$iconData."</div>";
				}
				?>
			</div>
		</div>
		<div class="row copyright">
			<div class="col">
					<p>Canil Records | Todos os Direitos Reservados 2019</p>
			</div>
		</div>
	</div>
</section>