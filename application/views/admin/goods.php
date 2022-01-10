<div class="container">
	<div class="adminForm">
		<?php
		echo form_open('/admin/goods', array('method' => 'post'));
			echo "<table><thead>";
				echo "<tr>";
					echo "<th class='delCheckbox'></th>";
					echo "<th>Id</th>";
					echo "<th>Good</th>";
					echo "<th>Category</th>";
					echo "<th>Price</th>";
					echo "<th>Description</th>";
					echo "<th>Image</th>";
				echo "</tr>";
			echo "</thead><tbody>";
			foreach($goods as $good) {
				echo "<tr>";
					echo "<td class='delCheckbox'>".form_checkbox(array('name' => 'selected[]', 'value' => $good->Id))."</td>";
					echo "<td>".$good->Id."</td>";
					echo "<td>".$good->Good."</td>";
					echo "<td>".$good->Category."</td>";
					echo "<td>".$good->Price."</td>";
					echo "<td>".$good->Description."</td>";
					echo "<td class='image'>";
					if(!$good->PreviewImage) {
						?>
							<div class="undefinedImage"><svg width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
								</svg></div>
						<?php
					} else {
						echo "<img src='".(base_url().'assets/images/'.$good->PreviewImage)."' alt='".$good->PreviewImage."'>";
					}
					echo "</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
			echo form_submit(array('name' => 'delBtn'), 'Удалить выбранное');
		echo form_close();
		?>
	</div>
	<div class="adminForm">
	<?php
		echo form_open('/admin/goods', array('method' => 'post', 'class' => 'adminAddForm'));
			echo "<h2>Добавить новый элемент</h2>";
			echo form_input(array('type' => 'text', 'placeholder' => 'Товар', 'name' => 'good', 'required' => ''));
			echo "<select name='categoryId' required>";
			foreach($categories as $category) {
				echo "<option value='".$category->Id."'>".$category->Category."</option>";
			}
			echo "</select>";
			echo form_input(array('name' => 'price', 'type' => 'number', 'placeholder' => 'Цена', 'required' => ''));
			echo form_textarea(array('name' => 'description', 'placeholder' => 'Описание', 'required' => ''));
			echo form_submit(array('name' => 'addBtn'), 'Добавить');
		echo form_close();
		?>
	</div>
</div>
