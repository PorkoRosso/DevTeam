<!doctype html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="pics/buff.jpg" type="image/jpg"/>
		<link rel="stylesheet" href="rj_style.css" type="text/css"/>
		<link href=’http://fonts.googleapis.com/css?family=Droid+Sans’ rel=’stylesheet’ type=’text/css’>
		<title> Home </title>
	</head>
	<body>
		<header>
			<center><h1>Ralphies Junk</h1></center>
		</header>
		<input type="text" class="advancedSearchTextBox" />
		<nav>
			<p> <b>These are my favorite links:</b>
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
				<p> <b>CU ralphies junk </b><br>
					TEST
				</p>
				<p>
						<?php
							echo("<b>This is a test</b>") . "<br>";
							$con=mysql_connect("localhost","root","");
							// Check connection
							if (mysqli_connect_errno())
  							{
  								echo "Failed to connect to MySQL:";
  							}
  							else{
  								echo "Connected to MySQL</br>";
  							}
  							//Show all databases
  							/**$res = mysql_query("SHOW DATABASES");

							while ($row = mysql_fetch_assoc($res)) {
    							echo $row['Database'] . "<br>";
							}*/
							//Select Database
							$db_selected = mysql_select_db('CXC', $con);
							if(!$db_selected){
								echo "Failed to connect to Database</br>";
							}
							else{
								echo "Connected to Database</br>";
							}
							//Check for adding user to database
							$adduser = mysql_query("INSERT INTO `Users` (user_id, LastName, FirstName, user_email, user_pass) Values
							('defg5678', 'defg', 'defg' , 'defg5678@colorado.edu', 'defg5678')");
							if(!$adduser){
								echo "User failed adding to database</br>";
							}
							else{
								echo "User added to database</br>";
							}
							//Check for adding item to database
							$additem = mysql_query("INSERT INTO `Items` (user_id, Item_Name, Item_price,  cat_id, For_sale, For_trade) Values
							('defg5678', 'new_item', 39.99,  4, 0, 1)");
							if(!$additem){
								echo "Item failed to be added to Database</br>";
							}
							else{
								echo "Item added to Database</br>";
							}
							// ...some PHP code for database "my_db"...
							// Request the text of all the Categories
    						/*$result = mysql_query("SELECT * FROM Categories");
    						if (!$result) {
      							echo("<P>Error performing query: " .
           							mysql_error() . "</P>");
      						}
      						else{
      							echo "Query Works!";
      							exit();
    						}*/

						?>
				</p>
			</info>

		</section>
	</body>
	</html>
