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
			<ul>
				<li><a href="rj_user.php">Home</a></li>
				<li><a href="rj_browse.php">Browse</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="rj_about.php">About</a></li>
				<li><a href="rj_reg.php">Register</a></li>
				<li><a href="http://www.google.com">Google</a></li>
			</ul>
			</p>
		</nav>
		<section>
			<info>
			<p><span class="error">* required field.</span></p>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> \" style="border: 3px solid #101417; background-color: #cfb87b; padding: 25px 70px 25px 70px;"> 
			Name: <input type="text" name="name" value="<?php echo $name;?>">
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>
			E-mail: <input type="text" name="email" value="<?php echo $email;?>">
			<span class="error">* <?php echo $emailErr;?></span>
			<br><br>
			Website: <input type="text" name="website" value="<?php echo $website;?>">
			<span class="error"><?php echo $websiteErr;?></span>
			<br><br>
			Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
			<br><br>
			<input type="submit" name="submit" value="Submit"> 
			</form>
			<?
				include 'functions.php'
				check_param();
			?>
			</info>	
		</section>
	</body>
	</html>
