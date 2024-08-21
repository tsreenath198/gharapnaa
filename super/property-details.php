<?php 

	include("../includes/config.php");
	/* include("../includes/connection.php");
	include("../includes/queries.php");
	include("../includes/functions.php");
	include("../includes/MysqliDb.php");
	include("../includes/session.php"); */
	
	if(!$session->getIsLoggedIn() || !$session->isAdmin()){
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	$prid = (isset($_GET["prid"])&&$_GET["prid"]>0)? $_GET["prid"] : 0;
	
	/* $conn = getDBConnection(); */
	//$prpobj=new Mysqlidb(HOST,USER,PWD,DB);
	//$prpobj->where("pr_id",$prid);
	//$prop=$prpobj->getOne("property","*");
	
	$propDetails = $db->getSingleRowArray("SELECT * FROM `".TBL_PROPERTY."` `tp` WHERE  `tp`.`pr_status`=1 AND `tp`.`pr_id`=".$prid."");
	
	if($propDetails['a_id']>0)
	{
		$prop = $db->getSingleRowArray("SELECT `tp`.*, `te`.`display_name` `AgentName`, `te`.`email` `AgentEmail`, `te`.`phone` `AgentPhone` FROM `".TBL_PROPERTY."` `tp` LEFT JOIN `".TBL_EMPLOYEES."` `te` ON `te`.`id`=`tp`.`a_id` WHERE  `tp`.`pr_status`=1 AND `tp`.`pr_id`=".$prid."");
	}
	else
	{
		$prop = $db->getSingleRowArray("SELECT `tp`.*, `tu`.`u_name` `AgentName`, `tu`.`u_email` `AgentEmail`, `tu`.`u_phone` `AgentPhone` FROM `".TBL_PROPERTY."` `tp` LEFT JOIN `".TBL_USER."` `tu` ON `tu`.`u_id`=`tp`.`u_id` WHERE  `tp`.`pr_status`=1 AND `tp`.`pr_id`=".$prid."");
	}

?>
<!-- ============================================================== -->
<?php include_once("../header.php"); ?>
<!-- ============================ Hero Banner  Start================================== -->
	<?php include_once("../templates/property-details-page.php"); ?>

<!-- ============================ Call To Action ================================== -->
<?php include_once("../call-to-action.php"); ?>
<?php include_once("../footer.php"); ?>
