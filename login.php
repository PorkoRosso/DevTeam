<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> Login </title>
	</head>
	<body>
		<header>
			<center><h1>CU: Ralphies List</h1></center>
		</header>
		<nav>
			<ul>
				<li><a href="rj_user.php">Home</a></li>
				<li><a href="rj_browse.php">Browse</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="http://www.google.com">Google</a></li>
			</ul>
			</p>
		</nav>
		<section>
			<info>
			<?
				include 'functions.php';
				Login();
			?>
			<form method = "post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="border: 3px solid #101417; background-color: #cfb87b; padding: 25px 70px 25px 70px;">
				Username:<br>
				<input type="text" name="user_email">
				<br>
				Password:<br>
				<input type="password" name="user_pass">
				<br><br>
				<input name = "go" type="submit" value="Submit">
				<input type="submit" value="Sign Up">
			</form>
			</info>	
		</section>
	</body>
	</html>
