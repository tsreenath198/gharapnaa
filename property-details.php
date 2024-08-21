<?php 

	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	/* if(!getIsLoggedIn())
	{
		header("Location: ".$siteUrl);
		die();
	} */
	/* $conn = getDBConnection(); */
	$prid=$_GET["prid"];;
	/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
	$prpobj->where("pr_id",$prid);
	$prop=$prpobj->getOne("property","*"); */
	
	if($prid<=0){
		header("location:".ROOT);
		die();
	}
	
	$prop = $db->getSingleRowArray("SELECT `tp`.*, `tu`.`u_name` `AgentName`, `tu`.`u_email` `AgentEmail`, `tu`.`u_phone` `AgentPhone` FROM `".TBL_PROPERTY."` `tp` LEFT JOIN `".TBL_USER."` `tu` ON `tu`.`u_id`=`tp`.`u_id` WHERE  `tp`.`pr_status`=1 AND `tp`.`pr_id`=".$prid."");

?>
<!-- ============================================================== -->
<?php include_once("header.php"); ?>
<!-- ============================ Hero Banner  Start================================== -->
	<?php include_once("templates/property-details-page.php"); ?>

<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<?php include_once("footer.php"); ?>
