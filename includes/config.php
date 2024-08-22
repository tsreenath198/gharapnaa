<?php

	session_start();
	ob_start();

	/* define("ROOT",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/ga/'); */
	define("ROOT",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/');
	
	$currentSlug = '';
	$randNumber = rand(1111,9999);
	date_default_timezone_set('Asia/Calcutta');
	
	$https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')? 'https://' : 'http://';
	$hostName = ($_SERVER['HTTP_HOST']!='localhost:8888')? $_SERVER['HTTP_HOST'] : 'localhost:8888/ga';
	$siteUrl = $https.$hostName.'/';
	$adminUrl = $https.$hostName.'/super/';
	$currentUrl = $https.$hostName.$_SERVER['REQUEST_URI'];
	
	$requestURI = ($_SERVER['HTTP_HOST']!='localhost:8888')? substr($_SERVER['REQUEST_URI'], 1) : str_replace("/ga/", "", $_SERVER['REQUEST_URI']);
	

	define("FILE_SIZE", "2048000");
	define("FILESIZE", "2048000");
	define("DIR", $_SERVER["DOCUMENT_ROOT"]."/ga/");
	define("ADMINROOT",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/ga/');
	define("SMSUSER", "");
	define("SENDEID", "");

	if($_SERVER['HTTP_HOST']=='gharapnaa.com' || $_SERVER['HTTP_HOST']=='www.gharapnaa.com')
	{
		define("IS_PROD", 1);
		define("RECORDS_LIMIT", 30);
		define("HOST_NAME", "localhost");
		define("HOST_USER","gharapnaa_user");
		define("HOST_DB_NAME","gharapnaa");
		define("HOST_PWD","gharapnaa!@#4");
	}
	else
	{
		define("IS_PROD", 0);
		define("RECORDS_LIMIT", 10);
		define("HOST_NAME", "192.185.129.64");
		define("HOST_USER","uskcorpi_gharapnaa");
		define("HOST_DB_NAME","uskcorpi_gharapnaa");
		define("HOST_PWD","Infosys@123");
	}

	define("TOTAL_PAGES", 0);
	define("RECORDS", 0);
	define("PAGES_LIMIT", 5);
	
	define('SITE_URL', $siteUrl);
	define('RAND_NUM', rand(1111,9999));
	define('ADMIN_URL', $adminUrl);
	define('CURRECT_URL', $currentUrl);
	
define("AJAX_UPLOAD_PATH", '../uploads/images/');
	define("USER_UPLOAD_PATH", 'uploads/images/');
	define("ADMIN_UPLOAD_PATH", '../uploads/images/');

	define("UPLOAD_PATH", 'uploads/');
	define("PR_UPLOAD_PATH", 'uploads/images');
	define("AJAX_UPLOAD_FILE_PATH", '../uploads/');

	define("EMP_PROFILE_PATH", 'emp-profile/');
	define("USER_PROFILE_PATH", 'user-profile/');
	
	/* define("EMP_PROFILE_PATH", 'emp-profile/');
	define("USER_PROFILE_PATH", 'user-profile/'); */



	/* ===== Tables ==== */
	define("TBL_DISTRICTS", "districts");
	define("TBL_STATES", "states");
	define("TBL_PROPERTY", "property");
	define("TBL_CONTACTS", "contacts");
	define("TBL_GALLERY", "property_gallery");
	define("TBL_LOCATIONS", "locations");
	define("TBL_WISHLIST", "wishlist");
	define("TBL_ENQUIRIES", "enquiries");

	define("TBL_USER", "user");
	define("TBL_LOCALITY", "locality");
	define("TBL_LOGIN_USER", "login_user");
	define("TBL_LOGIN", "login");
	define("TBL_EMPLOYEES", "employees");

	define("TBL_ACTIVITIES", "activities");
	define("TBL_REMINDERS", "reminders");
	define("TBL_LEADS", "leads");
	define("TBL_ALERTS", "alerts");
	/* ===== Tables ==== */

	define("USER_PROFILE", "my-profile/");
	define("USER_PROPERTY_EDIT", "property-edit/");
	define("USER_LOGOUT", "logout/");

	define("CITY_ADD", "super/add-city/");
	define("CITY_EDIT", "super/edit-city/");
	define("CITY_LIST", "super/cities/");
	define("ADMIN_PROPERTY_EDIT", "super/property-edit/");
	define("ADMIN_PROFILE", "super/dashboard/");
	define("ADMIN_LOGOUT", "super/logout/");


	define("USER_PROPERTY_LIST", "property/");
	define("USER_PR_DETAILS", "property-details/");
	define("USER_PR_BUY", "property-list/");
	define("USER_FEATURED_APART", "featured/apartment/");
	define("USER_FEATURED_HOME", "featured/independent/");
	define("USER_FEATURED_PLOT", "featured/plot/");
	define("USER_FEATURED_VILLA", "featured/villa/");
	define("USER_FEATURED_AGRI_LAND", "featured/agriculture/");


	define("ADMIN_PR_DETAILS", "super/property-details/");
	define("ADMIN_PR_BUY", "super/buy/");
	define("ADMIN_FEATURED_APART", "super/featured/apartment/");
	define("ADMIN_FEATURED_HOME", "super/featured/independent/");
	define("ADMIN_FEATURED_PLOT", "super/featured/plot/");
	define("ADMIN_FEATURED_VILLA", "super/featured/villa/");
	define("ADMIN_FEATURED_AGRI_LAND", "super/featured/agriculture/");
	define("ADMIN_PROPERTY_ENQUIRIES", "super/property-enquiries/");
	define("ADMIN_ENQUIRIES", "super/enquiries/");
	define("ADMIN_USERS", "super/users/");
	define("ADMIN_PROPERTY_LIST", "super/property/");
	define("ADMIN_PR_ALL", "super/properties/all/");
	define("ADMIN_PR_ACTIVE", "super/properties/active/");
	define("ADMIN_PR_IN_ACTIVE", "super/properties/inactive/");
	define("ADMIN_PR_PUBLISH", "super/properties/publish/");
	define("ADMIN_PR_UN_PUBLISH", "super/properties/unpublish/");
	define("ADMIN_APART_LIST", "super/apartment/");
	define("ADMIN_HOME_LIST", "super/independent/");
	define("ADMIN_PLOT_LIST", "super/plot/");
	define("ADMIN_VILLA_LIST", "super/villa/");
	define("ADMIN_AGRI_LAND_LIST", "super/agriculture/");
	define("ADMIN_REMINDER_LIST", "super/reminders-list/");
	define("EQ_ACTIVITY_REPORT", "super/reports/enquiry-activity-report/");
	define("PR_ACTIVITY_REPORT", "super/reports/property-activity-report/");
	
	define("ADD_EMPLOYEE", "super/add-employee/");
	define("EDIT_EMPLOYEE", "super/edit-employee/");

	define("LIST_EMPLOYEE", "super/employees/");

	define("COMPANY_MAIL", "sales@gharapnaa.com");
	define("COMPANY_PHONE", "+01 215 245 6258");

	define("ADD_CONTACT_ACTIVITY", "super/add-contact-activity/");
	define("ADD_PROPERTY_ACTIVITY", "super/add-property-activity/");
	
	
	define("MASTER_ADMIN_DASHBOARD", "super/masteradmin/dashboard/");
	define("SALES_DASHBOARD", "super/sales/dashboard/");
	define("MARKETING_DASHBOARD", "super/marketing/dashboard/");
	
	define("ADMIN_PR_PENDING", "super/properties/pending/");
	
	define("USER_CHANGE_PWD", "change-password/");
	define("EMP_CHANGE_PWD", "super/change-password/");
	define("EMP_PROFILE", "super/my-profile/");

	
	$ROLESARR = array('1' => 'Admin', '2' => 'User');
	$IWANTARR = array("1" => "Owner", "2" => "Agent", "3" => "Builder");
	$CONST_STATUS = array("1" => "Ready to Move", "2" => "Under Construction");
	$POSS_STATUS = array("1" => "Immediate", "2" => "Future");
	$BHK = array();
	$BATHROOMS = $BALCONY = $COVERED_PARKING = $OPEN_PARKING = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	$FURNISH_TYPE = array("1" => "Fully Furnished", "2" => "Semi Furnished", "3" => "Unfurnished");

	$FACARR = array("1"=>"North", "2"=>"East", "3"=>"West", "4"=>"South", "5"=>"North-East", "6"=>"North-West", "7"=>"South-East", "8"=>"South-West");

	$CATARR = array("1"=>"Apartment", "2"=>"Independent Home", "4"=>"Villas", "3"=>"Plot", "5"=>"Agriculture Land");
	$ROAD_TYPES = array("1"=>"Clay Road", "2"=>"Concrete Road", "3"=>"Thor Road", "4"=>"No Road");

	$BHKARR = array("1 RK", "1 BHK", "2 BHK", "3 BHK", "4 BHK", "5 BHK", "6 BHK", "7 BHK", "8 BHK", "9 BHK", "10 BHK");
	$UNITARR = array("Sq. Yd.", "Acres", "Gunthas");
	$DEPARTMENTARR = array('1' => 'Admin', '2' => 'Marketing', '3' => 'Sales');
	$ROLEARR = array('1' => 'Team Lead', '2' => 'Team Member');
	$RATING_ARR = array('1' => 'Hot', '2' => 'Warm', '3' => 'Cold', '4' => 'Dead', '5' => 'Completed');

	$AMNTARR = array(
		array("id"=>"1", "name"=>"Dining Table", "ikon" => "dinner-table.png"),
		array("id"=>"2", "name"=>"Washing Machine", "ikon" => "washing-machine.png"),
		array("id"=>"3", "name"=>"Sofa", "ikon" => "sofa.png"),
		array("id"=>"4", "name"=>"Microwave", "ikon" => "microwave.png"),
		array("id"=>"5", "name"=>"Stove", "ikon" => "gas-stove.png"),
		array("id"=>"6", "name"=>"Water Purifier", "ikon" => "filtration.png"),
		array("id"=>"7", "name"=>"Gas Pipeline", "ikon" => "gas-pipeline.png"),
		array("id"=>"8", "name"=>"AC", "ikon" => "ac.png"),
		array("id"=>"9", "name"=>"Bed", "ikon" => "bed.png"),
		array("id"=>"10", "name"=>"TV", "ikon" => "tv.png"),
		array("id"=>"11", "name"=>"Cupboard", "ikon" => "cupboard.png"),
		array("id"=>"12", "name"=>"Geyser", "ikon" => "water-heater.png")
	);

	$SOAMNTARR = array(
		array("id"=>"1", "name"=>"Lift", "ikon" => "elevator.png"),
		array("id"=>"2", "name"=>"CCTV", "ikon" => "security-camera.png"),
		array("id"=>"3", "name"=>"Gym", "ikon" => "dumbbell.png"),
		array("id"=>"4", "name"=>"Garden", "ikon" => "gardening.png"),
		array("id"=>"5", "name"=>"Kids Area", "ikon" => "playground.png"),
		array("id"=>"6", "name"=>"Sports", "ikon" => "cricket.png"),
		array("id"=>"7", "name"=>"Swimming Pool", "ikon" => "pool.png"),
		array("id"=>"8", "name"=>"Interoom", "ikon" => "phone-call2.png"),
		array("id"=>"9", "name"=>"Gated Community", "ikon" => "gate.png"),
		array("id"=>"10", "name"=>"Club House", "ikon" => "golf-club.png"),
		array("id"=>"11", "name"=>"Community Hall", "ikon" => "town-hall.png"),
		array("id"=>"12", "name"=>"Water Supply", "ikon" => "water-faucet.png"),
		array("id"=>"13", "name"=>"Power Backup", "ikon" => "power.png"),
		array("id"=>"14", "name"=>"Pet Allowed", "ikon" => "dog.png")
	);

	$NAV_ITEMS = array(
		array('link' => '', 'name' => 'Home', 'class' => ''),
		array('link' => 'property-list/', 'name' => 'Buy', 'class' => ''),
		array('link' => 'about-us/', 'name' => 'About', 'class' => ''),
		array('link' => 'contact/', 'name' => 'Contact Us', 'class' => ''),
		array('link' => 'add-property/', 'name' => '<i class="fas fa-plus-circle mr-1"></i>Add Free listing', 'class' => 'theme-cl btn-class')
	);

	$ADMIN_NAV_ITEMS = array(
		array('link' => 'super/dashboard/', 'name' => 'Dashboard', 'class' => ''),
		array('link' => '', 'name' => 'Home', 'class' => ''),
		array('link' => 'super/buy/', 'name' => 'Buy', 'class' => ''),
		array('link' => 'super/add-property/', 'name' => '<i class="fas fa-plus-circle mr-1"></i>Add Free listing', 'class' => 'theme-cl btn-class')
	);

	$SIDEBAR_ITEMS = array(
		/* array('link' => 'my-profile/', 'name' => '<i class="fa fa-user-tie"></i>My Profile', 'class' => '', 'ikon' => ''), */
		array('link' => 'property/1/', 'name' => '<i class="fa fa-tasks"></i>My Properties', 'class' => '', 'ikon' => ''),
		array('link' => 'wishlist/', 'name' => '<i class="fa fa-heart"></i>My Wishlist', 'class' => '', 'ikon' => ''),
		array('link' => 'add-property/', 'name' => '<i class="fa fa-pen-nib"></i>Submit New Property', 'class' => '', 'ikon' => '')
		/* array('link' => 'leads', 'name' => '<i class="fa fa-envelope"></i>Leads', 'class' => '', 'ikon' => ''), */
		/* array('link' => 'change-password/', 'name' => '<i class="fa fa-unlock-alt"></i>Change Password', 'class' => '', 'ikon' => '') */
	);

	$ADMIN_SIDEBAR_ITEMS = array(
		/* array('link' => 'super/my-profile/', 'name' => '<i class="fa fa-user-tie"></i>My Profile', 'class' => '', 'ikon' => ''), */
		array('link' => 'super/properties/active/1/', 'name' => '<i class="fa fa-tasks"></i>Properties', 'class' => '', 'ikon' => ''),
		/*array('link' => 'super/apartment/1/', 'name' => '<i class="fa fa-tasks"></i>Apartments', 'class' => '', 'ikon' => ''),
		array('link' => 'super/independent/1/', 'name' => '<i class="fa fa-tasks"></i>Independent Home', 'class' => '', 'ikon' => ''),
		array('link' => 'super/villa/1/', 'name' => '<i class="fa fa-tasks"></i>Villa', 'class' => '', 'ikon' => ''),
		array('link' => 'super/plot/1/', 'name' => '<i class="fa fa-tasks"></i>Plot', 'class' => '', 'ikon' => ''),
		array('link' => 'super/agriculture/1/', 'name' => '<i class="fa fa-tasks"></i>Agriculture Land', 'class' => '', 'ikon' => ''),*/
		//array('link' => 'add-property', 'name' => '<i class="fa fa-pen-nib"></i>Submit New Property', 'class' => '', 'ikon' => ''),
		array('link' => 'super/enquiries/1/', 'name' => '<i class="fa fa-envelope"></i>Enquiries', 'class' => '', 'ikon' => ''),
		array('link' => 'super/property-enquiries/1/', 'name' => '<i class="fa fa-envelope"></i>Property Enquiries', 'class' => '', 'ikon' => ''),
		array('link' => 'super/users/1/', 'name' => '<i class="fa fa-user"></i>Users', 'class' => '', 'ikon' => ''),
		array('link' => 'super/employees/1/', 'name' => '<i class="fa fa-user"></i>Employees', 'class' => '', 'ikon' => ''),
		array('link' => 'super/cities/1/', 'name' => '<i class="fa fa-map-marker-alt"></i>Cities', 'class' => '', 'ikon' => ''),
		array('link' => 'super/reminders-list/enquiry/', 'name' => '<i class="fa fa-clock"></i>Reminders', 'class' => '', 'ikon' => ''),
		array('link' => 'super/reports/enquiry-activity-report/1/', 'name' => '<i class="fa fa-list-alt"></i>Reports', 'class' => '', 'ikon' => '')
		/* array('link' => 'super/change-password/', 'name' => '<i class="fa fa-unlock-alt"></i>Change Password', 'class' => '', 'ikon' => '') */
	);
	
	$EMP_SIDEBAR_ITEMS = array(
		array('link' => 'super/property/1/', 'name' => '<i class="fa fa-tasks"></i>Properties', 'class' => '', 'ikon' => ''),
		array('link' => 'super/enquiries/1/', 'name' => '<i class="fa fa-envelope"></i>Enquiries', 'class' => '', 'ikon' => ''),
		array('link' => 'super/property-enquiries/1/', 'name' => '<i class="fa fa-envelope"></i>Property Enquiries', 'class' => '', 'ikon' => ''),
		array('link' => 'super/reminders-list/enquiry/', 'name' => '<i class="fa fa-clock"></i>Reminders', 'class' => '', 'ikon' => '')
	);

	ini_set("display_errors", 1);
	ini_set("track_errors", 1);
	ini_set("html_errors", 1);
	error_reporting(E_ALL);
	/* error_reporting(E_ALL & ~E_NOTICE); */

	require_once("functions.php");
	require_once("queries.php");
	require_once("session.php");
	require_once("validation.php");
	global $session, $db, $function;
	$function = new CommonFunctions();
	$db = new Queries();
	$session = new Session();
	$validation = new Validation();
	
	$db_conn_vars = array(
		"dbhost" => HOST_NAME,
		"dbuser" => HOST_USER,
		"dbpass" => HOST_PWD,
		"dbname" => HOST_DB_NAME
	);

	$db->setConnection($db_conn_vars);

?>