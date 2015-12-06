<?php
function check_param(){
	//Source: http://www.html-form-guide.com/php-form/php-login-form.html
	//Check values initally to see if they are filled in
	if(isset($_POST["submit"])){
		
		if (empty($_POST['user_first_name'])){
			echo "Name is empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}
		if (empty($_POST['user_last_name'])){
			echo "Name is empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}
		if (empty($_POST['user_pass'])){
			echo "Password is empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}
		if (empty($_POST['user_email'])){
			echo "email was left empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}	
		if (empty($_POST['user_phone'])){
			echo "phone was left empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}	
		//Trim spaces out of each value to ensure difference between "abc123 " and "abc123" and for organization
		//trim each variable

		$userFirstName = trim($_POST['user_first_name']);
		$userLastName = trim($_POST['user_last_name']);
		$password = trim($_POST['user_pass']);
		$email = trim($_POST['user_email']);
		$phone = trim($_POST['user_phone']);

		//Validate each entry with separate functions
		//check_user_name(user_id)
		//check_user_pass(user_pass)
		//check_user_email(user_email)
		//check_user_phone(user_phone)

		Add_user($userFirstName, $userLastName, $password, $email, $phone);
	}
}
//posibly use regex code below to test @colorado.edu email

/*$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  $nameErr = "Only letters and white space allowed"; 
} */

function Add_user($userFirstName, $userLastName, $password, $email, $phone){
	//check_param() //each variable will be inputed into this
	//if everything pass intiate insert into
	
	$con=mysql_connect("localhost","root","root");
	// Check connection
	if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL:";
  	}

  	$db_selected = mysql_select_db('CXC', $con);
	if(!$db_selected){
		echo "Failed to connect to Database</br>";
	}
	
	 //Security risk SQL injections
	$userFirstName = mysql_real_escape_string($userFirstName); //Allows variable to be inserted into sql
	$userLastName = mysql_real_escape_string($userLastName);
	$password = mysql_real_escape_string($password);
	$id = mysql_real_escape_string($id);
	$email = mysql_real_escape_string($email);
	$phone = mysql_real_escape_string($phone);

	$adduser = mysql_query("INSERT INTO `Users` (LastName, FirstName, user_email, user_pass, user_phone) Values 
	('$userLastName', '$userFirstName' , '$email', '$password' , '$phone');"); 


	if(!$adduser){
		echo "Sign up failed!";
	}
	else{
		echo "<script type='text/javascript'>window.top.location='http://localhost:8888/login.php';</script>";
	}
}

function Login(){
	
	if(isset($_POST['go'])){
		if(empty($_POST['user_email']) && empty($_POST['user_pass'])){
			
			echo "An email and a password are required!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}

		if (empty($_POST['user_email'])){
			
			echo "An email is required!";
			$page = $_SERVER['PHP_SELF'];
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}	

		if (empty($_POST['user_pass'])){
			
			echo "A password is required!";
			$page = $_SERVER['PHP_SELF'];
			$sec = "0";
			header("Refresh: $sec; url=$page"); //Redirects to "user profile"
			return false;
		}
		
		$password = trim($_POST['user_pass']);
		$email = trim($_POST['user_email']);

		Checklogin($email, $password);
	}	

}
function Checklogin($email, $password){
	////Source: http://stackoverflow.com/questions/10643626/refresh-page-after-form-submiting
	//Source: http://stackoverflow.com/questions/5285388/mysql-check-if-username-and-password-matches-in-database
	$con=mysql_connect("localhost","root","root");
	// Check connection
	if (mysqli_connect_errno()){
  		//echo "Failed to connect to MySQL";
  	}
  	$db_selected = mysql_select_db('CXC', $con);
	if(!$db_selected){
		echo "Failed to connect to Database</br>";
	}

	//$email = SanitizeForSql($email);
	$email = mysql_real_escape_string($email);
	//$password = SanitizeForSql($password);
	$password = mysql_real_escape_string($password);
 
	$query = mysql_query("Select * FROM Users WHERE user_email = '$email'");

	$numRows = mysql_num_rows($query);
	$login_success = false;

	if ($numRows!=0){

  		while ($row = mysql_fetch_assoc($query)){
  			if($email == $row['user_email'] && $password == $row['user_pass']){
  				//echo "successful login!";
  				$login_success = true;
  				//break;
  			}
    		
  		}
		if(!$login_success){
  			echo "incorrect username/password";	
  		}
  		else{
  			echo "<script type='text/javascript'>window.top.location='http://localhost:8888/rj_user.php';</script>"; 
  			exit();
  		}
  	}
	
}
//Source: http://www.html-form-guide.com/php-form/php-form-checkbox.html
function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            return true;
        }
        else{
        	return false;
        }
    }


//Source: http://www.w3schools.com/php/php_file_upload.asp
//Still need to add category, Trade/sale function, check for no image upload, sql query to add to database
function upload_item(){

	$con=mysql_connect("localhost","root","root");
	// Check connection
	if (mysqli_connect_errno()){
  		//echo "Failed to connect to MySQL";
  	}
  	$db_selected = mysql_select_db('CXC', $con);
	if(!$db_selected){
		echo "Failed to connect to Database</br>";
	}

	$target_dir = "/Users/Ameya/Dropbox/CSCI3308/Project/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		if(empty($_POST['Item_price']) && empty($_POST['Item_name'])){
			echo "A name and price are required!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}
		if (empty($_POST['user_email'])){
			
			echo "An email is required!";
			$page = $_SERVER['PHP_SELF'];
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}	
		else if (empty($_POST['Item_price'])){
			echo "Item price left empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}	

		else if (empty($_POST['Item_name'])){
			echo "Item name was left empty!";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}
		/**if(!(IsChecked('For_sale', 'A') && IsChecked('For_trade', 'B')){
			echo "Please choose whether you want to trade and/or sell the item(s).";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			return false;
		}**/
		if(IsChecked('For_trade', 'B')){
			$ForTrade = 1;
		}
		else{
			$ForTrade = 0;
		}
		if(IsChecked('For_sale', 'A')){
			$ForSale = 1;
		}
		else{
			$ForSale = 0;
		}
		
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		
		} else {
			echo "File is not an image.";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			$uploadOk = 0;
		}
	
		// Check if file already exists
		/**if (file_exists($target_file)) {
			echo "Sorry, file already exists."; //Don't need this in final implimentation
			$uploadOk = 0;
		}**/
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			$uploadOk = 0;
		}
		// Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		else if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			$page = $_SERVER['PHP_SELF']; //Refreshes page
			$sec = "0";
			header("Refresh: $sec; url=$page");
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$email = trim($_POST['user_email']);
				$email - mysql_real_escape_string($email);
				$price = trim($_POST['Item_price']);
				$item = trim($_POST['Item_name']);
				$item = mysql_real_escape_string($item);
				//$ForTrade = mysql_real_escape_string($ForTrade);
				//$ForSale = mysql_real_escape_string($ForSale);
				//$imagePath = trim($target_file);
				//$imagePath = mysql_real_escape_string($imagePath);
				//This is where query will go
				$addItem = mysql_query("INSERT INTO `Items` (user_email, Item_Name, Item_price, For_sale, For_trade, ipath) Values 
	('$email', '$item' , '$price', '$ForSale' , '$ForTrade' , '$target_file');"); 
				if(!$addItem){
					echo "Error uploading Item";

				}
				else{
					echo "Item uploaded!";
				}
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}	
}
//function Display(); //will take in image path
//function search_Item(){
	//if match is found call Display function
	//return;
//}
//function Disaply_home();
?>