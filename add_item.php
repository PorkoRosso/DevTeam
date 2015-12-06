<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="pics/buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> add item </title>
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
			<form method="post" enctype="multipart/form-data" style= "left: 250px; width: 200px;border: 3px solid #101417; background-color: #cfb87b; padding: 25px 70px 25px 70px;"	>
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				Email: <br><input type ="text" name = "user_email"><br>
				Item Name: <br><input type ="text" name = "Item_name"><br>
				Item Price: <br><input type = "text" name = "Item_price"><br>
				Trade: <br><input type = "checkbox" name = "For_sale"><br>
				Sale: <br><input type = "checkbox" name = "For_trade"><br>
				<input type="submit" value="Post Item" name="submit">
				<?
					include 'functions.php';
					upload_item();
				?>
			</form>
			</info>
		</section>
	</body>
	</html>
