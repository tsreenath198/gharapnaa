<?php 
//include("template.php");
//head();
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php");
	
	ini_set("display_errors",0); */

	$searchCriteria = array();
	$price_from_min = $area_from_min = $plot_price_from_min = $plot_area_from_min = $price_to_max = $area_to_max = $plot_price_to_max = $plot_area_to_max = $al_area_from_min = $al_area_to_max = '';
	$sBHK = $sFacing = $sFurnishType = $sCStatus = $sRegCode = '';
	$sBath = $sBolcony = $sCparking = $sOparking = '-1';
	$isEnableType = false;
	$cat = $sPropertyId = (isset($_REQUEST["cat"]) && $_REQUEST["cat"]>0)? $_REQUEST["cat"] : 0;
	
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
	
	
	/* $conn = getDBConnection(); */
	$queryStr = '';
	
	if($cat>0)
	{
		$isEnableType = true;
		$queryStr .= " AND `tp`.`pr_cat`='".$cat."' ";
		switch($cat)
		{
			case 1:
				$slug = USER_FEATURED_APART;
				break;
			case 2:
				$slug = USER_FEATURED_HOME;
				break;
			case 3:
				$slug = USER_FEATURED_PLOT;
				break;
			case 4:
				$slug = USER_FEATURED_VILLA;
				break;
			case 5:
				$slug = USER_FEATURED_AGRI_LAND;
				break;
			default:
				$slug = USER_FEATURED_APART;
				break;
		}
	}
	else
	{
		header("location:".ROOT);
		die();
	}
	
	if($cat<=0)
	{
		$cat = $sPropertyId = (isset($_REQUEST["sPropertyId"]) && $_REQUEST["sPropertyId"]>0)? $_REQUEST["sPropertyId"] : 0;
	}
	
	$wishSelect = $wishJoin = $searchPara = '';
	$actionUrl = ROOT.$slug;
	
	
	if($session->getUserId()>0){
		$wishJoin .= " LEFT JOIN `".TBL_WISHLIST."` `tw` ON `tw`.`pr_id`=`tp`.`pr_id` AND `tw`.`u_id`='".$session->getUserId()."' ";
		$wishSelect = ", `tw`.`wl_id`";
	}
	
	
	/* if($cat!='')
	{
		$queryStr .= " AND `tp`.`pr_cat`='".$cat."' ";
	} */
	if($sPstatus!='')
	{
		$queryStr .= " AND `tp`.`pr_posts`='".$sPstatus."' ";
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
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_PROPERTY."` `tp` WHERE  `tp`.`pr_status`=1 ".$searchPara." AND `tp`.`pr_is_publish`=1 ".$queryStr);
	$totalRecords = $countResult['totalRecords'];
	
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
	);	
									
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
	/* ==== For Pagination ==== */
	
	$selectQuery = "SELECT `tp`.* ".$wishSelect." FROM `".TBL_PROPERTY."` `tp` ".$wishJoin." WHERE 1=1 ".$queryStr.$searchPara." AND `tp`.`pr_status`=1 AND `tp`.`pr_is_publish`=1 ORDER BY `tp`.`pr_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
	$proarr = $db->getRecordsArray($selectQuery);
	
	$procnt = count($proarr);
//print_r($proarr);
?>

<!-- ============================================================== -->
<?php include_once("header.php"); ?>
<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets/img/slider-3.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">Featured Property</li>
</ol>
<h2 class="breadcrumb-title"><?php echo $CATARR[$cat]?></h2>
</div>

</div>
</div>
</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="gray">
	<?php include_once("templates/feature-page.php"); ?>
</section>
<!-- ============================ Agency List End ================================== -->

<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<!-- ============================ Call To Action End ================================== -->
<?php include_once("footer.php"); ?>
