<div class="container">
	<?php
		echo form_open('/auth/login', array('class' => 'authForm'));
		echo form_label('Login');
		echo form_input(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Email', 'value' => set_value('email')));
		echo form_input(array('type' => 'password', 'name' => 'pass', 'placeholder' => 'Password'));
		echo form_submit(array('name' => 'sBtn'), 'Log in');
		if(isset($success)) {
			echo "<div class='messages'>";
			if($success) {
				echo "<div class='goodMessage'>Вы успешно вошли!</div>";
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
