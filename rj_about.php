<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> About </title>
	</head>
	<body>
		<header>
			<a href="rj_home.php">
				<left><img src="logo.png" style="width:190px;height:90px;border:0;" </left>
			</a>
		</header>
		<input type="text" class="advancedSearchTextBox" />
		<nav>
			<p> <b>These are my favorite links:</b>
			<ul>
				<li><a href="rj_home.php">Home</a></li>
				<li><a href="rj_about.php">About</a></li>
				<li><a href="rj_gallery.php">Gallery</a></li>
				<li><a href="http://www.computerhope.com">Computer Hope</a></li>
				<li><a href="http://www.google.com">Google</a></li>
			</ul>
			</p>
		</nav>
		<section>
			<info>
				<p>
						<?php
							echo("This is a website</br>");
							echo( date("l, F dS Y.") );
						?>
				</p>
			</info>
		</section>
	</body>
	</html>
