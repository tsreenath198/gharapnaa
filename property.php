<?php 
	//include("template.php");
	
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	//$conn = getDBConnection();
	
	$notlog = false;
	
	if(!$session->getIsLoggedIn()){
		$notlog = true;
	}
	
	$proarr = array();
	$queryStr = '';
	$actionUrl = ROOT.USER_PROPERTY_LIST;
	$pageNo = (isset($_REQUEST['page'])&&$_REQUEST['page']>0)? $_REQUEST['page'] : 1;
	$sPropertyId = (isset($_REQUEST['sPropertyId'])&&$_REQUEST['sPropertyId']>0)? $_REQUEST['sPropertyId'] : 0;
	$sLocation = (isset($_REQUEST['sLocation'])&&$_REQUEST['sLocation']>0)? $_REQUEST['sLocation'] : 0;
	$sRegCode = (isset($_REQUEST['sRegCode'])&&$_REQUEST['sRegCode']!='')? $_REQUEST['sRegCode'] : '';
	$sFacing = (isset($_REQUEST['sFacing'])&&$_REQUEST['sFacing']!='')? $_REQUEST['sFacing'] : '';
	
	if($session->getUserId()>0)
	{
		if(isset($_REQUEST['doSearch']))
		{
			$pageNo = 1;
		}
		if($sPropertyId>0)
		{
			$queryStr .= " AND `pr`.`pr_cat`='".$sPropertyId."' ";
		}
		if($sLocation>0)
		{
			$queryStr .= " AND `pr`.`pr_location`='".$sLocation."' ";
		}
		if($sRegCode!='')
		{
			$queryStr .= " AND `pr`.`pr_reg_code`='".$sRegCode."' ";
		}
		if($sFacing!='')
		{
			$queryStr .= " AND `pr`.`pr_facing`='".$sFacing."' ";
		}
		/* ==== For Pagination ==== */
		$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
		
		$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_PROPERTY."` `pr` WHERE  `pr`.`pr_status`=1 ".$queryStr." AND `pr`.`u_id` = '".$session->getUserId()."'");
		$totalRecords = $countResult['totalRecords'];
		
		$searchCriteria = array(
			array('name' => 'sPropertyId', 'value' => $sPropertyId),
			array('name' => 'sLocation', 'value' => $sLocation),
			array('name' => 'sRegCode', 'value' => $sRegCode),
			array('name' => 'sFacing', 'value' => $sFacing)
		);
		$paginationArry = array(
			'pageNo' => $pageNo, 
			'pageLimit' => PAGES_LIMIT, 
			'recordsLimit' => RECORDS_LIMIT, 
			'totalRecords' => $totalRecords,
			'baseUrl' => $actionUrl
		);
		
		/* ==== For Pagination ==== */
	
		$proarr = $db->getRecordsArray("SELECT `pr`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`pr`.`pr_id` WHERE  `pr`.`pr_status`=1 AND `pr`.`u_id` = '".$session->getUserId()."' ".$queryStr." GROUP BY `pr`.`pr_id` ORDER BY `pr`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);
		
		//echo "SELECT `pr`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`pr`.`pr_id` WHERE  `pr`.`pr_status`=1 AND `pr`.`u_id` = '".getUserId()."' ".$queryStr." GROUP BY `pr`.`pr_id` ORDER BY `pr`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
		
		//echo "SELECT COUNT(*) `totalRecords` FROM `".TBL_PROPERTY."` WHERE  `pr_status`=1 ".$searchPara." AND `u_id` = '".getUserId()."'";
		//echo "SELECT `pr`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`pr`.`pr_id` WHERE  `pr`.`pr_status`=1 AND `pr`.`u_id` = '".getUserId()."' ".$searchPara." GROUP BY `pr`.`pr_id` ORDER BY `pr`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
		//echo "SELECT `pr`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pr`.`pr_id`=`pg`.`pr_id` WHERE `pr`.`u_id` = '".getUserId()."' GROUP BY `prid` ORDER BY `pr`.`pr_id` DESC";
	}
	
	//echo "SELECT `pr`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`pr`.`pr_id` WHERE `pr`.`u_id` = '".getUserId()."' ORDER BY `pr`.`pr_id` DESC";
	
	//head();
?>
<!-- ============================================================== -->
<?php include_once("header.php"); ?>
<!-- ============================ Page Title Start================================== -->
	<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT; ?>assets/img/slider-5.jpg);" data-overlay="5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="breadcrumbs-wrap">
						<ol class="breadcrumb">
							<li class="breadcrumb-item active" aria-current="page">My Properties</li>
						</ol>
						<h2 class="breadcrumb-title"> My All Properties </h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ User Dashboard ================================== -->
	<section class="gray pt-3 pb-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-12 py-2">
					<?php include_once("sidebar.php"); ?>
				</div>
				<div class="col-lg-9 col-md-8 col-sm-12 py-2">
					<?php include_once("templates/properties-list-page.php");?>
				</div>
			</div>
		</div>
	</section>
<!-- ============================ User Dashboard End ================================== -->
<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<?php include_once("footer.php"); ?>