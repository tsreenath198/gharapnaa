<?php

	class Validation 
	{		
		/* =============== Validation Checks =========== */
		function isValidMessage($val)
		{
			if(strpos(strtolower($val), '<a href=')!==false || strpos(strtolower($val), '<img')!==false || strpos(strtolower($val), 'https://')!==false || strpos(strtolower($val), 'http://')!==false) {
				/* header('Location: https://www.kansaz.com/'); 
				die(); */
				return false;
			}
			return true;
		}
		function isNameValidation($name) {
			$name_err = "";
			$nameMatch = "/[a-zA-Z .]/"; 
			
			if($name==""){
				$name_err="Please Enter Name";
			} else if($name!= '' && !preg_match($nameMatch, $name)) {
				$name_err="Invalid Name";
			}
			return $name_err;
		}
		function isEmailValidation($email) {
			$email_err = "";
			$emailMatch = "/[a-z0-9.!#^$%&*()_+-=@?><]+@+[a-z]+\.+[a-z]{1,7}/"; 
			$email = strtolower($email);
			if($email==""){
				 $email_err="Enter Email";
			} else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match($emailMatch, $email)){
				$email_err="Enter Valid Email";
			}
			return $email_err;
		}
		function isPhoneCodeValidation($phoneCode) {
			$phone_code_err = "";
			if($phoneCode==""){
				 $phone_code_err="Select Code";
			}
			return $phone_code_err;
		}
		function isPhoneValidation($phone) {
			$phone_err = "";
			$phoneMatch = "/^[0-9]*$/";//"/\d/"; 
			
			if($phone==""){
				 $phone_err="Enter Phone";
			} else if($phone != "" && !preg_match($phoneMatch, $phone)){
				$phone_err="Enter Valid Phone";
			}
			return $phone_err;
		}
		/* =============== Validation Checks =========== */
	}
?>