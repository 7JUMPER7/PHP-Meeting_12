<div class="container">
	<div class="userWrap">
		<?php
			if($isAuth) {
				echo form_open('/auth/update', array('method' => 'POST', 'enctype' => 'multipart/form-data'));
				if($customer->Avatar) {
					echo '<div class="imageWrap"><img src="data:image/jpeg;base64,'.base64_encode($customer->Avatar).'"/></div>';
				}
				echo form_upload(array('name' => 'avatar'));

				echo form_label('Name:');
				echo form_input(array('name' => 'name', 'type' => 'text'), $customer->Name);

				echo form_label('Email:');
				echo form_input(array('name' => 'email', 'type' => 'email'), $customer->Email);

				echo form_label('Discount %:');
				echo form_input(array('type' => 'text', 'readonly' => ''), $customer->Discount);
				
				echo form_label('Role:');
				echo form_input(array('type' => 'text', 'readonly' => ''), $customer->Role);

				echo form_submit(array('name' => 'updateBtn'), 'Update info');
				echo form_close();

				echo form_open('/auth');
				echo form_submit(array('name' => 'logOutBtn'), 'Log out');

				if(isset($errors)) {
					echo "<div class='messages'>";
					echo "<ul class='errors'>";
					foreach($errors as $error) {
						echo "<li class='badMessage'>".$error."</li>";
					}
					echo "</ul>";
					echo "</div>";
				}
				
				echo form_close();
			} else {
				echo "<div>Log in first</div>";
			}
		?>
	</div>
</div>
