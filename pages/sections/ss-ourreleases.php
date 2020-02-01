<div class="container">
	<!-- Galeria -->
	<div class="container releases_galery">
		<div class="row text-center text-lg-left">
			<?php
			foreach ($jsonItens as $item) {
			?>
			<div class="col-lg-3 col-md-4 col-xs-6">
	    		<a href="<?php echo $GLOBALS['base_url']."/trackdetail/".$item['id']?>" class="d-block mb-4 h-100">
	    	<?php
	      			echo "<img class='img-fluid img-thumbnail' src='".$GLOBALS['base_url']."/img/covers/".$item["cover"]."' alt=''>";
	      	?>
	    		</a>
	  		</div>
	  		<?php

			}

			?>
		</div>
	</div>
	<div class="button button-selected">Todos os lançamentos</div>
</div>
