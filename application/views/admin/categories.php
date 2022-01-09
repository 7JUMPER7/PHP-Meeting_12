<div class="container">
	<div class="adminForm">
		<?php
		echo form_open('/admin/categories', array('method' => 'post'));
			echo "<table><thead>";
				echo "<tr>";
					echo "<th class='delCheckbox'></th>";
					echo "<th>Id</th>";
					echo "<th>Category</th>";
				echo "</tr>";
			echo "</thead><tbody>";
			foreach($categories as $category) {
				echo "<tr>";
					echo "<td class='delCheckbox'>".form_checkbox(array('name' => 'selected[]', 'value' => $category->Id))."</td>";
					echo "<td>".$category->Id."</td>";
					echo "<td>".$category->Category."</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
			echo form_submit(array('name' => 'delBtn'), 'Удалить выбранное');
		echo form_close();
		?>
	</div>
	<div class="adminForm">
	<?php
		echo form_open('/admin/categories', array('method' => 'post', 'class' => 'adminAddForm'));
			echo "<h2>Добавить новый элемент</h2>";
			echo form_input(array('type' => 'text', 'placeholder' => 'Категория', 'name' => 'category', 'required' => ''));
			echo form_submit(array('name' => 'addBtn'), 'Добавить');
		echo form_close();
		?>
	</div>
</div>
