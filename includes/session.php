<?php
	class Session 
	{
		/* ====== Session Data Set ==== */
		function setUserSession($data)
		{
			$_SESSION["UID"] =  $data['id'];
			$_SESSION["UNAME"] = $data['name'];
			$_SESSION["UEMAIL"] =  $data['email'];
			$_SESSION["UMOB"] =  $data['phone'];
			$_SESSION["ISADMIN"]=  $data['is_admin'];
			$_SESSION["UTYPE"]=  $data['utype'];
			$_SESSION["LOGINTYPE"]=  $data['login_type'];
			$_SESSION["UROLE"]=  $data['urole'];
			$_SESSION["ISLOGGEDIN"]=  true;
			$_SESSION["USERID"] =  $data["user_id"];
			$_SESSION["DIRECTORY"] =  $data["directory"];
			$_SESSION["DISPLAYNAME"] =  $data["display_name"];
			/* $_SESSION["PROFILEID"] =  $data["profile_id"]; */
			$_SESSION["PROFILEPIC"] =  $data["profile_pic"];
		}
		/* ====== Session Data Set ==== */
		
		function isTeamLead()
		{
			$role = $this->getUserRole();
			return ($role==1 || $role=='1')? true : false;
		}
		function getLoadView()
		{
			$dapartment = $this->getUserDepartment();
			$view = ADMIN_LOGOUT;
			
			switch($dapartment)
			{
				case '1':
					$view = MASTER_ADMIN_DASHBOARD;
					break;
				case '2':
					$view = MARKETING_DASHBOARD;
					break;
				case '3':
					$view = SALES_DASHBOARD;
					break;
			}
			return $view;
		}
		/* ====== GET Display Name ======= */
		function isEmployeeLoggedin()
		{
			return (isset($_SESSION["LOGINTYPE"]) && $_SESSION["LOGINTYPE"]=='employee')? true : false;
		}
		/* ====== GET Display Name ======= */
		
		/* ====== Set Profile Pic ===== */
		function setProfilePic($fileName='')
		{
			if($fileName!='')
			{
				$_SESSION["PROFILEPIC"] = $fileName;
			}
		}
		/* ====== Set Profile Pic ===== */
		/* ====== GET Profile Pic ======= */
		function getProfilePic()
		{
			return (isset($_SESSION["PROFILEPIC"]) && $_SESSION["PROFILEPIC"]!='')? $_SESSION["PROFILEPIC"] : '';
		}
		/* ====== GET Profile Pic ======= */
		
		/* ====== Set Display Name ===== */
		function setDisplayName($displayName='')
		{
			if($displayName!='')
			{
				$_SESSION["DISPLAYNAME"] = $displayName;
			}
		}
		/* ====== Set Display Name ===== */
		
		/* ====== GET Display Name ======= */
		function getDisplayName()
		{
			return (isset($_SESSION["DISPLAYNAME"]) && $_SESSION["DISPLAYNAME"]!='')? $_SESSION["DISPLAYNAME"] : '';
		}
		/* ====== GET Display Name ======= */
		/* ====== GET Profile Id ======= */
		function getProfileId()
		{
			return (isset($_SESSION["PROFILEID"]) && $_SESSION["PROFILEID"]>0)? $_SESSION["PROFILEID"] : 0;
		}
		/* ====== GET Profile Id ======= */
		/* ====== GET Directory ======= */
		function getUserDirectory()
		{
			return (isset($_SESSION["DIRECTORY"]) && $_SESSION["DIRECTORY"]!='')? $_SESSION["DIRECTORY"] : '';
		}
		/* ====== GET Directory ======= */
		
		/* ====== GET Department ======= */
		function getUserDepartment()
		{
			return (isset($_SESSION["UTYPE"]) && $_SESSION["UTYPE"]>0)? $_SESSION["UTYPE"] : 0;
		}
		/* ====== GET Department ======= */
		/* ====== GET Role ======= */
		function getUserRole()
		{
			return (isset($_SESSION["UROLE"]) && $_SESSION["UROLE"]>0)? $_SESSION["UROLE"] : 0;
		}
		/* ====== GET Role======= */
	
		/* ====== Session Clear ==== */
		function clearSession()
		{
			session_destroy();
		}
		/* ====== Session Clear ==== */

		/* ====== Get Seesion UserId == ==== */
		function getUserId()
		{
			return (isset($_SESSION["UID"]) && $_SESSION["UID"]>0)? $_SESSION["UID"] : 0;
		}
		/* ====== Get Seesion UserId == ==== */

		/* ====== Get Seesion User Name == ==== */
		function getUserName()
		{
			return (isset($_SESSION["UNAME"]) && $_SESSION["UNAME"]!='')? $_SESSION["UNAME"] : '';
		}
		/* ====== Get Seesion User Name == ==== */
	
		/* ===== Get User Email ======= */
		function getUserEmail()
		{
			return (isset($_SESSION["UEMAIL"]) && $_SESSION["UEMAIL"]!='')? $_SESSION["UEMAIL"] : '';
		}
		/* ===== Get User Email ======= */
	
		/* ====== Get Seesion User Mobile == ==== */
		function getUserMobile()
		{
			return (isset($_SESSION["UMOB"]) && $_SESSION["UMOB"]!='')? $_SESSION["UMOB"] : '';
		}
		/* ====== Get Seesion User Mobile == ==== */

		/* ====== Get Seesion Login Check == ==== */
		function getIsLoggedIn()
		{
			return (isset($_SESSION["ISLOGGEDIN"]) && ($_SESSION["ISLOGGEDIN"]==true || $_SESSION["ISLOGGEDIN"]=='true'))? true : false;
		}
		/* ====== Get Seesion Login Check == ==== */
	
	
		/* ====== Is Admin Check == ==== */
		function isAdmin()
		{
			return (isset($_SESSION["ISADMIN"]) && ($_SESSION["ISADMIN"]==true || $_SESSION["ISADMIN"]=='true'))? true : false;
		}
		/* ====== Is Admin Check == ==== */
		
		function isMaster()
		{
			$department = $this->getUserDepartment();
			return ($department==1 || $department=='1')? true : false;
		}


		/* ====== set OTP ==== */
		function setSessionOTP($otp)
		{
			$_SESSION["OTP"] =  $otp;
			$_SESSION["OTPDATE"] =  date('Y-m-d H:i:s', strtotime('+3 minutes', strtotime(date('Y-m-d H:i:s'))));
		}
		/* ====== set OTP ==== */

		/* ====== get OTP ==== */
		function getSessionOTP()
		{
			return (isset($_SESSION["OTP"]) && $_SESSION["OTP"]!='')? $_SESSION["OTP"] : '';
		}
		/* ====== get OTP ==== */
	
		/* ====== get OTP ==== */
		function getSessionOTPDate()
		{
			return (isset($_SESSION["OTPDATE"]) && $_SESSION["OTPDATE"]!='')? $_SESSION["OTPDATE"] : null;
		}
		/* ====== get OTP ==== */

		/* ====== clear OTP ==== */
		function clearSessionOTP()
		{
			$_SESSION["OTP"] =  '';
			$_SESSION["OTPDATE"] =  null;
		}
		/* ====== clear OTP ==== */

		/* ======= Set Alert Messages ======= */
		function setSessionAlertMsg($msgArray=array())
		{
			$_SESSION['alertMsg'] = $msgArray;
		}
		/* ======= Set Alert Messages ======= */
	
		/* ======= Get Alert Messages ======= */
		function getSessionAlertMsg()
		{
			return (isset($_SESSION['alertMsg']) && count($_SESSION['alertMsg'])>0)? $_SESSION['alertMsg'] : array();
		}
		/* ======= Get Alert Messages ======= */
		/* ======= Clear Alert Messages ======= */
		function clearSessionAlertMsg()
		{
			$this->setSessionAlertMsg(array());
		}
		/* ======= Clear Alert Messages ======= */
	}
?>