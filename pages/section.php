<?php
	//GET SECTION INFOS
	$sectionId = $_GET['sectionId'];


	$json_string = $GLOBALS['api']['sections']."/".$sectionId;
	$jsondata = file_get_contents($json_string);
	$sectionItem = json_decode($jsondata, TRUE);
?>
	<section id="<?php echo $sectionItem['cssid']; ?>" class="text-center  sm-auto
		<?php 
		if($sectionItem['hasshape']){ 
			echo "grayBg hasShape"; 
		}else{
			echo "hasNoShape"; 
		}
		?>">
		<!-- SHAPE ICON -->
		<?php if($sectionItem['hasshape']){?>
			<div class="row">
				<div class="col">
					<div class="section_shape">
					<p class="section_shape_icon">
						<?php 
							$iconUrl = $GLOBALS['base_url']."/api/iconsService.php?iconcode=".$sectionItem['shapeicon'];
							$iconData = file_get_contents($iconUrl);
							echo $iconData; 
						?>
					</p>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<div class="container" style="padding-top: 1.3rem">
			<?php if($sectionItem['showtitles']){?>
			<div class="row">
				<div class="col">
					<h3 class="session_title clearfix">
						<div class="shape_left">
							<?php if(!$sectionItem['hasshape']){?>
								<div class="shape_left_bar"></div>
							<?php } ?>
							<div class="shape_left_three"></div>
							<div class="shape_left_two"></div>
							<div class="shape_left_one"></div>
						</div>
						<div class="text">
							<span class="title-1"><?php echo utf8_decode($sectionItem['title1']); ?></span>
							<span class="title-2"><?php echo utf8_decode($sectionItem['title2']); ?></span>
						</div>
						<div class="shape_right">
							<?php if(!$sectionItem['hasshape']){?>
								<div class="shape_right_bar"></div>
							<?php } ?>
							<div class="shape_right_one"></div>
							<div class="shape_right_two"></div>
							<div class="shape_right_three"></div>
						</div>
					</h3>
				</div>
			</div>
			<?php } ?>
			<?php if($sectionItem['description']){?>
				<div class="row">
					<div class="col">
						<p class="description">
						<?php echo utf8_decode($sectionItem['description']); ?>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>

		<?php
		switch ($sectionId) {
			case 1:
				$json_string = $GLOBALS['base_url']."/api/tracksService.php?limit=4";
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-ourreleases.php";
				break;
			case 2:
				$json_string = $json_string = $GLOBALS['api']['artists'];	
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-artists.php";
				break;
			case 3:
				$json_string = $GLOBALS['api']['ourservices'];
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-ourservices.php";
				break;
			case 4:
				include "sections/ss-criatproccess.php";
				break;
			case 5:
				$json_string = $GLOBALS['api']['processmodules'];
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-processmodules.php";
				break;
			case 6:
				$json_string = $GLOBALS['api']['scopes'];
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-scope.php";
				break;
			case 7:
				$json_string = $GLOBALS['api']['socialmidias'];
				$jsondata = file_get_contents($json_string);
				$jsonItens = json_decode($jsondata, TRUE);
				include "sections/ss-navbar.php";
				break;
			case 9:
				include "sections/ss-profile.php";
				break;
			case 10:
				include "sections/ss-trackdetail.php";
				break;
			case 11:
				include "sections/ss-formcontato.php";
				break;
			case 12:
				include "sections/ss-tracks.php";
				break;
			default:
				# code...
				break;			
		}
		?>
	</section>