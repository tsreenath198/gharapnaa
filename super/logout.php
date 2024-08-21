<?php
	include("../includes/config.php");
	/* include("../includes/functions.php");
	include("../includes/session.php"); */
	$session->clearSession();
	//echo $adminUrl;
	//die();
	header("location:".$adminUrl);
	die();
	
?>