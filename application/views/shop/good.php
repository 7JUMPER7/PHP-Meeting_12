<div class="container">
	<div class="goodWrap">
		<?php
			if(count($images) != 0) { // Если картинки есть
				?>
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
				<?php
			} else { // Если картинок нет
				?>
					<div class="carousel">
						<div class="undefinedImage"><svg width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
							</svg></div>
					</div>
				<?php
			}
		?>
		

		<div class="goodInfo">
			<h3><?php echo $good->Good; ?></h3>
			<p><?php echo $good->Category; ?></p>
			<p class="description"><?php echo $good->Description ?></p>
			<div class="priceWrap">
				<h3 class="price"><?php echo $good->Price; ?> грн</h3>
				<?php
					echo form_open('/error/notfound');
					echo form_submit(array('class' => 'glowBtn'), 'Купить');
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
