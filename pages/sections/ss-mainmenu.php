<section id="ss-mainmenu">
	<section class="text-center" id="nav_bar">
		<div class="row">
			<div class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12">
				<div class="itens clearfix">
					<ul class="">
						<a href="
						<?php 
							echo $GLOBALS['base_url']."/home/";
						?>
						">
							<li class="float-left 
							<?php if($pageInfo['link'] == 'home'){
								echo 'selected';
							} 
							?>
							">
							Home
							</li>
						</a>
						<a href="
							<?php 
								echo $GLOBALS['base_url']."/contato/";
							?>
						">
							<li class="float-left 
							<?php if($pageInfo['link'] == 'formcontato'){
								echo 'selected';
							} 
							?>
							">Contato</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</section>
</section>