<?php
function check_param(){

	//Source: http://www.html-form-guide.com/php-form/php-login-form.html

	
	//Check values initally to see if they are filled in
	if(isset($_POST["submit"])){
		
		if (empty($_POST['user_first_name'])){
			echo "Name is empty!";
			return false;
		}
		if (empty($_POST['user_last_name'])){
			echo "Name is empty!";
			return false;
		}
		if (empty($_POST['user_pass'])){
			echo "Password is empty!";
			return false;
		}
		if (empty($_POST['user_email'])){
			echo "email was left empty!";
			return false;
		}	
		if (empty($_POST['user_phone'])){
			echo "phone was left empty!";
			return false;
		}	
		//Trim spaces out of each value to ensure difference between "abc123 " and "abc123" and for organization
		//trim each variable

		$userFirstName = trim($_POST['user_first_name']);
		$userLastName = trim($_POST['user_last_name']);
		$password = trim($_POST['user_pass']);
		$id = trim($_POST['user_id']);
		$email = trim($_POST['user_email']);
		$phone = trim($_POST['user_phone']);

		//Validate each entry with separate functions
		//check_user_name(user_id)
		//check_user_pass(user_pass)
		//check_user_email(user_email)
		//check_user_phone(user_phone)

		Add_user($userFirstName, $userLastName, $password, $id, $email, $phone);
	}
}

function Add_user($userFirstName, $userLastName, $password, $id, $email, $phone){
	//check_param() //each variable will be inputed into this
	//if everything pass intiate insert into
	
	$con=mysql_connect("localhost","root","");
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

	$adduser = mysql_query("INSERT INTO `Users` (user_id, LastName, FirstName, user_email, user_pass, user_phone) Values 
	('$id', '$userLastName', '$userFirstName' , '$email', '$passwordmd5' , '$phone');"); 


	if(!$adduser){
		echo "Sign up failed!";
	}
}

function Login(){
	
	if(isset($_POST['go'])){
		//echo "test";
		//$a = $_POST['update'];
		//echo $a;
		if(empty($_POST['user_email']) && empty($_POST['user_pass'])){
			echo "An email and a password are required!";
			return false;
		}

		if (empty($_POST['user_email'])){
			echo "An email is required!";
			return false;
		}	

		if (empty($_POST['user_pass'])){
			//$a = $_POST['update'];
			//echo $a;
			echo "A password is required!";
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
	$con=mysql_connect("localhost","root","");
	// Check connection
	if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL:";
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
  				echo "successful login!";
  				$login_success = true;
  			}
    		
  		}
		if(!$login_success){
  			echo "incorrect username/password";	
  		}
  	}
	
}
//Source: http://www.w3schools.com/php/php_file_upload.asp
//Still need to add category, Trade/sale function, check for no image upload, sql query to add to database
function upload_item(){
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		if (empty($_POST['Item_price'])){
			echo "email was left empty!";
			return false;
		}	

		if (empty($_POST['Item_name'])){
			echo "password was left empty!";
			return false;
		}

		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}

		$price = trim($_POST['Item_price']);
		$price = SanitizeForSql($price);
		$price = mysql_real_escape_string($price);
		$item = trim($_POST['Item_name']);
		$item = SanitizeForSql($item);
		$item = mysql_real_escape_string($item);

	}
	// Check if file already exists
	/**if (file_exists($target_file)) {
		echo "Sorry, file already exists."; //Don't need this in final implimentation
		$uploadOk = 0;
	}**/
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
}
?>
