<?php 
	/* include("../template.php");head();if(!$_SESSION['LOGGED']){header("location:".ROOT."super/");} */	
	include("../includes/config.php");	
	/* include("../includes/connection.php");	
	include("../includes/queries.php");	
	include("../includes/functions.php");	
	include("../includes/MysqliDb.php");	
	include("../includes/session.php");	 */	
		
	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	/* $conn = getDBConnection(); */
	
	$districtsList = $statesList = array();
	$pageNo = isset($_GET['page'])? $_GET['page'] : 1;
	$sKey = (isset($_REQUEST["sKey"]) && $_REQUEST["sKey"]!='')? $_REQUEST["sKey"] : '';
	$sDistrict = (isset($_REQUEST["sDistrict"]) && $_REQUEST["sDistrict"]!='')? $_REQUEST["sDistrict"] : '';
	$sState = (isset($_REQUEST["sState"]) && $_REQUEST["sState"]!='')? $_REQUEST["sState"] : '';
	$sStatus = (isset($_REQUEST["sStatus"]) && $_REQUEST["sStatus"]>=0)? $_REQUEST["sStatus"] : 1;
	
	$actionUrl = ROOT.CITY_LIST;
	$queryStr = '';
	
	if($sKey!='') 
	{
		$queryStr .= " AND (`loc_name` LIKE '%".$sKey."%' OR `district_name` LIKE '%".$sKey."%' OR `state_name` LIKE '%".$sKey."%') ";
	}
	if($sStatus!='') 
	{
		$queryStr .= " AND `is_active`='".$sStatus."' ";
	}
	if($sDistrict!='') 
	{
		$queryStr .= " AND `district_id`='".$sDistrict."' ";
	}
	if($sState!='') 
	{
		$queryStr .= " AND `state_id`='".$sState."' ";
	}
	
	/* RECORDS_LIMIT */
	$recordsLimit = 100; 
	$recordsFrom = (($pageNo-1)*$recordsLimit);
	
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_LOCATIONS."` WHERE 1=1 ".$queryStr);
	$totalRecords = $countResult['totalRecords'];
	
	
	$searchCriteria = array(
		array('name' => 'sKey', 'value' => $sKey),
		array('name' => 'district_id', 'value' => $sDistrict),
		array('name' => 'state_id', 'value' => $sState),
		array('name' => 'sStatus', 'value' => $sStatus)
	);	
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => $recordsLimit, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
							
	$citiesArr = $db->getRecordsArray("SELECT * FROM `".TBL_LOCATIONS."` WHERE 1=1 ".$queryStr." ORDER BY `loc_name` ASC LIMIT ".$recordsFrom.", ".$recordsLimit);
	
	$statesList = $db->getRecordsArray("SELECT * FROM `".TBL_STATES."` WHERE `is_active`=1 ORDER BY `state_name` ASC");
	$districtsList = $db->getRecordsArray("SELECT * FROM `".TBL_DISTRICTS."` WHERE `is_active`=1 ORDER BY `district_name` ASC");
	
?>
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<!--<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets/img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">  

 Users


</li>
</ol>
<h2 class="breadcrumb-title">


Welcome Admin
</h2>
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
<div class="dashboard-body">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div id="accordion">
				<div class="card mb-2">
					<div class="card-header c-header" data-toggle="collapse" href="#openSearch">
						Search
						<a class="collapsed card-link float-right">
							<i class="fa fa-filter"></i>
						</a>
					</div>
					<div id="openSearch" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<form name="searchform" method="POST" action="<?php echo $actionUrl.'1/'; ?>">
								<div class="row">
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<input type="text" class="form-control input-sm" placeholder="City, District, State" id="sKey" name="sKey" value="<?php echo $sKey; ?>" />
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sStatus" class="form-control input-sm inputselct" name="sStatus" >
											<option value="1" <?php echo ($sStatus=='1')? 'selected' : ''; ?> > Active </option>
											<option value="0" <?php echo ($sStatus=='0')? 'selected' : ''; ?> > In-Active </option>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sState" class="form-control input-sm inputselct" name="sState" >
											<option value="" <?php echo (($sState=="")? 'selected' : '')?>> -- Select State -- </option>
											<?php
												foreach($statesList as $val)
												{
													echo '<option value="'.$val['id'].'" '.(($sState==$val['id'])? "selected" : "").'>'.$val['state_name'].'</option>';
												}
											
											?>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sDistrict" class="form-control input-sm inputselct" name="sDistrict" >
											<option value="" <?php echo (($sDistrict=="")? 'selected' : '')?>> -- Select District -- </option>
											<?php
												foreach($districtsList as $val)
												{
													echo '<option value="'.$val['id'].'" '.(($sDistrict==$val['id'])? "selected" : "").'>'.$val['district_name'].'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<hr />
								<div class="row text-center">
									<div class="col-12 my-2">
										<input type="submit" name="doSearch" value="Search" class="btn btn-sm btn-primary" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-12">
							<h4 class="mb-0">All Cities </h4>
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-right">
							<a href="<?php echo ROOT.CITY_ADD; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> City</a>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>#</th>
									<th>City Name</th>
									<th>District Name</th>
									<th>State Name</th>
									<th>Status</th>
									<th>Added Dt</th>
									<th><i class="fa fa-bolt"></i></th>
								</tr>
							</thead>
							<tbody>
								<!--<tr>
									<td colspan="5" class="text-right"><a href="" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add User</a></td>                
								</tr>-->
								<?php
									/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
									$prpobj->orderBy("en.id","DESC");
									$enqarr=$prpobj->get(TBL_CONTACTS." en",null,"*"); */
									$i=0;
									if(count($citiesArr)>0)
									{
										foreach($citiesArr AS $cityVal)
										{
											$i++;
								?>
									<tr>
										<td><?php echo (($pageNo-1)*$recordsLimit)+$i; ?></td>
										<td><?php echo $cityVal["loc_name"]; ?></td>
										<td><?php echo $cityVal["district_name"]; ?></td>
										<td><?php echo $cityVal["state_name"]; ?></td>            
										<td><?php echo ($cityVal["is_active"]==1)? 'Active' : 'In-Active'; ?></td>                
										<td><?php echo $function->getDateFormat($cityVal["created_date"], "d-M-Y H:i"); ?></td>                
										<td><a href="<?php echo ROOT.CITY_EDIT.$cityVal["loc_id"]."/"; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a></td>                
									</tr>
								<?php 
										}
									}
									else
									{
										echo '<tr><td colspan="5" class="text-center">No records found.</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
					<?php
						if(count($citiesArr)>0)
						{
							$function->createPagination($paginationArry, $searchCriteria);
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
</div>




</div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->




<!-- ============================ Call To Action ================================== -->

<?php include_once("../footer.php"); ?>
