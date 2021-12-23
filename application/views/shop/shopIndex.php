<div class="container">
	<div class="shopContainer">
		<div class="filters">
			<p>Фильтры</p>
			<?php
				echo form_open('shop');
				echo form_label('Категория:', 'categoryId');
				echo "<select id='categoryId' name='categoryId'>";
					echo "<option value='0'>Все</option>";
					foreach($categories as $category) {
						if($category->Id == $selectedCategoryId) {
							echo "<option value='".$category->Id."' selected>".$category->Category."</option>";
						} else {
							echo "<option value='".$category->Id."'>".$category->Category."</option>";
						}
					}
				echo "</select>";
				echo form_submit(array('name' => 'filterBtn'), 'Найти');
				echo form_close();
			?>
		</div>
		<div class="cards">
			<?php
				foreach($goods as $good) {
					echo "<div class='card'>";
					if(!$good->PreviewImage) {
						?>
							<div class="undefinedImage"><svg width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
								</svg></div>
						<?php
					} else {
						echo "<img src='".(base_url().'assets/images/'.$good->PreviewImage)."' alt='".$good->PreviewImage."'>";
					}
					echo "<div class='body'>";
					echo "<h5>".$good->Good."</h5>";
					echo "<h5 class='price'>".$good->Price." грн</h5>";
					echo "</div></div>";
				}
			?>
		</div>
	</div>
</div>
