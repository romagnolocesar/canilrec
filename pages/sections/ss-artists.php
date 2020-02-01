<div class="container" style="padding-bottom: 2.2rem">	
	<div class="row">

		<?php
		foreach ($jsonItens as $item) {
		?>

		<div id="artists-box-container" class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
		<?php
			//echo "<a href='".$GLOBALS["base_url"]."/profile/".$item["id"]."'>";
		?>
			<div class="artists-box">
				<p id="full-description">
		<?php
				echo utf8_decode($item["shortdescription"]);

		?>
				</p>
				<div class="clearfix">	
					<center>
						<div id="picture">
							<div class="overlay"></div>
		<?php
							echo '<img class="img-responsive img-fluid" src="'.$GLOBALS['base_url'].'/img/artists/'.$item["picture"].'">';
		?>
						</div>
						<div id="name">
							<span>
		<?php
								echo $item["name"];
		?>
							</span>
						</div>
						<div id="genre">
							<span>
		<?php
			$genreUrl = $GLOBALS['base_url']."/api/genres/".$item["genre"];
			$genreData = file_get_contents($genreUrl);
			$genre = json_decode($genreData);
			echo utf8_decode($genre->title);
		?>
							</span>
						</div>
						<div id="mail">
							<span class="eleganticon"> &nbsp</span> 
							<span>
		<?php
								echo utf8_decode($item["email"]);
		?>
							</span>
						</div>
						<div id="phone">
								<span class="eleganticon"> &nbsp</span> 
								<span>
		<?php
									echo utf8_decode($item["phone"]);;
		?>
								</span>
						</div>
					</center>
				</div>
			</div>
		</div>
		<!-- </a> -->

		<?php

		}

		?>	


	</div>
</div>
<div id="artists-details">
	<div class="row">
		<div class="col">
			<div class="section_shape">
			<p class="section_shape_icon">{</p>
			</div>
		</div>
	</div>
	<div class="container" id="details-box"></div>
	
</div>


<!-- SCRIPTS -->
<script type="text/javascript" src='<?php echo $GLOBALS["base_url"]."/js/ss-artists.js"; ?>'></script>