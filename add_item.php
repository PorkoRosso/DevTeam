<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> add item </title>
	</head>
	<body>
		<header>
			<center><h1>CU: Ralphies List</h1></center>
		</header>
		<nav>
			<ul>
				<li><a href="rj_user.html">Home</a></li>
				<li><a href="rj_browse.html">Browse</a></li>
				<li><a href="rj_login.html">Login</a></li>
				<li><a href="http://www.google.com">Google</a></li>
			</ul>
			</p>
		</nav>
		<section>
			<info>
			<form action="functions.php" method="post" enctype="multipart/form-data" style="border: 3px solid #101417; background-color: #f1f1c1; padding: 25px 70px 25px 70px;" 	>
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Post Item" name="submit">
				<?
					include 'functions.php'
					add_item();
				?>
				</form>
			</form>
			</info>	
		</section>
	</body>
	</html>
