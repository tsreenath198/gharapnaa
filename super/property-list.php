<?php /* include("../template.php");
ini_set("display_errors",0);
if(!$_SESSION["LOGGED"]){
header("location:".ROOT."super/");

} */

	include("../includes/config.php");
	/* include("../includes/connection.php");
	include("../includes/queries.php");
	include("../includes/functions.php");
	include("../includes/MysqliDb.php");
	include("../includes/session.php"); */
	
	/* $conn = getDBConnection(); */
	
	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	$isEnableType = false;
	$status = (isset($_REQUEST["status"])&&$_REQUEST["status"]!='')? $_REQUEST["status"] : '';
	$publish = (isset($_REQUEST["publish"])&&$_REQUEST["publish"]!='')? $_REQUEST["publish"] : '';
	$type = (isset($_REQUEST["type"])&&$_REQUEST["type"]!='')? $_REQUEST["type"] : 'active';
	
	
	$searchCriteria = array();
	$price_from_min = $area_from_min = $plot_price_from_min = $plot_area_from_min = $price_to_max = $area_to_max = $plot_price_to_max = $plot_area_to_max = $al_area_from_min = $al_area_to_max = '';
	$sBHK = $sFacing = $sFurnishType = $sCStatus = $sRegCode = $sRoadType = '';
	$sBath = $sBolcony = $sCparking = $sOparking = '-1';
	
	$cat = $sPropertyId = (isset($_REQUEST["cat"]) && $_REQUEST["cat"]>0)? $_REQUEST["cat"] : ((isset($_REQUEST["sPropertyId"]) && $_REQUEST["sPropertyId"]>0)? $_REQUEST["sPropertyId"] : 0);
	$para =  $queryStr = '';
	$slug = ADMIN_PROPERTY_LIST;
	
	if($type!='')
	{
		switch($type)
		{
			case 'all':
				$status = '';
				break;
			case 'in-active':
				$status = '0';
				break;
			case 'active':
			case 'published':
			case 'un-published':
			case 'pending':
				$status = '1';
				break;
			default:
				$status = '1';
				break;
		}
	}
	if($cat>0)
	{
		$isEnableType = true;
		$para .= " AND `tp`.`pr_cat`='".$cat."' AND `tp`.`pr_status`=1 " ;
		switch($cat)
		{
			case 1:
				$slug = ADMIN_APART_LIST;
				break;
			case 2:
				$slug = ADMIN_HOME_LIST;
				break;
			case 3:
				$slug = ADMIN_PLOT_LIST;
				break;
			case 4:
				$slug = ADMIN_VILLA_LIST;
				break;
			case 5:
				$slug = ADMIN_AGRI_LAND_LIST;
				break;
			default:
				$slug = ADMIN_APART_LIST;
				break;
		}
	}
	$actionUrl = ROOT.$slug;
	
	$pageNo = (isset($_REQUEST['page'])&&$_REQUEST['page']>0)? $_REQUEST['page'] : 1;
	$sLocation = (isset($_REQUEST['sLocation'])&&$_REQUEST['sLocation']>0)? $_REQUEST['sLocation'] : 0;
	
	$price_from_min = (isset($_REQUEST["price_from_min"]) && $_REQUEST["price_from_min"]!='')? $_REQUEST["price_from_min"] : '';
	$area_from_min = (isset($_REQUEST["area_from_min"]) && $_REQUEST["area_from_min"]!='')? $_REQUEST["area_from_min"] : '';
	$plot_price_from_min = (isset($_REQUEST["plot_price_from_min"]) && $_REQUEST["plot_price_from_min"]!='')? $_REQUEST["plot_price_from_min"] : '';
	$plot_area_from_min = (isset($_REQUEST["plot_area_from_min"]) && $_REQUEST["plot_area_from_min"]!='')? $_REQUEST["plot_area_from_min"] : '';
	$al_area_from_min = (isset($_REQUEST["al_area_from_min"]) && $_REQUEST["al_area_from_min"]!='')? $_REQUEST["al_area_from_min"] : '';
	
	$price_to_max = (isset($_REQUEST["price_to_max"]) && $_REQUEST["price_to_max"]!='')? $_REQUEST["price_to_max"] : '';
	$area_to_max = (isset($_REQUEST["area_to_max"]) && $_REQUEST["area_to_max"]!='')? $_REQUEST["area_to_max"] : '';
	$plot_price_to_max = (isset($_REQUEST["plot_price_to_max"]) && $_REQUEST["plot_price_to_max"]!='')? $_REQUEST["plot_price_to_max"] : '';
	$plot_area_to_max = (isset($_REQUEST["plot_area_to_max"]) && $_REQUEST["plot_area_to_max"]!='')? $_REQUEST["plot_area_to_max"] : '';
	$al_area_to_max = (isset($_REQUEST["al_area_to_max"]) && $_REQUEST["al_area_to_max"]!='')? $_REQUEST["al_area_to_max"] : '';
	/* =========== 21-01-2021 ========== */
	
	$sBath = (isset($_REQUEST["sBath"]) && $_REQUEST["sBath"]!='')? $_REQUEST["sBath"] : '-1';
	$sBolcony = (isset($_REQUEST["sBolcony"]) && $_REQUEST["sBolcony"]!='')? $_REQUEST["sBolcony"] : '-1';
	$sCparking = (isset($_REQUEST["sCparking"]) && $_REQUEST["sCparking"]!='')? $_REQUEST["sCparking"] : '-1';
	$sOparking = (isset($_REQUEST["sOparking"]) && $_REQUEST["sOparking"]!='')? $_REQUEST["sOparking"] : '-1';
	
	$sBHK = (isset($_REQUEST["sBHK"]) && $_REQUEST["sBHK"]!='')? $_REQUEST["sBHK"] : '';
	$sFacing = (isset($_REQUEST["sFacing"]) && $_REQUEST["sFacing"]!='')? $_REQUEST["sFacing"] : '';
	$sFurnishType = (isset($_REQUEST["sFurnishType"]) && $_REQUEST["sFurnishType"]!='')? $_REQUEST["sFurnishType"] : '';
	$sCStatus = (isset($_REQUEST["sCStatus"]) && $_REQUEST["sCStatus"]!='')? $_REQUEST["sCStatus"] : '';
	$sPstatus = (isset($_REQUEST["sPstatus"]) && $_REQUEST["sPstatus"]!='')? $_REQUEST["sPstatus"] : '';
	$sRegCode = (isset($_REQUEST["sRegCode"]) && $_REQUEST["sRegCode"]!='')? $_REQUEST["sRegCode"] : '';
	$sRoadType = (isset($_REQUEST["sRoadType"]) && $_REQUEST["sRoadType"]!='')? $_REQUEST["sRoadType"] : '';
	
	$sFromDt = (isset($_REQUEST["sFromDt"]) && $_REQUEST["sFromDt"]!='')? $_REQUEST["sFromDt"] : '';
	$sToDt = (isset($_REQUEST["sToDt"]) && $_REQUEST["sToDt"]!='')? $_REQUEST["sToDt"] : '';
	

	/* //$prpobj=new Mysqlidb(HOST,USER,PWD,DB); */
	
	
	if($cat<=0)
	{
		$cat = $sPropertyId = (isset($_REQUEST["sPropertyId"]) && $_REQUEST["sPropertyId"]>0)? $_REQUEST["sPropertyId"] : 0;
	}
	if($status!='')
	{
		$para .= " AND `tp`.`pr_status`='".$status."'" ;
	}
	
	
	if($publish!='')
	{
		$para .= " AND `tp`.`pr_is_publish`='".$publish."'" ;
		$slug = ($publish==1)? ADMIN_PR_PUBLISH : ADMIN_PR_UN_PUBLISH;
	}
	
	/* if($cat!='')
	{
		$queryStr .= " AND `tp`.`pr_cat`='".$cat."' ";
	} */
	if($sFromDt!='')
	{
		$queryStr .= " AND `tp`.`pr_date`>='".date('Y-m-d 00:00:00', strtotime($sFromDt))."' ";
	}
	if($sToDt!='')
	{
		$queryStr .= " AND `tp`.`pr_date`<='".date('Y-m-d 23:59:59', strtotime($sToDt))."' ";
	}
	if($sPstatus!='')
	{
		$queryStr .= " AND `tp`.`pr_posts`='".$sPstatus."' ";
	}
	if($sRoadType!='')
	{
		$queryStr .= " AND `tp`.`pr_road_type`='".$sRoadType."' ";
	}
	if($sRegCode!='')
	{
		$queryStr .= " AND `tp`.`pr_reg_code`='".$sRegCode."' ";
	}
	if($sLocation!='')
	{
		$queryStr .= " AND `tp`.`pr_location`='".$sLocation."' ";
	}
	if($sCStatus!='')
	{
		$queryStr .= " AND `tp`.`pr_constru`='".$sCStatus."' ";
	}
	if($sFacing!='')
	{
		$queryStr .= " AND `tp`.`pr_facing`='".$sFacing."' ";
	}	
	if($sFurnishType!='')
	{
		$queryStr .= " AND `tp`.`pr_furnish`='".$sFurnishType."' ";
	}
	if($sBHK!='')
	{
		$queryStr .= " AND `tp`.`pr_bhk`='".$sBHK."' ";
	}
	
	if($sBath>=0)
	{
		$queryStr .= " AND `tp`.`pr_bath`='".$sBath."' ";
	}
	if($sBolcony>=0)
	{
		$queryStr .= " AND `tp`.`pr_balcony`='".$sBolcony."' ";
	}	
	if($sCparking>=0)
	{
		$queryStr .= " AND `tp`.`pr_parking`='".$sCparking."' ";
	}
	if($sOparking>=0)
	{
		$queryStr .= " AND `tp`.`pr_opnpark`='".$sOparking."' ";
	}
	if($price_from_min!='' && $price_to_max!='')
	{
		$queryStr .= " AND `tp`.`pr_cost` BETWEEN '".$price_from_min."' AND '".$price_to_max."' ";
	}
	if($cat==2 || $cat==4)
	{
		if($area_from_min!='' && $area_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_total_area` BETWEEN '".$area_from_min."' AND '".$area_to_max."' ";
		}
	}
	else
	{
		if($area_from_min!='' && $area_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_build` BETWEEN '".$area_from_min."' AND '".$area_to_max."' ";
		}
	}
	if($al_area_from_min!='' && $al_area_to_max!='')
	{
		$queryStr .= " AND `tp`.`pr_area_in_acre` BETWEEN '".$al_area_from_min."' AND '".$al_area_to_max."' ";
	}
	if($plot_price_from_min!='' && $plot_price_to_max!='')
	{
		$queryStr .= " AND `tp`.`pr_plot_cost` BETWEEN '".$plot_price_from_min."' AND '".$plot_price_to_max."' ";
	}
	if($plot_area_from_min!='' && $plot_area_to_max!='')
	{
		$queryStr .= " AND `tp`.`pr_plot_area` BETWEEN '".$plot_area_from_min."' AND '".$plot_area_to_max."' ";
	}
	
	/* ==== For Pagination ==== */
	
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	/* `tp`.`pr_status`=1 ==*/
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_PROPERTY."` `tp` WHERE  1=1 ".$queryStr." ".$para);
	$totalRecords = $countResult['totalRecords'];
	
	//echo "SELECT COUNT(*) `totalRecords` FROM `".TBL_PROPERTY."` `tp` WHERE  `tp`.`pr_status`=1";
	
	$searchCriteria = array(
		array('name' => 'cat', 'value' => $cat),
		array('name' => 'sPropertyId', 'value' => $sPropertyId),
		array('name' => 'sLocation', 'value' => $sLocation),
		array('name' => 'price_from_min', 'value' => $price_from_min),
		array('name' => 'area_from_min', 'value' => $area_from_min),
		array('name' => 'plot_price_from_min', 'value' => $plot_price_from_min),
		array('name' => 'plot_area_from_min', 'value' => $plot_area_from_min),
		array('name' => 'al_area_from_min', 'value' => $al_area_from_min),
		array('name' => 'price_to_max', 'value' => $price_to_max),
		array('name' => 'area_to_max', 'value' => $area_to_max),
		array('name' => 'plot_price_to_max', 'value' => $plot_price_to_max),
		array('name' => 'plot_area_to_max', 'value' => $plot_area_to_max),
		array('name' => 'al_area_to_max', 'value' => $al_area_to_max),
		array('name' => 'sBath', 'value' => $sBath),
		array('name' => 'sBolcony', 'value' => $sBolcony),
		array('name' => 'sCparking', 'value' => $sCparking),
		array('name' => 'sCparking', 'value' => $sCparking),
		array('name' => 'sBHK', 'value' => $sBHK),
		array('name' => 'sFacing', 'value' => $sFacing),
		array('name' => 'sFurnishType', 'value' => $sFurnishType),
		array('name' => 'sCStatus', 'value' => $sCStatus),
		array('name' => 'sPstatus', 'value' => $sPstatus),
		array('name' => 'sRegCode', 'value' => $sRegCode),
		array('name' => 'sRoadType', 'value' => $sRoadType),
		array('name' => 'sFromDt', 'value' => $sFromDt),
		array('name' => 'sToDt', 'value' => $sToDt),
	);	
	
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
	/* ==== For Pagination ==== */
	
	$proarr = $db->getRecordsArray("SELECT `tp`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid`, `tu`.`u_name`, `tu`.`u_email`, `tu`.`u_phone` FROM `".TBL_PROPERTY."` `tp` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`tp`.`pr_id`  LEFT JOIN `".TBL_USER."` `tu` ON `tu`.`u_id`=`tp`.`u_id` WHERE  1=1 ".$para.$queryStr." GROUP BY `tp`.`pr_id` ORDER BY `tp`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);
	
	//echo "SELECT `tp`.*, `pg`.`pr_img`, `pg`.`pr_id` `prid`, `tu`.`u_name`, `tu`.`u_email`, `tu`.`u_phone` FROM `".TBL_PROPERTY."` `tp` LEFT JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`tp`.`pr_id`  LEFT JOIN `".TBL_USER."` `tu` ON `tu`.`u_id`=`tp`.`u_id` WHERE  1=1 ".$para.$queryStr." GROUP BY `tp`.`pr_id` ORDER BY `tp`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
	
	/* $empArr = getRecordsArray($conn, "SELECT * FROM `".TBL_LOGIN."`");
	
	if(isset($_POST['asignToEmp']))
	{
		if(isset($_POST['empId']) && $_POST['empId']>0 && isset($_POST['propId']) && count($_POST['propId'])>0)
		{
			getRecordsArray($conn, "UPDATE `".TBL_PROPERTY."` SET `emp_id`='".$_POST['empId']."' WHERE `pr_id` IN (".implode(", ", $_POST['propId']).")");
		}
	} */
	//print_r($proarr);
?>
<!-- ============================================================== -->
<?php include_once("../header.php"); ?>
<!-- ============================ Page Title Start================================== -->
	<!--<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets/img/slider-5.jpg);" data-overlay="5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="breadcrumbs-wrap">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" aria-current="page"> Properties </li>
					</ol>
					<h2 class="breadcrumb-title"> Welcome Admin </h2>
					</div>
				</div>
			</div>
		</div>
	</div>-->
<!-- ============================ Page Title End ================================== -->

<!-- ============================ User Dashboard ================================== -->
<section class="gray pt-3 pb-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-12 py-2">
				<?php include_once("../sidebar.php"); ?>
			</div>
			<div class="col-lg-9 col-md-8 col-sm-12 py-2">
				<?php include_once("../templates/properties-list-page.php"); ?>
			</div>
		</div>
	</div>
</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->

<?php include_once("../footer.php"); ?>
