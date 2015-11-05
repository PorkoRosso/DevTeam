<?php
function check_param(){
	
	//Check values initally to see if they are filled in
	if (empty($_POST['user_first_name'])){
		$this->HandleError("Name is empty!");
		return false;
	}
	if (empty($_POST['user_last_name'])){
		$this->HandleError("Name is empty!");
		return false;
	}
	if (empty($_POST['user_pass'])){
		$this->HandleError("Password is empty!");
		return false;
	}
	/**if (empty($_POST['user_id'])){
		$this->HandleError("ID is empty!");
		return false;
	}**/
	if (empty($_POST['user_email'])){
		$this->HandleError("email was left empty!");
		return false;
	}	
	if (empty($_POST['user_phone'])){
		$this->HandleError("phone was left empty!");
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
	check_user_pass(user_pass)
	check_user_email(user_email)
	check_user_phone(user_phone)

	Add_user($userFirstName, $userLastName, $password, $id, $email, $phone);
}

function Add_user($userFirstName, $userLastName, $password, $id, $email, $phone){
	//check_param() //each variable will be inputed into this
	//if everything pass intiate insert into
	if (!$this->check_param()){
		$this->HandleError("Sign up failed")
	}
	$userFirstName = $this->SanitizeForSql($userFirstName); //Security risk SQL injections
	$userFirstName = mysql_real_escape_string($userFirstName); //Allows variable to be inserted into sql
	$userLastName = $this->SanitizeForSql($userLastName);
	$userLastName = mysql_real_escape_string($userLastName);
	$passwordmd5 = md5($password); //raw binary input, probably wont need this during testing
	$passwordmd5 = mysql_real_escape_string($passwordmd5);
	$id = $this->SanitizeForSql($id);
	$id = mysql_real_escape_string($id);
	$email = $this->SanitizeForSql($email);
	$email = mysql_real_escape_string($email);
	$phone = $this->SanitizeForSql($phone);
	$phone = mysql_real_escape_string($phone);

	$adduser = mysql_query("INSERT INTO `Users` (user_id, LastName, FirstName, user_email, user_pass, user_phone) Values 
	('$id', '$userLastName', '$userFirstName' , '$email', '$passwordmd5' , '$phone');") 


	if(!$adduser){
		$this->HandleError("Sign up failed!");
	}
}
?>