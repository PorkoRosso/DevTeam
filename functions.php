<?php
/*! \file functions,php
	\brief File containing all functions necessary for website to interact with database
*/

/*! \fn check_param()
	\brief Check values in form to make sure they are all filled in. Puts information into variables:
	 $userFirstName, $userLastName, $password, $email, and $phone
*/

/*!
	\fn Add_user($userFirstName, $userLastName, $password, $email, $phone)
	\brief Inserts variables taken from form into database
	\param $userFirstName First name taken from form
	\param $userLastName Last name taken from form
	\param $password Password entereed from form
	\param $phone Phone number entered from form
*/

/*!
	\fn Login()
	\brief Checks values in login form to make sure they have been entered and puts them into variables:
	$email and $password
*/

/*!
	\fn Checklogin($email, $password)
	\brief Checks for login credentials in database
	\param $email taken from login form
	\param $password taken from login form
*/
/*!
	\fn IsChecked($chkname)
	\brief Returns which checkbox has been selected in upload item form
	\param $chkname Name of the checkbox in html form
*/

/*!
	\fn upload_item()
	\brief Takes in information through form, including email, item name/price, item image and whether the 
	item is for sale and uploads it to the database
*/
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

		Add_user($userFirstName, $userLastName, $password, $email, $phone);
	}
}
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
			header("Refresh: $sec; url=$page"); 
			return false;
		}
		
		$password = trim($_POST['user_pass']);
		$email = trim($_POST['user_email']);

		Checklogin($email, $password);
	}	

}
function Checklogin($email, $password){
	//Source: http://stackoverflow.com/questions/10643626/refresh-page-after-form-submiting
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
function IsChecked($chkname){
//Source: http://www.html-form-guide.com/php-form/php-form-checkbox.html
    if(!empty($_POST[$chkname])){
        return true;
     }
     else{
       return false;
     }
}
function upload_item(){
//Source: http://www.w3schools.com/php/php_file_upload.asp
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
		if(IsChecked('For_trade')){
			$ForTrade = 1;
		}
		else{
			$ForTrade = 0;
		}
		if(IsChecked('For_sale')){
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
//
//http://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format
//	$regexPass= '[A-Za-z0-9!?.]{5-13}'
//	//password must be 5-13 characters,numbers,or acceptable punctuation(!, ?, .)
//	if (preg_match($regexPass, $password)) {
//	    echo 'Passed';
//		} else {
  //  	echo 'Password does not meet the requirments:'/n '-5-13 charcters'/n'-Characters, Numbers, or Acceptable Puncuation(!,?,.)';
	//	}

	//check email validity and format
//	$regexEmail='[colorado.edu]{12}$'
	//email must be @colorado.edu
//	if (preg_match($regexEmail, $email)) {
  // 		 echo 'Passed';
	//	} else {
    //		echo 'Invalid Email:'/n'-Needs to be colorado.edu email';
	//	}

	//Check Phone Number
	//$regexPhone='^[1-9]{1}[0-9]{2}-[1-9]{1}[0-9]{2}-[0-9]{4}$'
	//number must be 10 digits with area code ->maybe add functionality here for people with longer numbers from different countries		
	//if (preg_match($regexPhone, $phone)) {
    //		echo 'Passed';
	//	} else {
    //		echo 'Invalid phone number please use: xxx-xxx-xxxx formatting';
//	}

//function Display(); //will take in image path
//function search_Item(){
	//if match is found call Display function
	//return;
//}
//function Disaply_home();
?>
