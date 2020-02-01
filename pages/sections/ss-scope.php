<div class="container">
	<div class="row">
		<?php
			foreach ($jsonItens as $item) {
				$iconUrl = $GLOBALS['base_url']."/api/iconsService.php?iconcode=".$item['icon'];
				$iconData = file_get_contents($iconUrl);
				echo "<div class='col-el-3 col-lg-3 col-md-3 col-sm-12 col-12 scope_boxes'>";
				echo "<p class='scope_number'>".utf8_decode($item['value'])."</p>";
				echo "<p class='scope_icon'><span class='scope_icon_img'>";
				echo $iconData;
				echo "</span></p>";
				echo "<p class='scope_title'>".utf8_decode($item['title'])."</p>";
				echo "</div>";
			}
		?>
	</div>
</div>
<div class="row scope_info_bar">
	<div class="col-el-8 col-lg-8 col-md-8 col-sm-8 col-12">
		<p class="scope_info_bar_text">para mais estatisticas detalhadas favor entrar em contato.</p>
	</div>
	<div class="col-el-4 col-lg-4 col-md-4 col-sm-4 col-12">
		<a href='<?php echo $GLOBALS["base_url"]."/contato/"; ?>'><div class="scope_info_bar_button">Contato</div></a>
	</div>
</div>