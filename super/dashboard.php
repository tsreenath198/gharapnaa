<?php 
	
	include("../includes/config.php");	
	/* include("../includes/connection.php");	
	include("../includes/queries.php");	
	include("../includes/functions.php");	
	include("../includes/MysqliDb.php");	
	include("../includes/session.php");
	$conn = getDBConnection(); */
	
	if(!$session->getIsLoggedIn() || !$session->isAdmin()){
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	$contQuery = "SELECT SUM(IF(`pr_status`=1, 1, 0)) `totalProperties`, SUM(IF(`pr_is_publish`=0 AND `pr_status`=1, 1, 0)) `totalUnPublished`, SUM(IF(`pr_is_publish`=1 AND `pr_status`=1, 1, 0)) `totalPublish` FROM `".TBL_PROPERTY."`";
	$rec = $db->getSingleRowArray($contQuery);
	
	$contPropetyEnqQuery = "SELECT COUNT(*) `totalRecords` FROM `".TBL_ENQUIRIES."` WHERE `eq_status`=1";
	$propertyEnqRecords = $db->getSingleRowArray($contPropetyEnqQuery);
	
	$contEnqQuery = "SELECT COUNT(*) `totalRecords` FROM `".TBL_CONTACTS."` WHERE `status`=1";
	$contactEnqRecords = $db->getSingleRowArray($contEnqQuery);
	
	//$enqarr = $db->getRecordsArray("SELECT `te`.*, `tp`.`pr_reg_code` FROM `".TBL_ENQUIRIES."` `te` LEFT JOIN `".TBL_PROPERTY."` `tp` ON `tp`.`pr_id`=`te`.`pr_id` ORDER BY `pr_id` DESC LIMIT 0,20");				
?>
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<!--<div class="page-title" style="background:#f4f4f4 url(assets/img/slider-5.jpg);" data-overlay="5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="breadcrumbs-wrap">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					</ol>
					<h2 class="breadcrumb-title">Welcome Admin</h2>
				</div>
			</div>
		</div>
	</div>
</div>-->
<!-- ============================ Page Title End ================================== -->

<section class="gray pt-3 pb-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-4 py-2">
				<?php include_once("../sidebar.php"); ?>
			</div>
			<div class="col-lg-9 col-md-8 py-2">
				<div class="dashboard-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12"></div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="dashboard_stats_wrap widget-3">
							<div class="dashboard_stats_wrap_content"><a href="<?php echo ROOT.ADMIN_PR_ACTIVE.'1/'; ?>" ><h4><?php echo $rec['totalProperties'];?></h4> <span>All Properties</span></a></div>
							<div class="dashboard_stats_wrap-icon"><i class="ti-location-pin"></i></div>
							</div>	
						</div>	
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="dashboard_stats_wrap widget-1">
								<div class="dashboard_stats_wrap_content"><a href="<?php echo ROOT.ADMIN_PR_PUBLISH.'1/'; ?>" ><h4><?php echo $rec['totalPublish']?></h4> <span>Published Properties</span></a></div>
								<div class="dashboard_stats_wrap-icon"><i class="ti-credit-card"></i></div>
							</div>	
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="dashboard_stats_wrap widget-2">
								<div class="dashboard_stats_wrap_content"><a href="<?php echo ROOT.ADMIN_PR_UN_PUBLISH.'1/'; ?>" ><h4><?php echo $rec['totalUnPublished']?></h4> <span>Un Published Properties</span></a></div>
								<div class="dashboard_stats_wrap-icon"><i class="ti-wallet"></i></div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="dashboard_stats_wrap widget-1">
								<div class="dashboard_stats_wrap_content"><a href="<?php echo ROOT.ADMIN_PROPERTY_ENQUIRIES.'1/'; ?>" ><h4><?php echo $propertyEnqRecords['totalRecords']?></h4> <span>Property Enquiries</span></a></div>
								<div class="dashboard_stats_wrap-icon"><i class="ti-hand-stop"></i></div>
							</div>	
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="dashboard_stats_wrap widget-2">
								<div class="dashboard_stats_wrap_content"><a href="<?php echo ROOT.ADMIN_ENQUIRIES.'1/'; ?>" ><h4><?php echo $contactEnqRecords['totalRecords']?></h4> <span>Contact Enquiries</span></a></div>
								<div class="dashboard_stats_wrap-icon"><i class="ti-hand-stop"></i></div>
							</div>	
						</div>
					</div>
					<!--<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-lg-8 col-md-8 col-12">
											<h4 class="mb-0">Latest Property Leads</h4>
										</div>
										<div class="col-lg-4 col-md-4 col-12 text-right">
											<a href="<?php echo ROOT.ADMIN_PROPERTY_ENQUIRIES; ?>" class="btn btn-info btn-sm">View All</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0">
									<div class="table-responsive">
										<table class="table table-lg table-hover">
											<thead>
												<tr>
													<th>Property</th>
													<th>Name</th>
													<th>Email</th>
													<th>Subject</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($enqarr AS $enq){
												?>
													<tr>
														<td><a href="<?php echo ROOT.ADMIN_PR_DETAILS.$enq["pr_id"]."/"; ?>" target="_blank"><?php echo $enq["pr_reg_code"]; ?></a></td>
														<td><?php echo $enq["eq_name"]?></td>
														<td><?php echo $enq["eq_email"]?></td>
														<td><?php echo $enq["eq_mobile"]?></td>             
														<td><?php echo $function->getDateFormat($enq["eq_date"], 'd-M-Y');?></td>                
													</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>--->
					<!-- row -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->

<?php include_once("../footer.php"); ?>
