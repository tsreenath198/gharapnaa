<?php 
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	$notlog = false;
	
	if(!$session->getIsLoggedIn()){
		$notlog = true;
	}
	/* $conn = getDBConnection(); */
	
	//ini_set("display_errors",1);
	
?>
<?php include_once("header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
	<div class="page-title" style="background:#f4f4f4 url(assets/img/slider-5.jpg);" data-overlay="5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="breadcrumbs-wrap">
						<ol class="breadcrumb">
							<li class="breadcrumb-item active" aria-current="page">  Change Password</li>
						</ol>
						<h2 class="breadcrumb-title"> Edit or Change Password </h2>
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
				<div class="col-lg-9 col-md-8 py-2">
					<?php include_once("templates/change-password-page.php"); ?>
				</div>
			</div>
		</div>
	</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<?php include_once("footer.php"); ?>