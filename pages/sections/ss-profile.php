<?php
	$json_string = $GLOBALS['api']['artists']."/".$_GET['id'];
	$jsondata = file_get_contents($json_string);
	$jsonItem = json_decode($jsondata, TRUE);

	$json_string = $GLOBALS['api']['artists']."/".$_GET['id']."/tracks";
	$jsondata = file_get_contents($json_string);
	$jsonTracks = json_decode($jsondata, TRUE);

?>
<div class="container" style="padding-bottom: 2.2rem">	
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
			<div class="artists-box">
				<div class="clearfix">	
					<center>
						<div id="picture">
							<div class="overlay"></div>
		<?php
							echo '<img class="img-responsive img-fluid" src="'.$GLOBALS['base_url'].'/img/artists/'.$jsonItem["picture"].'">';
		?>
						</div>
						<div id="name">
							<span>
		<?php
								echo utf8_decode($jsonItem["name"]);
		?>
							</span>
						</div>
						<div id="genre">
							<span>
		<?php
			$genreUrl = $GLOBALS['base_url']."/api/genres/".$jsonItem["genre"];
			$genreData = file_get_contents($genreUrl);
			$genre = json_decode($genreData);
			echo utf8_decode($genre->title);
		?>
							</span>
						</div>
						<div class="social-midia-buttons">
							<ul>
								<li class="col-3"></li>
								<li class="col-3"></li>
								<li class="col-3"></li>
								<li class="col-3"></li>
							</ul>
						</div>
						<div id="mail">
							<span class="eleganticon"> &nbsp</span> 
							<span>
		<?php
								echo utf8_decode($jsonItem["email"]);
		?>
							</span>
						</div>
						<div id="phone">
								<span class="eleganticon"> &nbsp</span> 
								<span>
		<?php
									echo utf8_decode($jsonItem["phone"]);
		?>
								</span>
						</div>
					</center>
				</div>
			</div>
		</div>
		<div class="card col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12" style="padding: 0">
			<div class="card-header" style="text-align: left;">
				<span class="card-icon"></span> Produções
			</div>
			<div class="card-body" style="text-align: left;">
				<div class=" container tracks-wrapper">
					<div class="row">
						<?php 
						foreach ($jsonTracks as $track) {
						echo "<div class='col-3 track-item'>";
						echo "<a href='".$GLOBALS["base_url"]."/trackdetail/".$track["id"]."'>";
							echo '<div id="picture">';
								echo "<div class='overlay'>";
								echo "</div>";
								echo "<img class='img-fluid img-thumbnail' src='".$GLOBALS['base_url']."/img/covers/".$track["cover"]."' alt=''>";
							echo "</div>";
						echo "</div>";
						echo "</a>";
						}
						?>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>
