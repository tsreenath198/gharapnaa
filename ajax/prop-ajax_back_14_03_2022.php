<?php
	include("../includes/config.php");
	include("../includes/connection.php");
	include("../includes/MysqliDb.php");
	include("../includes/functions.php");
	include("../includes/queries.php");
	include("../includes/session.php");
	
	$action=$_REQUEST['action'];
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $action!='insertImg' && $action!='insertProfileImg')
	{
		die("cheating");
	}
	
	
	switch($action):
		
		case 'getDeptEmps' :
				
				$conn = getDBConnection();
				$departId = $_POST['dept_id'];
				$empData = array();
				
				if($departId>0 && getIsLoggedIn())
				{
					$empData = getRecordsArray($conn, "SELECT * FROM `".TBL_EMPLOYEES."` WHERE `department`='".$departId."' AND `emp_role`=1");
				}
				echo json_encode($empData);
				break;
		case 'contactform' :
			
			$conn = getDBConnection();
			
			$name=$_POST['name'];
			$email=$_POST['email'];
			$subject=$_POST['subject'];
			$message=$_POST['message'];
			$dateAdded = currDateTime();
			$ip = getClientIP();
			$browserInfo = getBrowserInfo();
			/* $insertContactSQL = "INSERT INTO `contacts` (`name`, `email`, `subject`, `message`, `ip`, `browser_info`, `date_added`) VALUES ('".$name."', '".$email."', '".$subject."', '".$message."', '".$ip."', '".$browserInfo."', '".$dateAdded."')"; */
			if($name!='' && $email!='')
			{
				$insertContactSQL = "INSERT INTO `".TBL_CONTACTS."` (`name`, `email`, `subject`, `message`, `ip`, `browser_info`, `date_added`) VALUES ('".$name."', '".$email."', '".$subject."', '".$message."', '".$ip."', '".$browserInfo."', '".$dateAdded."')";
				if(insertUpdateRecord($conn, $insertContactSQL))
				{
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Form submitted successfully.');
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Your email already existed.');  /* getErrorMsg($conn) */
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Form not submitted.');
			}
			echo json_encode($status);
			break;
			
		case 'sendotp' :
				
			$conn = getDBConnection();
			
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$valid = $_POST['valid'];
			
			$optNum = rand(111111, 999999);
			
			/* === User check ==== */
			$records = (array)getRecordsAssoc($conn, "SELECT * FROM `".TBL_USER."` WHERE `u_email`='".$email."'");
			/* === User check ==== */
			if((count($records)>0 && (isset($records['u_email']) && $records['u_email']!='') || (isset($records['u_phone']) && $records['u_phone']!='')) || ($valid=='register'))
			{
				$otpDate = getSessionOTPDate();
				if($otpDate==null || $otpDate<=date("Y-m-d H:i:s"))
				{
					setSessionOTP($optNum);
				}
				else
				{
					$optNum = getSessionOTP();
				}
				
				if($email!='')
				{
					
					$to = "$email";
					$subject = "Hai";

					$message = "<!DOCTYPE html><html><head><title>GHARAPNAA</title></head><body style='background-color:#fff;color:#666666;'>Your OPT for change password is : <b>".$optNum."</b></body></html>";

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <info@gharapnaa.com>' . "\r\n";
					
					if(IS_PROD==1)
					{
						mail($to,$subject,$message,$headers);
					}
				}
				if($phone>0)
				{
					
				}
				$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'OTP sent successfully.', 'otp' => $optNum);
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'This email / mobile not registered.', 'otp' => $optNum);
			}
			
			echo json_encode($status);
			break;
			
		case 'verifyotp' :
			$otp = $_POST['otp'];
			$sentOTP = getSessionOTP();
			
			if($otp == $sentOTP)
			{
				clearSessionOTP();
				$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'OTP verified successfully.');
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid OTP.');
			}
			echo json_encode($status);
			break;
		case 'addproperty':
		//print_r($_POST);

			break;
		case "enquiry":
			//ini_set("display_errors",1);
			
			$conn = getDBConnection();
			
			$prid=$_POST['prid'];
			$name=$_POST['txtname'];
			$email=$_POST['txtemail'];
			$phon=$_POST['txtphone'];
			
			$checkUpdates=isset($_POST['tm'])? 1 : 0;
			
			$dateAdded = currDateTime();
			$ip = getClientIP();
			$browserInfo = getBrowserInfo();
			
			if($prid!="" && $name!='' && $email!='' && $phon!='')
			{
				$records = (array)getRecordsAssoc($conn, "SELECT * FROM `".TBL_ENQUIRIES."` WHERE (`eq_email`='".$email."' OR `eq_mobile`='".$phon."') AND `pr_id`='".$prid."'");
					//echo $insertEnquirySQL;
				if(count($records)==0)
				{
					$insertEnquirySQL = "INSERT INTO `".TBL_ENQUIRIES."` (`pr_id`, `eq_name`, `eq_email`, `eq_mobile`, `eq_date`, `ip`, `browser_info`, `eq_check_updates`) VALUES ('".$prid."', '".$name."', '".$email."', '".$phon."', '".$dateAdded."', '".$ip."', '".$browserInfo."', '".$checkUpdates."')";
					if(insertUpdateRecord($conn, $insertEnquirySQL))
					{
						$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Details submitted successfully.');
					}
					else
					{
						$status = array('status' => 'error', 'type' => 'text-danger', 'message' => getErrorMsg($conn));  /* getErrorMsg($conn) */
					}
				}
				else
				{
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Already submitted to this property.');
				}
				
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Details not submitted.');
			}
			echo json_encode($status);
			
			/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
			$enqarr=Array("pr_id"=>$prid,"eq_name"=>$name,"eq_mobile"=>$phon,"eq_email"=>$mail);
			$prpobj->insert("enquiries",$enqarr);
			if(!$prpobj->getLastError())
			{
				$status["sts"] = '01';
			}
			else
			{
				$status["sts"] = '00';
			}
			echo json_encode($status); */
			break;
			
		case "removeimg";
			
			$conn = getDBConnection();
			$imgId = $_POST["id"];
			$propertyId = $_POST["pid"];
			$userId = getUserId();
			
			if($userId>0 && $imgId>0 && getIsLoggedIn())
			{
				insertUpdateRecord($conn, "DELETE FROM `".TBL_GALLERY."` WHERE `pg_id`='".$imgId."' AND `u_id`='".$userId."'");
				$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Image deleted successfully.');
				
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid user.');
			}
			echo json_encode($status);
			break;
		case "delproprty":
		
			$conn = getDBConnection();
			$prid = $_POST["prid"];
			$status = array();
			if(getIsLoggedIn())
			{
				if($prid>0 && insertUpdateRecord($conn, "DELETE FROM `".TBL_PROPERTY."` WHERE `pr_id`='".$prid."'"))
				{
					if(insertUpdateRecord($conn, "DELETE FROM `".TBL_GALLERY."` WHERE `pr_id`='".$prid."'"))
					{
						$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Property details deleted successfully.');
					}
					else
					{
						$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Property deleted but gallery not deleted.');
					}
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Error while removing property.');
				}
			}
			echo json_encode($status);
			/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
			$prid=$_POST["prid"];
			$prpobj->where("pr_id",$prid);
			$prpobj->delete("property");
			$prpobj->where("pr_id",$prid);
			$prpobj->delete("property_gallery");
			if(!$prpobj->getLastError())
			{
				$status["sts"] = '01';
			}
			else
			{
				$status["sts"] = '00';
			}
			echo json_encode($status); */
			break;
		
		case "sulogin":
			$user = $_POST["uname"];
			$pwd = $_POST["pwd"];
			$encpwd = md5($pwd);
			
			$conn = getDBConnection();
			
			$loginarray = (array)getRecordsAssoc($conn, "SELECT * FROM `".TBL_EMPLOYEES."` WHERE `user_name`='".$user."' AND `password`='".$encpwd."'");
			
			if(count($loginarray)>0)
			{
				$sessionData = array('id' => $loginarray["id"], 'name' => $loginarray["first_name"], 'user_id' => $loginarray["id"], 'email' => $loginarray["user_name"], 'phone' => $loginarray["phone"], 'is_admin' => true, 'utype' => $loginarray["department"], 'urole' => $loginarray["emp_role"], 'directory' => $loginarray["directory"], 'profile_pic' => $loginarray["profile_pic"], 'display_name' => $loginarray["display_name"]);
					setUserSession($sessionData);
					echo json_encode(array("sts"=>"01"));
			}
			else
			{
				echo json_encode(array("sts"=>"00"));
			}
			
			/* $loginobj=new MysqliDb(HOST,USER,PWD,DB);
			$loginobj->where("log_pwd",$encpwd);
			$loginobj->where("log_email",$user);
			$loginarray=$loginobj->getOne('login','*');
			//echo $loginobj->getLastQuery();
			if($loginobj->count >0)
			{
				if($loginarray["log_pwd"]==$encpwd)
				{
					$sessionData = array('id' => $loginarray["log_id"], 'name' => $loginarray["log_name"], 'user_id' => $loginarray["log_id"], 'email' => $loginarray["log_email"], 'phone' => '', 'is_admin' => true, 'utype' => $loginarray["log_type"], 'urole' => $loginarray["log_role"], 'directory' => $loginarray["log_directory"], 'profile_pic' => $loginarray["log_profile_pic"], 'profile_id' => $loginarray["profile_id"]);
					setUserSession($sessionData);
					
					echo json_encode(array("sts"=>"01"));
				}
				else
				{
					echo json_encode(array("sts"=>"00"));
				}
			}
			else
			{
				echo json_encode(array("sts"=>"00"));
			} */
			break;
			
		case "loginuser":
			//print_r($_POST);exit;
			$user=$_POST["uname"];
			$pwd=$_POST["pwd"];
			$encpwd=md5($pwd);
			$loginobj=new MysqliDb(HOST,USER,PWD,DB);
			$loginobj->where("u_pwd",$encpwd);
			$loginobj->where("u_user_id",$user);
			$loginarray=$loginobj->getOne('user','*');
			//echo $loginobj->getLastQuery();
			if($loginobj->count >0)
			{
				if($loginarray["u_pwd"]==$encpwd)
				{
					$loginobj->insert("login_user",Array("u_id"=>$loginarray["u_id"]));	
					
					$sessionData = array('id' => $loginarray["u_id"], 'name' => $loginarray["u_name"], 'user_id' => $loginarray["u_user_id"], 'email' => $loginarray["u_email"], 'phone' => $loginarray["u_phone"], 'directory' => $loginarray["u_directory"], 'profile_pic' => $loginarray["u_profile_pic"], 'display_name' => $loginarray["u_display_name"], 'is_admin' => false, 'utype' => 0, 'urole' => 0);
					setUserSession($sessionData);
						
					/* $_SESSION["UID"]=  $loginarray["u_id"];
					$_SESSION["UNAME"]=$loginarray["u_name"];
					$_SESSION["USERID"]=  $loginarray["u_user_id"];
					$_SESSION["UEMAIL"]=  $loginarray["u_email"];
					$_SESSION["UMOB"]=  $loginarray["u_phone"];
					$_SESSION["ISADMIN"]=  false;
					$_SESSION["UTYPE"]=  0;
					$_SESSION["ISLOGGEDIN"]=  true; */
					echo json_encode(array("sts"=>"01"));
				}
				else
				{
					echo json_encode(array("sts"=>"00"));
				}
			}
			else
			{
				echo json_encode(array("sts"=>"00"));
			}
			break;
			
		case "registeruser":
			$conn = getDBConnection();
			
			$u_name = $_POST["uname"];
			$u_email = $_POST["emailid"];
			$u_phone = $_POST["mobile"];
			$u_user_id = $_POST["user_id"];
			$pwd=$_POST["pwd"];
			$u_pwd=md5($pwd);
			
			$dateAdded = currDateTime();
			$ip = getClientIP();
			$browserInfo = getBrowserInfo();
				
			if($u_email!="" && $u_phone!='' && $pwd!='')
			{
				$directory = createDirectoryPath('user');
				
				$insertEnquirySQL = "INSERT INTO `".TBL_USER."` (`u_name`, `u_email`, `u_pwd`, `u_phone`, `u_ip`, `u_browser_info`, `u_date_added`, `u_user_id`, `u_directory`) VALUES ('".$u_name."', '".$u_email."', '".$u_pwd."', '".$u_phone."', '".$ip."', '".$browserInfo."', '".$dateAdded."', '".$u_user_id."', '".$directory."')";
				
				if(insertUpdateRecord($conn, $insertEnquirySQL))
				{
					$insertId = getInsertId($conn);
					if($insertId>0)
					{
			//print_r($insertId);exit;
						insertUpdateRecord($conn, "INSERT INTO `".TBL_LOGIN_USER."` (`u_id`, `lu_time`) VALUES ('".$insertId."', '".(date('Y-m-d H:i:s'))."')");
						$sessionData = array('id' => $insertId, 'name' => $u_name, 'display_name' => $u_name, 'email' => $u_email, 'phone' => $u_phone, 'user_id' => $u_user_id, 'directory' => $directory, 'profile_pic' => '', 'is_admin' => false, 'utype' => 0, 'urole' => 0);
						//$sessionData = array('id' => $loginarray["u_id"], 'name' => $loginarray["u_name"], 'user_id' => $loginarray["u_user_id"], 'email' => $loginarray["u_email"], 'phone' => $loginarray["u_phone"]);
						setUserSession($sessionData);
						$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Details submitted successfully.');
					}
					else
					{
						//$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Details not submitted.');
					}
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'User already existed.');  /* getErrorMsg($conn) */
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Details not submitted.');
			}
			echo json_encode($status);
/* 				$loginobj=new MysqliDb(HOST,USER,PWD,DB);
				$loginobj->where("(u_email LIKE ? OR u_phone LIKE ?)",Array($user,$mobile));
				$loginarray=$loginobj->getOne('user','*');
				//echo $loginobj->getLastQuery();
				if($loginobj->count <1)
				{
					$regarr=Array("u_name"=>$user,"u_email"=>$emailid,"u_phone"=>$mobile,"u_pwd"=>$encpwd);
					$loginobj->insert("user",$regarr);	
					$userid=$loginobj->getInsertId();
					if(!$loginobj->getLastError())
					{
						$loginobj->insert("login_user",Array("u_id"=>$loginarray["u_id"]));	
						$_SESSION["UID"]=  $userid;
						$_SESSION["UNAME"]=$user;
						$_SESSION["UEMAIL"]=  $emailid;
						$_SESSION["UMOB"]=  $mobile;

						echo json_encode(array("sts"=>"01"));
					}
					else{
						echo json_encode(array("sts"=>"00"));
					}
				}
				else
				{
					echo json_encode(array("sts"=>"02"));
				}
 */			break;
			
		case "propertystatus":
			$conn = getDBConnection();
			$prid=$_POST["prid"];
			$proStatus=$_POST["status"];
			
			if($prid>0 && getIsLoggedIn())
			{
				$updateSQL = "UPDATE `".TBL_PROPERTY."` SET `pr_status` = '".$proStatus."' WHERE `pr_id`='".$prid."'";
				
				if(insertUpdateRecord($conn, $updateSQL))
				{
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Status changed.');
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Property not updated.');  /* getErrorMsg($conn) */
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid Property.');  /* getErrorMsg($conn) */
			}
			echo json_encode($status);
			break;
			
		case "insertProfileImg":
			
			$conn = getDBConnection();
			$userId = getUserId();
			$isAdmin = isAdmin();
			/* $profileId = getProfileId(); */
			$directory = getUserDirectory();
			$profiePic = getProfilePic();
			$path = AJAX_UPLOAD_FILE_PATH.$directory.'/';
			$response = array();
			
			if($userId>0 && $directory!='' && getIsLoggedIn())
			{
				$response = insertImage($path, $_FILES['file'], 150, 150, $profiePic);

				if($response['status']=="success")
				{
					$fileName = $response['file_name'];
					/* echo json_encode($status);
					return; */
					if($isAdmin)
					{
						insertUpdateRecord($conn, "UPDATE `".TBL_EMPLOYEES."` SET `profile_pic` = '".$fileName."' WHERE `id`='".$userId."'");
						/* insertUpdateRecord($conn, "UPDATE `".TBL_LOGIN."` SET `log_profile_pic` = '".$fileName."' WHERE `log_id`='".$userId."'"); */
					}
					else
					{
						insertUpdateRecord($conn, "UPDATE `".TBL_USER."` SET `u_profile_pic` = '".$fileName."' WHERE `u_id`='".$userId."'");
					}
					setProfilePic($fileName);
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Profile uploaded.', 'file_name' => $fileName);
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid user.');
			}
			
			echo json_encode($status);
			
			break;
			
		case "insertImg":
			$conn = getDBConnection();
			$userId = getUserId();
			$propertyId = $_POST['pid'];
			/* //$maxFileSize = MAX_SIZE*1024;
			//$dirName  = $applicant['directory'];
			//$dirName=strtolower($dirName);

			if(!is_dir(UPLOADS.'/'.$dirName))
			{
				mkdir(UPLOADS.'/'.$dirName, true); 
				chmod(UPLOADS.'/'.$dirName, 0777);

			}
			$dirPath = UPLOADS.'/'.$dirName;
			*/
			if(!is_dir(AJAX_UPLOAD_PATH))
			{
				mkdir(AJAX_UPLOAD_PATH, true); 
				chmod(AJAX_UPLOAD_PATH, 0777);
			}
			$dirPath = AJAX_UPLOAD_PATH;
			/* echo $dirPath;
			return; */
			if (isset($_FILES['file']) && getIsLoggedIn()) {
						
				/* if($_FILES['file']['size'] > $maxFileSize)
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.FILESIZE.'MB');
					
				} else  */
				if($_FILES['file']['tmp_name'] != '') {

					$fileNameParts = explode('.',$_FILES['file']['name']);

					if(count($fileNameParts) > 2)
					{
						$fileExtension = $fileNameParts[count($fileNameParts) - 1];
					}
					else
					{
						$fileExtension = $fileNameParts[1];
					}

					$fileArray = array('gif','jpeg','jpg','png', 'PNG');

					if(in_array($fileExtension, $fileArray))
					{
						$repArray = array('.',' ','-',',');
						$filename = str_replace('.'.$fileExtension, '', $_FILES['file']['name']);
						$filename = str_replace($repArray, '_', $filename);
						$cntFile = count(glob($dirPath."/"."*"));
						$cntFile = $cntFile + 1;
						$filename = $filename.'_'.$cntFile.'.'.$fileExtension;
					
								
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dirPath.$filename))
						{

							$file_target_file = $dirPath.'/'.$filename;
							$temp_target_file = $dirPath.'/'.$filename;

							$image_info = getimagesize($file_target_file); 
							$width_orig  = $image_info[0]; // current width as found in image file
							$height_orig = $image_info[1]; // current height as found in image file
							$width = 770; // new image width
							$height = 330; // new image height
									
							if ($width < $width_orig || $height < $height_orig) {
								$height = round($height_orig * ($width/$width_orig));
							}
							$destination_image = imagecreatetruecolor($width, $height);
	//echo json_encode(array($width, $height));
								switch($fileExtension) {
										
									case 'jpeg':
									case 'jpg':
									
											$orig_image = imagecreatefromjpeg($temp_target_file);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagejpeg($destination_image, $file_target_file, 100);
										
										break;
									case 'PNG':
									case 'png':
										
											$orig_image = imagecreatefrompng($temp_target_file);
											imagealphablending($destination_image, false);
											imagesavealpha($destination_image,true);
											$transparent = imagecolorallocatealpha($destination_image, 255, 255, 255, 127);
											imagefilledrectangle($destination_image, 0, 0, $width, $height, $transparent);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagepng($destination_image, $file_target_file);
										
										break;
											
									case 'gif':
									
											$orig_image = imagecreatefromgif($temp_target_file);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagegif($destination_image, $file_target_file, 100);
										
										break;
											
									} 
									//unlink($file_target_file);
									

									if ($userId > 0) {
										if(isAdmin())
										{
											$insertGallerySql = "INSERT INTO `".TBL_GALLERY."` (`pr_id`, `a_id`, `pr_img`) VALUES ('".$propertyId."', '".$userId."', '".$filename."')";
										}
										else
										{
											$insertGallerySql = "INSERT INTO `".TBL_GALLERY."` (`pr_id`, `u_id`, `pr_img`) VALUES ('".$propertyId."', '".$userId."', '".$filename."')";
										}
										
										insertUpdateRecord($conn, $insertGallerySql);
										$insertId = getInsertId($conn);
										$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Image uploaded.', 'id' => $insertId, 'file_name' => $filename);
									} else {
										setSessionAlertMsg(array('type' => 'danger', 'message' => 'Invalid User.'));
										$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid User.');
									}
								
						}
					} else {
						$formats = implode(',', $fileArray);
						$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. Please upload file with '.$formats.' formats');
					}

				} else {
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.FILESIZE.'MB');
				}

			} else {
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.FILESIZE.'MB');
			}
			echo json_encode($status);
			break;
		case "stsproprty":
			$prpobj=new Mysqlidb(HOST,USER,PWD,DB);
			$prid=$_POST["prid"];
			$stss=$_POST["sts"];
			if($stss==0){$sts=1;}
			if($stss==1){$sts=9;}
			if($stss==9){$sts=1;}
			//echo $_POST["sts"];
			$prpobj->where("pr_id",$prid);
			$prpobj->update("property",Array("pr_status"=>$sts));
			//echo $prpobj->getLastQuery();
			if(!$prpobj->getLastError())
			{
				$status["sts"] = '01';
			}
			else{
				$status["sts"] = '00';
			}
			echo json_encode($status);
			break;
			
		case "addwishlist":
			//print_r($_POST);exit;
			$prid=$_POST["prid"];
			$uid=$_SESSION["UID"];
			$wlid=$_POST["wlid"];
			$wshobj=new Mysqlidb(HOST,USER,PWD,DB);
			if($wlid>0)
			{
				$wshobj->where("wl_id",$wlid);
				$wshobj->delete("wishlist");   
			}else{
				$wsharr=Array("pr_id"=>$prid,"u_id"=>$uid);
				$wshobj->insert("wishlist",$wsharr);  
			}

			if(!$wshobj->getLastError()){
				$status["sts"] = '01';
			}
			else
			{
				$status["sts"] = '00';
			}
			echo json_encode($status);
			break;

		case "delwishlist":
			$wshobj=new Mysqlidb(HOST,USER,PWD,DB);
			$wlid=$_POST["wlid"];    
			$wshobj->where("wl_id",$wlid);
			$wshobj->delete("wishlist");    
			if(!$wshobj->getLastError())
			{
				$status["sts"] = '01';
			}
			else
			{
				$status["sts"] = '00';
			}
			echo json_encode($status);
			break; 
			
		case "resetpwd":
			//print_r($_POST); 
			
			$conn = getDBConnection();
			
			$email = $_POST["txtuser"];
			$pwd = md5($_POST["pwd"]);
			
			if($email!='' && $pwd!="")
			{
				if(insertUpdateRecord($conn, "UPDATE `".TBL_USER."` SET `u_pwd`='".$pwd."' WHERE `u_email`='".$email."'"))
				{
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Password changed successfully.');
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Error while changing password.');
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Invalid details.');
			}
			
			/* 
			$str="1234567890asdfghjklzxcvbnmqwertyuipASDGHJKLZXCVBNMQWERTYUIP";
			for($i=0;$i<=4;$i++)
			{
				$pwd.=substr($str,rand(0,60),1);
			}
			$enpwd=md5($pwd);
			$loginobj=new MysqliDb(HOST,USER,PWD,DB);
			$loginobj->where("u_email",$user);
			$loginarray=$loginobj->getOne('user','*');
			//echo $loginobj->getLastQuery();

			if($loginobj->count)
			{
				$loginobj->where("u_email",$user);
				$loginobj->update('user',Array("u_pwd"=>$enpwd));  
				$status["sts"] = '01';
				$to = "punyaashokkm@gmail.com,$user";
				$subject = "Hai";

				$message = "<!DOCTYPE html><html><head><title>GHARAPNAA</title></head><body style='background-color:#fff;color:#666666;'><div style='max-width:700px margin:auto; '><table style='border-spacing:0;font-family:sans-serif;margin:0 auto;max-width:700px;width:100%; ' align='center'><tbody style='background-color:#181818;color:#fff;'><tr><td style='border-bottom-color:#1b94ff;border-bottom-style:solid;border-bottom-width:2px;padding:0' ><table style='border-spacing:0;font-family:sans-serif' width='100%'><tbody><tr><td ></td></tr><tr><td  style='padding:15px;width:100%' align='center'><a href='' style='color:#0877db'><img src='http://rsquaresolutions.in/gharapnaa/assets/img/logo.png' width='200' height='85'></a></td></tr></tbody></table></td></tr><tr><td  style='padding:0'><p style='font-size:20px;font-weight:bold;line-height:22px;text-transform:none;text-align: center;'>Greeting from GHARAPNAA </p><div style='color: #1b94ff!important;margin-left: 5px;font-size:16px;'>Welcome $fname</div><br><br><div style='font-family: Myriad Pro;font-size: 15px;padding: 15px 15px;margin: auto;'>Your account password has been reset successfully on GHARAPNAA. Please use the below credentials  <a href='".ROOT."' style='color: #c26300;'></a></div><tr><td width='25%' style='padding:10px;text-align:center;' >Your user name:  $user</td></tr><tr><td style='padding:10px;text-align:center; '>Password:  <span style='font-weight:bold'>$pwd </span </td></tr><tr></td></tr></tbody></table></div></body></html>";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <info@gharapnaa.com>' . "\r\n";

				mail($to,$subject,$message,$headers);
			}
			else
			{
				$status["sts"] = '00';    
			} */
			echo json_encode($status);
			break;    
		case "changepwd":
			//print_r($_POST); 
			
			$conn = getDBConnection();
			
			$oPwd = md5(mysqli_real_escape_string($conn, $_POST['oldPwd']));
			$nPwd = md5(mysqli_real_escape_string($conn, $_POST['newPwd']));
			$cPwd = md5(mysqli_real_escape_string($conn, $_POST['confirmPwd']));
			$userId = getUserId();
			
			if($nPwd==$cPwd && $userId>0 && getIsLoggedIn())
			{
				if(isAdmin())
				{
					$selectQuery = "SELECT * FROM ".TBL_EMPLOYEES." WHERE `id`='".$userId."'";
					$userData = (array)getRecordsAssoc($conn, $selectQuery);
					$password = $userData['password'];
					$updateSQl = "UPDATE ".TBL_EMPLOYEES." SET `password`='".$nPwd."' WHERE `id`='".$userId."'";
				}
				else
				{
					$selectQuery = "SELECT * FROM ".TBL_USER." WHERE `u_id`='".$userId."'";
					$userData = (array)getRecordsAssoc($conn, $selectQuery);
					$password = $userData['u_pwd'];
					$updateSQl = "UPDATE ".TBL_USER." SET `u_pwd`='".$nPwd."' WHERE `u_id`='".$userId."'";
				}
				
				if($password==$oPwd)
				{
					insertUpdateRecord($conn, $updateSQl);
					$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Password changed successfully.');
				}
				else
				{
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => "Invalid user password.");
				}
			}
			else
			{
				$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Password Mis-match.');
			}
			
			echo json_encode($status);
			break; 
		case "getlocality":
			$loc=$_POST["locid"];
			$pcat=$_POST["pcat"];
			$prpobj=new Mysqlidb(HOST,USER,PWD,DB);
			$prpobj->where("loc_id",$loc);
			$locltyarr=$prpobj->get("locality",null,"*"); 
			echo json_encode($locltyarr);
			break;
	endswitch;