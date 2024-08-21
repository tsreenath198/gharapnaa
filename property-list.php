<?php 
	//include("template.php");
	
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	//head();
	//print_r($_POST);
	//$prpobj=new Mysqlidb(HOST,USER,PWD,DB);
	/* if(!getIsLoggedIn())
	{
		header("Location: ".$siteUrl);
		die();
	} */
	
	/* ini_set("display_errors",1); */
	
	$userId = $session->getUserId();
	
	$ptypes = $txtloc = $txtLocality = $fibhk = $filocal = $filopnpark = $filfurnshtyp = $locid = $locatxt = $constType = $possType = '';
	$plot_unit = '';
	$filcat="";
	
	$filopnpark = $fibacony = $figaspip = $filmicrowave = $filpetallow = $filfurnshtyp = $filcctv = $fillift = $filgc = false;
	

	/* $filrange[0]=0;$filrange[1]=0;
	$filarea[0]=0;$filarea[1]=0; */
	
	//$price_from = isset($_POST['price_from'])? $_POST['price_from'] : 1000;
	//$price_to = isset($_POST['price_to'])? $_POST['price_to'] : 100000000;
	
	/* =========== 21-01-2021 ========== */
	/* $price_from_min = 0;
	$area_from_min = 0;
	$plot_price_from_min = 0;
	$plot_area_from_min = 0;
	
	$price_to_max = 10000000;
	$area_to_max = 1000000;
	$plot_price_to_max = 10000000;
	$plot_area_to_max = 1000000; */
	
	$price_from_min = $area_from_min = $plot_price_from_min = $plot_area_from_min = $price_to_max = $area_to_max = $plot_price_to_max = $plot_area_to_max = $al_area_from_min = $al_area_to_max = '';
	/* =========== 21-01-2021 ========== */
	
	/* $conn = getDBConnection(); */
	$queryStr = '';
	$ptypes = (isset($_POST["ptypes"]) && $_POST["ptypes"]!='')? $_POST["ptypes"] : '';
	$filocal = (isset($_POST["txtloc"]) && $_POST["txtloc"]!='')? $_POST["txtloc"] : '';
	
	if($ptypes!='')
	{
		$queryStr .= " AND `tp`.`pr_cat`='".$ptypes."' ";
	}
	if($filocal!='')
	{
		$queryStr .= " AND `tp`.`pr_location`='".$filocal."' ";
	}
	if(isset($_POST['btnsubmit']))
	{
		$queryStr = '';
		//$ptypes = (isset($_POST["pr_cat"]) && $_POST["pr_cat"]!='')? $_POST["pr_cat"] : '';
		$filocal = isset($_POST["txtlocation"])? $_POST["txtlocation"] : '';
		$fibhk = (isset($_POST["txtbhk"])? $_POST["txtbhk"] : '');
		$plot_unit = (isset($_POST["plot_unit"])? $_POST["plot_unit"] : '');
		
		/* $area_in_acre = (isset($_POST["area_in_acre"])? $_POST["area_in_acre"] : '');
		$area_in_guntha = (isset($_POST["area_in_guntha"])? $_POST["area_in_guntha"] : ''); */
		
		/* $filrange = (isset($_POST["my_range"])? explode(";",$_POST["my_range"]) : array(0,10000000));
		$filarea = (isset($_POST["my_area"])? explode(";",$_POST["my_area"]) : array(0,1000000));		
		
		$plotPriceRange = (isset($_POST["plot_price_range"])? explode(";",$_POST["plot_price_range"]) : array(0,10000000));
		$plotAreaRange = (isset($_POST["plot_area"])? explode(";",$_POST["plot_area"]) : array(0,1000000));
		
		if(count($filrange)>0)
		{
			$price_from_min = $filrange[0];
			$price_to_max = $filrange[1];
		}
		
		if(count($filarea)>0)
		{
			$area_from_min = $filarea[0];
			$area_to_max = $filarea[1];
		}
		
		if(count($plotPriceRange)>0)
		{
			$plot_price_from_min = $plotPriceRange[0];
			$plot_price_to_max = $plotPriceRange[1];
		}
		
		if(count($plotAreaRange)>0)
		{
			$plot_area_from_min = $plotAreaRange[0];
			$plot_area_to_max = $plotAreaRange[1];
		} */
		
		/* =========== 21-01-2021 ========== */
		/* $price_from_min = (isset($_POST["price_from_min"]) && $_POST["price_from_min"]>0)? $_POST["price_from_min"] : 0;
		$area_from_min = (isset($_POST["area_from_min"]) && $_POST["area_from_min"]>0)? $_POST["area_from_min"] : 0;
		$plot_price_from_min = (isset($_POST["plot_price_from_min"]) && $_POST["plot_price_from_min"]>0)? $_POST["plot_price_from_min"] : 0;
		$plot_area_from_min = (isset($_POST["plot_area_from_min"]) && $_POST["plot_area_from_min"]>0)? $_POST["plot_area_from_min"] : 0;
		
		$price_to_max = (isset($_POST["price_to_max"]) && $_POST["price_to_max"]>0)? $_POST["price_to_max"] : 10000000;
		$area_to_max = (isset($_POST["area_to_max"]) && $_POST["area_to_max"]>0)? $_POST["area_to_max"] : 1000000;
		$plot_price_to_max = (isset($_POST["plot_price_to_max"]) && $_POST["plot_price_to_max"]>0)? $_POST["plot_price_to_max"] : 10000000;
		$plot_area_to_max = (isset($_POST["plot_area_to_max"]) && $_POST["plot_area_to_max"]>0)? $_POST["plot_area_to_max"] : 1000000; */
		
		$price_from_min = (isset($_POST["price_from_min"]) && $_POST["price_from_min"]!='')? $_POST["price_from_min"] : '';
		$area_from_min = (isset($_POST["area_from_min"]) && $_POST["area_from_min"]!='')? $_POST["area_from_min"] : '';
		$plot_price_from_min = (isset($_POST["plot_price_from_min"]) && $_POST["plot_price_from_min"]!='')? $_POST["plot_price_from_min"] : '';
		$plot_area_from_min = (isset($_POST["plot_area_from_min"]) && $_POST["plot_area_from_min"]!='')? $_POST["plot_area_from_min"] : '';
		$al_area_from_min = (isset($_POST["al_area_from_min"]) && $_POST["al_area_from_min"]!='')? $_POST["al_area_from_min"] : '';
		
		$price_to_max = (isset($_POST["price_to_max"]) && $_POST["price_to_max"]!='')? $_POST["price_to_max"] : '';
		$area_to_max = (isset($_POST["area_to_max"]) && $_POST["area_to_max"]!='')? $_POST["area_to_max"] : '';
		$plot_price_to_max = (isset($_POST["plot_price_to_max"]) && $_POST["plot_price_to_max"]!='')? $_POST["plot_price_to_max"] : '';
		$plot_area_to_max = (isset($_POST["plot_area_to_max"]) && $_POST["plot_area_to_max"]!='')? $_POST["plot_area_to_max"] : '';
		$al_area_to_max = (isset($_POST["al_area_to_max"]) && $_POST["al_area_to_max"]!='')? $_POST["al_area_to_max"] : '';
		/* =========== 21-01-2021 ========== */
		
		$filopnpark = isset($_POST["opnpark"])? true : false;
		$fibacony = isset($_POST["bacony"])? true : false;
		$figaspip = isset($_POST["gaspip"])? true : false;
		$filmicrowave = isset($_POST["microwave"])? true : false;
		$filpetallow = isset($_POST["petallow"])? true : false;
		$filfurnshtyp = isset($_POST["furnshtyp"])? true : false;
		
		$filgc = isset($_POST["gatedcommunity"])? true : false;
		$fillift = isset($_POST["lift"])? true : false;
		$filcctv = isset($_POST["cctv"])? true : false;
	
		$possType = (isset($_POST["posstype"]) && $_POST["posstype"]!='')? $_POST["posstype"] : '';
		$constType = (isset($_POST["consttype"]) && $_POST["consttype"]!='')? $_POST["consttype"] : '';
		
		$plot_unit = ($ptypes==3)? 'sq.yd' : $plot_unit;
		
		
		
		
		/* $locid=$_POST["txtloc"];
		//print_r($_POST);
		$filcat=$_POST["txtcat"];
		//print_r($filrange);pr_posts
		$locatxt=$_POST["txtLocality"]; */
		
		if($ptypes!='')
		{
			$queryStr .= " AND `tp`.`pr_cat`='".$ptypes."' ";
		}
		if($possType!='')
		{
			$queryStr .= " AND `tp`.`pr_posts`='".$possType."' ";
		}
		if($constType!='')
		{
			$queryStr .= " AND `tp`.`pr_constru`='".$constType."' ";
		}
		if($filocal!='')
		{
			$queryStr .= " AND `tp`.`pr_location`='".$filocal."' ";
		}
		if($fibhk!='')
		{
			$queryStr .= " AND `tp`.`pr_bhk`='".$fibhk."' ";
		}		
		if(($ptypes==3 || $ptypes==5) && $plot_unit!='')
		{
			$queryStr .= " AND `tp`.`pr_plot_unit`='".$plot_unit."' ";
		}
		
		
		/* =========== 21-01-2021 ========== */
		/* if($price_from_min>0 && $price_to_max>0)
		{
			$queryStr .= " AND `tp`.`pr_cost` BETWEEN '".$price_from_min."' AND '".$price_to_max."' ";
		}
		if($area_from_min>0 && $area_to_max>0)
		{
			$queryStr .= " AND `tp`.`pr_build` BETWEEN '".$area_from_min."' AND '".$area_to_max."' ";
		}
		if($plot_price_from_min>0 && $plot_price_to_max>0)
		{
			$queryStr .= " AND `tp`.`pr_plot_cost` BETWEEN '".$plot_price_from_min."' AND '".$plot_price_to_max."' ";
		}
		if($plot_area_from_min>0 && $plot_area_to_max>0)
		{
			$queryStr .= " AND `tp`.`pr_plot_area` BETWEEN '".$plot_area_from_min."' AND '".$plot_area_to_max."' ";
		} */
		
		/* if($area_in_acre!='' && $area_in_acre>0)
		{
			$queryStr .= " AND `tp`.`pr_area_in_acre`='".$area_in_acre."' ";
		}
		if($area_in_guntha!='' && $area_in_guntha>0)
		{
			$queryStr .= " AND `tp`.`pr_area_in_guntha`='".$area_in_guntha."' ";
		} */
		if($al_area_from_min!='' && $al_area_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_area_in_acre` BETWEEN '".$al_area_from_min."' AND '".$al_area_to_max."' ";
		}
		if($price_from_min!='' && $price_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_cost` BETWEEN '".$price_from_min."' AND '".$price_to_max."' ";
		}
		if($ptypes==2 || $ptypes==4)
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
		if($plot_price_from_min!='' && $plot_price_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_plot_cost` BETWEEN '".$plot_price_from_min."' AND '".$plot_price_to_max."' ";
		}
		if($plot_area_from_min!='' && $plot_area_to_max!='')
		{
			$queryStr .= " AND `tp`.`pr_plot_area` BETWEEN '".$plot_area_from_min."' AND '".$plot_area_to_max."' ";
		}
		/* =========== 21-01-2021 ========== */
		if($filopnpark)
		{
			$queryStr .= " AND `tp`.`pr_opnpark`>1 ";
		}
		if($fibacony)
		{
			$queryStr .= " AND `tp`.`pr_balcony`>0 ";
		}
		if($figaspip)
		{
			$queryStr .= " AND `tp`.`pr_amnenitis` LIKE '%,7,%' ";
		}
		if($filmicrowave)
		{
			$queryStr .= " AND `tp`.`pr_amnenitis` LIKE '%,4,%' ";
		}
		if($filpetallow)
		{
			$queryStr .= " AND `pr_amnenitis` LIKE ',14,' ";
		}
		if($filfurnshtyp)
		{
			$queryStr .= " AND `tp`.`pr_furnish` = '1' ";
		}
		
		if($filcctv)
		{
			$queryStr .= " AND `tp`.`pr_amnenitis` LIKE '%,2,%' ";
		}
		if($fillift)
		{
			$queryStr .= " AND `tp`.`pr_amnenitis` LIKE '%,1,%' ";
		}
		if($filgc)
		{
			$queryStr .= " AND `tp`.`pr_amnenitis` LIKE '%,9,%' ";
		}
		
	}
	
	$wishSelect = $wishJoin = '';
	if($userId>0){
		$wishJoin .= " LEFT JOIN `".TBL_WISHLIST."` `tw` ON `tw`.`pr_id`=`tp`.`pr_id` AND `tw`.`u_id`='".$userId."' ";
		$wishSelect = ", `tw`.`wl_id`";
	}
	
	$selectQuery = "SELECT `tp`.* ".$wishSelect." FROM `".TBL_PROPERTY."` `tp` ".$wishJoin." WHERE 1=1 ".$queryStr." AND `tp`.`pr_status`=1 AND `tp`.`pr_is_publish`=1 ORDER BY `tp`.`pr_id` DESC ";
	$proarr = $db->getRecordsArray($selectQuery);
	
	//echo $selectQuery;
	//die();
	$procnt = count($proarr);
	
	$locarr = $db->getRecordsArray("SELECT * FROM `".TBL_LOCATIONS."`");
	
	//print_r($proarr[0]);
	//echo $selectQuery;
	//die();
	
	/* if($filcat){$prpobj->where("pr_cat",$filcat);}
	if($ptypes){$prpobj->where("pr_cat",$ptypes);}
	if($fibhk){$prpobj->where("pr_bhk",$fibhk);}
	if($filocal){$prpobj->where("pr_location",$filocal);}
	if($filopnpark){$prpobj->where("pr_opnpark","1",">");}
	if($filfurnshtyp){$prpobj->where("pr_furnish","1");}
	if($filrange[0]){$prpobj->where("pr_cost",Array($filrange[0],$filrange[1]),"BETWEEN");}
	if($filarea[0]){$prpobj->where("pr_build",Array($filarea[0],$filarea[1]),"BETWEEN");}

	if($locid){$prpobj->where("pr_location",$locid);}
	if($locatxt){$prpobj->where("pr_locality",'%'.$locatxt.'%',"LIKE");}
	$prpobj->where("pr_status",1);
	if($_SESSION['UID']){
	$prpobj->join("wishlist wl","pr.pr_id=wl.pr_id AND wl.u_id=$_SESSION[UID]","LEFT");
	$wlid=$_SESSION['UID']?",wl.wl_id":"";
	}
	$proarr=$prpobj->get("property pr",null,"pr.pr_id,pr.u_id,pr.pr_title,pr.pr_decri,pr.pr_type,pr.pr_cat,pr.pr_age,pr.pr_bhk,pr.pr_room,pr.pr_bath,pr.pr_balcony,pr.pr_parking,pr.pr_opnpark,pr.pr_location,pr.pr_locality,pr.pr_cost,pr.pr_maintarea,pr.pr_furnish,pr.pr_build,pr.pr_buildproj,pr.pr_carpt,pr.pr_offer,pr.pr_constru,pr.pr_flatno,pr.pr_floor,pr.pr_addr,pr.pr_city,pr.pr_dist,pr.pr_state,pr.pr_ttlfllor,pr.pr_contactname,pr.pr_amnenitis,pr.pr_soamnenitis,pr.pr_posdt,pr.pr_agepro,pr.pr_mobile,pr.pr_email,pr.pr_link,pr.pr_posts,pr.pr_lenth,pr.pr_width,pr.pr_status$wlid");
	$procnt=$prpobj->count; */
	//echo $prpobj->getLastQuery();
	//$prpobj=new Mysqlidb(HOST,USER,PWD,DB);
	//$locarr=$prpobj->get("locations",null,"*");
?>

<!-- ============================================================== -->


<!-- ============================ Page Title End ================================== -->
<?php include_once("header.php"); ?>

<!-- ============================ Agency List Start ================================== -->
<section class="gray">
	<?php include_once("templates/buy-page.php"); ?>
</section>

<?php include_once("call-to-action.php"); ?>
<!-- ============================ Call To Action End ================================== -->
<?php include_once("footer.php"); ?>
<?php 
	//footer();
	
	/* if($price_from>0 && $price_to>0)
	{

		echo '<script>$("#price_from").val('.$price_from.');$("#price_from").val('.$price_to.');</script>';

	} */
?>
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('.inputselct').select2();
});
</script>-->