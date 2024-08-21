<?php 
	include("../includes/config.php");
	/* include("../includes/connection.php");
	include("../includes/queries.php");
	include("../includes/functions.php");
	include("../includes/MysqliDb.php");
	include("../includes/session.php"); */
	
	//$notlog = false;
	/* $conn = getDBConnection(); */
	
	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	$adminId = $session->getUserId();
	$prop = $galleriesArr = array();
	$propertyId = (isset($_GET["prid"])&&$_GET["prid"]>0)? $_GET["prid"] : 0;
	if($propertyId>0)
	{
		$prop = $db->getSingleRowArray("SELECT * FROM `".TBL_PROPERTY."` WHERE `pr_id`='".$propertyId."'");

		if(isset($prop['pr_id']) && $prop['pr_id']>0)
		{
			$galleriesArr = $db->getRecordsArray("SELECT * FROM `".TBL_GALLERY."` WHERE `pr_id`='".$prop['pr_id']."'");
		}
	}
	else
	{
		$galleriesArr = $db->getRecordsArray("SELECT * FROM `".TBL_GALLERY."` WHERE `a_id`='".$adminId."' AND `pr_id`=0");
	}
	
	
	$file = $procls = $protyp = $consts = $possts = $ageprop = $bedroom = $bathroom = $bacony = $furnish = $copark = $opnpark = $amnenitis = $socamnenitis = $txtcost = $txtmaint = $txtbuildarea = $txtcarparea = $txtoffer = $txtdecri = $plotPrice = $plotArea = $plotUnit = $plotLength = $plotWidth = $widthOfFacingRoad = $txtlocation = $txtbuild = $txtlocality = $txtlink = $faltno = $txtflrno = $ttlfllor = $posdt = $pr_youtube_link = $areaInAcre = $areaInGuntha = $pr_facing = $pr_road_type = $pr_total_area = '';
	
	if(isset($_POST['publish']) || isset($_POST['unpublish']))
	{
		if($propertyId>0)
		{
			//echo "UPDATE `".TBL_PROPERTY."` SET `pr_is_publish`='".((isset($_POST['publish']))? 1 : 0)."' WHERE `pr_id`='".$propertyId."'";
			//die();
			if($db->insertUpdateRecord("UPDATE `".TBL_PROPERTY."` SET `pr_is_publish`='".((isset($_POST['publish']))? 1 : (isset($_POST['unpublish'])? 2 : 0))."' WHERE `pr_id`='".$propertyId."'"))
			{
				$session->setSessionAlertMsg(array('type' => 'success', 'message' => 'Property published.'));
			}
			else
			{
				$session->setSessionAlertMsg(array('type' => 'danger', 'message' => 'Property not published.'));
			}
		}
		header("Location:".$adminUrl."property/1/");
				die();
	}
	
	if(isset($_POST['btnsubmit']))
	{
	
		/* ini_set("display_errors",0); */
		$adminId=isset($_SESSION['UID'])? $_SESSION['UID'] : 0;
		
		$propertyId = $_POST['propertyId'];
		$procls = $_POST['i_want_to'];
		$pr_facing = $_POST['facing'];
		$protyp = $_POST['property_type'];
		$txtmaint = $_POST['maintaining_charges'];
		$txtoffer = ''; /* $_POST['offer'] */
		$txtdecri = $_POST['description'];
		$txtlocation = $_POST['txtlocation'];
		$txtbuild = $_POST['txtbuild'];
		$txtlocality = $_POST['txtlocality'];
		$txtlink = $_POST['txtlink'];
		$pr_youtube_link = $_POST['pr_youtube_link'];
		
		$pr_owner_name = $_POST['pr_owner_name'];
		$pr_owner_email = $_POST['pr_owner_email'];
		$pr_owner_phone = $_POST['pr_owner_phone'];
		
		//$folder="images/";
		
		if((int)$protyp == 3 || (int)$protyp == 5)
		{
			
			$possts = $_POST['possesion_status'];
			
			if((int)$possts==2)
			{
				$possdate = (isset($_POST['possesion_date'])? $_POST['possesion_date'] : '');
				$posdt=date("Y-m-d",strtotime($possdate));
			}
			else
			{
				$posdt = '';
				$ageprop=$_POST['age_of_property'];
			}
			$plotPrice = $_POST['plot_price'];
			$plotArea = ((int)$protyp == 3)? $_POST['plot_area'] : '';
			$plotUnit = ((int)$protyp == 3)? "sq.yd" : "";
			$plotLength = ''; /* $_POST['plot_length'] */
			$plotWidth = ''; /* $_POST['plot_width'] */
			$widthOfFacingRoad = $_POST['width_facing_road'];
			$pr_road_type = $_POST['pr_road_type'];
			$areaInAcre = ((int)$protyp == 5)? $_POST['area_in_acre'] : '';
			$areaInGuntha = ((int)$protyp == 5)? $_POST['area_in_guntha'] : '';
		}
		else
		{
			$consts=$_POST['construction_status'];
			$plotUnit = "sq.ft";
			if((int)$consts==2)
			{
				$possdate = (isset($_POST['possesion_date'])? $_POST['possesion_date'] : '');
				$posdt=date("Y-m-d",strtotime($possdate));
			}
			else
			{
				$ageprop=$_POST['age_of_property'];
				$posdt = '';
			}
			
			if((int)$protyp != 1)
			{
				$pr_total_area = $_POST['pr_total_area'];
				$plotUnit = "sq.yd";
			}
			
			$txtbuildarea = $_POST['build_up_area'];
			$txtcarparea = $_POST['carpet_area'];
			$txtcost = $_POST['cost'];
			$bedroom = $_POST['bedroom'];
			$bathroom = $_POST['bathroom'];
			$bacony = $_POST['bacony'];
			$furnish = $_POST['furnish'];
			$copark = $_POST['coparking'];
			$opnpark = $_POST['opnparking'];
			$amnenitis = $_POST['other_amnenitis'];
			$socamnenitis = $_POST['social_amnenitis'];
			
			$faltno = $_POST['faltno'];
			$txtflrno = $_POST['txtflrno'];
			$ttlfllor = $_POST['ttlfllor'];
		}
		
		if($propertyId==0)
		{
			$insertQuery = "INSERT INTO `".TBL_PROPERTY."` (`u_id`, `a_id`, `pr_decri`, `pr_type`, `pr_cat`, `pr_bhk`, `pr_bath`, `pr_balcony`, `pr_parking`, `pr_opnpark`, `pr_location`, `pr_locality`, `pr_cost`, `pr_maintarea`, `pr_furnish`, `pr_build`, `pr_buildproj`, `pr_carpt`, `pr_offer`, `pr_constru`, `pr_flatno`, `pr_floor`, `pr_ttlfllor`, `pr_amnenitis`, `pr_soamnenitis`, `pr_posdt`, `pr_agepro`, `pr_link`, `pr_posts`, `pr_lenth`, `pr_width`, `pr_plot_cost`, `pr_plot_area`, `pr_plot_unit`, `pr_width_road_facing`, `pr_youtube_link`, `pr_area_in_acre`, `pr_area_in_guntha`, `pr_facing`, `pr_road_type`, `pr_total_area`, `pr_date`, `pr_owner_name`, `pr_owner_email`, `pr_owner_phone`) VALUES ('0', '".$adminId."', '".$txtdecri."', '".$procls."', '".$protyp."', '".$bedroom."', '".$bathroom."', '".$bacony."', '".$copark."', '".$opnpark."', '".$txtlocation."', '".$txtlocality."', '".$txtcost."', '".$txtmaint."', '".$furnish."', '".$txtbuildarea."', '".$txtbuild."', '".$txtcarparea."', '".$txtoffer."', '".$consts."', '".$faltno."', '".$txtflrno."', '".$ttlfllor."', '".$amnenitis."', '".$socamnenitis."', '".$posdt."', '".$ageprop."', '".$txtlink."', '".$possts."', '".$plotLength."', '".$plotWidth."', '".$plotPrice."', '".$plotArea."', '".$plotUnit."', '".$widthOfFacingRoad."', '".$pr_youtube_link."', '".$areaInAcre."', '".$areaInGuntha."', '".$pr_facing."', '".$pr_road_type."', '".$pr_total_area."', '".(date("Y-m-d H:i:s"))."', '".$pr_owner_name."', '".$pr_owner_email."', '".$pr_owner_phone."');";
			
				if($proid = $db->insertUpdateRecord($insertQuery))
				{
					/* $proid = getInsertId($conn); */
					
					$updateRegCodeSQL = "UPDATE `".TBL_PROPERTY."` SET `pr_reg_code`='".$function->getPropertyId($proid)."' WHERE `pr_id`='".$proid."'";
					$db->insertUpdateRecord($updateRegCodeSQL);
					
					$updateGallerySql = "UPDATE `".TBL_GALLERY."` SET `pr_id`='".$proid."' WHERE `a_id`='".$adminId."' AND `pr_id`=0";
					$db->insertUpdateRecord($updateGallerySql);
					
					$session->setSessionAlertMsg(array('type' => 'success', 'message' => 'Property added.'));
					header("Location:".$adminUrl."property/1/");
					die();
				}
				else
				{
					$session->setSessionAlertMsg(array('type' => 'danger', 'message' => 'Property not added.'));
					header("Location:".$adminUrl."property/1/");
					die();
				}
		}
		else
		{		
			if($propertyId>0)
			{
				$updateQuery = "UPDATE `".TBL_PROPERTY."` SET `pr_decri`='".$txtdecri."', `pr_type`='".$procls."', `pr_cat`='".$protyp."', `pr_bhk`='".$bedroom."', `pr_bath`='".$bathroom."', `pr_balcony`='".$bacony."', `pr_parking`='".$copark."', `pr_opnpark`='".$opnpark."', `pr_location`='".$txtlocation."', `pr_locality`='".$txtlocality."', `pr_cost`='".$txtcost."', `pr_maintarea`='".$txtmaint."', `pr_furnish`='".$furnish."', `pr_build`='".$txtbuildarea."', `pr_buildproj`='".$txtbuild."', `pr_carpt`='".$txtcarparea."', `pr_offer`='".$txtoffer."', `pr_constru`='".$consts."', `pr_flatno`='".$faltno."', `pr_floor`='".$txtflrno."', `pr_ttlfllor`='".$ttlfllor."', `pr_amnenitis`='".$amnenitis."', `pr_soamnenitis`='".$socamnenitis."', `pr_posdt`='".$posdt."', `pr_agepro`='".$ageprop."', `pr_link`='".$txtlink."', `pr_posts`='".$possts."', `pr_lenth`='".$plotLength."', `pr_width`='".$plotWidth."', `pr_plot_cost`='".$plotPrice."', `pr_plot_area`='".$plotArea."', `pr_plot_unit`='".$plotUnit."', `pr_width_road_facing`='".$widthOfFacingRoad."', `pr_updated_by`='".$adminId."', `pr_area_in_acre`='".$areaInAcre."', `pr_area_in_guntha`='".$areaInGuntha."', `pr_youtube_link`='".$pr_youtube_link."', `pr_facing`='".$pr_facing."', `pr_road_type`='".$pr_road_type."', `pr_total_area`='".$pr_total_area."', `pr_updated_date`='".(date('Y-m-d H:i:s'))."', `pr_owner_name`='".$pr_owner_name."', `pr_owner_email`='".$pr_owner_email."', `pr_owner_phone`='".$pr_owner_phone."' WHERE `pr_id`='".$propertyId."'";
				
				$db->insertUpdateRecord($updateQuery);
				header("Location:".$adminUrl."property-update/".$propertyId);
				die();
			}
			else
			{
				$session->setSessionAlertMsg(array('type' => 'danger', 'message' => 'Property not updated.'));
			}
			
		}
	}

	//head($alertMsgArr);
?>
<!-- ============================================================== -->
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- ============================ Page Title Start================================== -->
<!--<div class="page-title" style="background:#f4f4f4 url(assets/img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">Add Property</li>
</ol>
<h2 class="breadcrumb-title">Submit Your Property</h2>
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

<div class="col-lg-9 col-md-8 py-2">
	<?php include_once("../templates/add-edit-property-page.php"); ?>
</div>

</div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .has-error{border: 1px solid #f00!important;}
    .txt-error{color:red!important;}
</style>
<?php include_once("../footer.php"); ?>