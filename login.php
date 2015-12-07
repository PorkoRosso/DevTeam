<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="pics/buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> Login </title>
	</head>
	<body>
		<header>
			<center><h1>CU: Ralphies List</h1></center>
		</header>
		<nav>
			<li><a href="rj_user.php">Home</a></li>
			<li><a href="add_item.php">New Post</a></li>
			<li><a href="rj_browse.php">Browse</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="rj_about.php">About</a></li>
			<li><a href="rj_reg.php">Register</a></li>
			<li><a href="http://www.google.com">Google</a></li>
		</nav>
		<section>
			<info>
			<form method = "post" action = "" style="border: 3px solid #101417; background-color: #cfb87b; padding: 25px 70px 25px 70px;">
				Username:<br>
				<input id="email" type="text" name="user_email">
				<br>
				Password:<br>
				<input id="user_password" type="password" name="user_pass">
				<br><br>
				<input name = "go" type="submit" value="Submit">
				<input type="submit" value="Sign Up">
			</form>
			<?php
				include 'functions.php';
				Login();
			?>
			</info>
		</section>
	</body>
	</html>
