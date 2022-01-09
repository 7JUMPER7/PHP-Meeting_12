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
	<link href="<?php echo base_url(); ?>css/goodPage.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/auth.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/admin.css" rel="stylesheet">
</head>
<body>

<header id="header">
	<?php
		echo "<a href='".site_url('/shop')."' class='logo'>Arsenii Shop</a>";
		echo "<div class='login'>";
		if(isset($_SESSION['customer'])) {
			echo "<a class='userHeaderWrap' href='".site_url('/auth')."'>";
			echo "<h3 class='userName'>".$_SESSION['customer']['Name']."</h3>";
			if($_SESSION['customer']['Avatar']) {
				echo "<img src='data:image/jpeg;base64,".base64_encode($_SESSION['customer']['Avatar'])."' alt='Avatar'>";
			}
			echo "</a>";
		} else {
			echo "<a href='".site_url('/auth/register')."'>Register</a>";
			echo "<span>/</span>";
			echo "<a href='".site_url('/auth/login')."'>Login</a>";
		}
		echo "</div>";
	?>
</header>

<main>
