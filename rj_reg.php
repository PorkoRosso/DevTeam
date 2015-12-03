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
				<li><a href="rj_browse.php">Browse</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="rj_about.php">About</a></li>
				<li><a href="rj_reg.php">Register</a></li>
				<li><a href="http://www.google.com">Google</a></li>
		</nav>
		<section>
			<info>

			<form method="post" style="border: 3px solid #101417; background-color: #cfb87b; padding: 25px 70px 25px 70px;">
			First Name: <input type="text" name="user_first_name">
			<br><br>
			Last Name: <input type="text" name="user_last_name">
			<br><br>
			Phone Number: <input type="text" name="user_phone">
			<br><br>
			E-mail: <input type="text" name="user_email">
			<br><br>
			Password: <input type="password" name="user_pass">
			<br><br>
			<input type="submit" name="submit" value="Submit">
			</form>
			<?
				include 'functions.php';
				check_param();
			?>
			</info>
		</section>
	</body>
	</html>
