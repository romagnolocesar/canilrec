<?php
	$json_string = $GLOBALS['api']['tracks']."/".$_GET['id'];
	$jsondata = file_get_contents($json_string);
	$jsonItem = json_decode($jsondata, TRUE);

	$json_string = $GLOBALS['api']['tracks']."/".$_GET['id']."/artists";
	$jsondata = file_get_contents($json_string);
	$jsonArtists = json_decode($jsondata, TRUE);


?>
<div class="container" style="padding-bottom: 2.2rem">	
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
			<div class="tracks-box <?php if(!$jsonItem){echo 'd-none';}?>">
				<div class="clearfix">	
					<center>
						<div id="picture">
							<div class="overlay"></div>
		<?php
							echo '<img class="img-responsive img-fluid" src="'.$GLOBALS['base_url'].'/img/covers/'.$jsonItem["cover"].'">';
		?>
						</div>
						<div id="name">
							<span>
		<?php
								echo utf8_decode($jsonItem["title"]);
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
								echo "TOM";
		?>
							</span>
						</div>
						<div id="phone">
								<span class="eleganticon"> &nbsp</span> 
								<span>
		<?php
									echo "BPM";
		?>
								</span>
						</div>
					</center>
				</div>
			</div>


		</div>
		<div <?php if(!$jsonItem){echo 'class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"';}else{ echo 'class="card col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12"';}?>  style="padding: 0">
			<div class="card-header" style="text-align: left;">
				<?php if($jsonItem){echo "<span class='card-icon'> </span>".$jsonItem["title"];}?>
			</div>
			<div class="card-body" style="text-align: left;">
				<div class=" container tracks-wrapper">
					<div class="row">
						<div class="col">
							<div id="waveform"></div>	
						</div>
					</div>
					<?php
						if($jsonItem["audio"]){
					?>
					<p></p>
					<div class="row">
						<div class="col">
							<div class="btn-group" role="group" aria-label="Basic example">
							  <button id='btn' type="button" class="btn btn-secondary">PLAY/PAUSE</button>
							</div>	
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
			<div class="card-header" style="text-align: left;">
				<?php if($jsonItem){echo "<span class='card-icon'></span> Envolvidos";}?>
			</div>
			<div class="card-body" style="text-align: left;">
				<div class=" container tracks-wrapper">
					<div class="row">
						<?php 
						if($jsonArtists){
							foreach ($jsonArtists as $artist) {
								echo "<div class='col-3 track-item'>";
								echo "<a href='".$GLOBALS["base_url"]."/profile/".$artist["id"]."'>";
									echo '<div id="picture">';
										echo "<div class='overlay'>";
										echo "</div>";
										echo "<img class='img-fluid img-thumbnail' src='".$GLOBALS['base_url']."/img/artists/".$artist["picture"]."' alt=''>";
									echo "</div>";
								echo "</div>";
								echo "</a>";
							}
						}else if(!$jsonItem){
							?>
							<div class="alert alert-block">
								<button type="button" class="close" data-dismiss="alert"></button>
									<h4>AVISO</h4>
									Infelizmente essa musica está temporariamente indisponivel.
								
							</div>
							<?
						}
						?>
					</div>
					
				</div>
			</div>
		</div>



	</div>
</div>

<script>
	$( document ).ready(function() {
		

		<?php
			if($jsonItem["audio"]){
		?>
			var wavesurfer = WaveSurfer.create({
			    container: '#waveform',
			    scrollParent: false,
			    fillParent: true,
			    mediaControls: true
			});

			wavesurfer.load('<?php echo $GLOBALS['base_url']."/tracks/".$jsonItem["audio"]; ?>');	
		<?php
			}
		?>
		

		$('#btn').click(function(event) {
			wavesurfer.playPause();
		});

	});
	

</script>