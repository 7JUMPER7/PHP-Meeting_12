<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Arsenii shop</title>
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/header.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/catalog.css" rel="stylesheet">
</head>
<body>

<header id="header">
	<?php
		echo "<a href='".site_url('/home')."' class='logo'>Arsenii Shop</a>";
		echo "<div class='login'>";
		if(isset($_SESSION['customer'])) {
			echo "<a href='".site_url('/auth')."'><h3>".$_SESSION['customer']->getLogin()."</h3></a>";
		} else {
			echo "<a href='".site_url('/auth/register')."'>Register</a>";
			echo "<a href='".site_url('/auth/login')."'>Login</a>";
		}
		echo "</div>";
	?>
</header>

<main>
