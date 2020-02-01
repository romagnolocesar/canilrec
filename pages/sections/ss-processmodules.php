<div class="container">
	<div class="row">
		<?php
			foreach ($jsonItens as $item) {
				$iconUrl = $GLOBALS['base_url']."/api/iconsService.php?iconcode=".$item['icon'];
				$iconData = file_get_contents($iconUrl);
			echo "<div class='col-el-4 col-lg-4 col-md-4 col-sm-12 col-12 col-4 processmodules'>";
				echo "<div class='row'>";
					echo "<div class='col-2'>";
						echo "<div class='courses_category_bullet'>";
							echo "<p class='courses_category_bullet_icon'>".$iconData."</p>";
						echo "</div>";
					echo "</div>";
					echo "<div class='col-10'>";
						echo "<p class='courses_category_title'>".utf8_decode($item['title'])."</p>";
						echo "<p class='courses_category_modules'>".utf8_decode($item['subtitle'])."</p>";
						echo "<p class='courses_category_desc'>".utf8_decode($item['text'])."</p>";
					echo "</div>";
				echo "</div>";
			echo "</div>";	
		}
		?>
	</div>
</div>