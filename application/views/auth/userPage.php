<div class="container">
	<?php
		if($isAuth) {
			echo "<h2>Name:</h2>";
			echo "<p>".$customer->Name."</p>";
			echo "<h2>Email:</h2>";
			echo "<p>".$customer->Email."</p>";
			echo "<h2>Discount:</h2>";
			echo "<p>".$customer->Discount."%</p>";
			echo "<h2>Role:</h2>";
			echo "<p>".$customer->Role."</p>";
			echo form_open('/auth');
			echo form_submit(array('name' => 'logOutBtn'), 'Log out');
			echo form_close();
		} else {
			echo "<div>Log in first</div>";
		}
	?>
</div>
