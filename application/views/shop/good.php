<div class="container">
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<?php
			$i = 0;
			foreach($images as $image) {
				echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'"'.(($i == 0) ? ' class="active"' : '').' aria-current="true" aria-label="Photo '.($i + 1).'"></button>';
				$i++;
			}
		?>
	</div>
	<div class="carousel-inner">
		<?php
			$i = 0;
			foreach($images as $image) {
				echo '<div class="carousel-item'.(($i == 0) ? ' active' : '').'">';
				echo '<img src="'.(base_url().'/assets/images/'.$image->Path).'" class="d-block w-100" alt="'.$image->Path.'">';
				echo '</div>';
				$i++;
			}
		?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
	</button>
	</div>
</div>
