<div class="container">
	<?php
		echo form_open('/auth/register', array('class' => 'authForm'));
		echo form_label('Register');
		echo form_input(array('type' => 'text', 'name' => 'name', 'placeholder' => 'Name', 'value' => set_value('name')));
		echo form_input(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Email', 'value' => set_value('email')));
		echo form_input(array('type' => 'password', 'name' => 'pass1', 'placeholder' => 'Password'));
		echo form_input(array('type' => 'password', 'name' => 'pass2', 'placeholder' => 'Confirm password'));
		echo form_submit(array('name' => 'sBtn'), 'Register');
		if(isset($success)) {
			echo "<div class='messages'>";
			if($success) {
				echo "<div class='goodMessage'>Вы успешно зарегистрировались!</div>";
				?>
					<script>
						setTimeout(() => {
							window.location = '<?php echo base_url(); ?>';
						}, 1000);
					</script>
				<?php
			} else {
				echo "<ul class='errors'>";
				foreach($errors as $error) {
					echo "<li class='badMessage'>".$error."</li>";
				}
				echo "</ul>";
			}
			echo "</div>";
		}
		echo form_close();
	?>
</div>
