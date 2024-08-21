<?php

include("../includes/config.php");
/* include("../includes/functions.php");
include("../includes/session.php"); */

if($session->isEmployeeLoggedin()){		
	$view = $session->getLoadView();
	header("location:".ROOT.$view);	
	die();
}	
$session->clearSession();
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link href="<?php echo ROOT?>assets/css/styles.css" rel="stylesheet">
		<script src="<?php echo ROOT?>assets/js/jquery.min.js"></script>
		<script src="<?php echo ROOT?>assets/js/popper.min.js"></script>
		<script src="<?php echo ROOT?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo ROOT?>assets/js/ion.rangeSlider.min.js"></script>
		<!-- <script src="<?php echo ROOT?>assets/js/select2.min.js"></script>

 -->
		<script src="<?php echo ROOT?>assets/js/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo ROOT?>assets/js/slick.js"></script>
		<script src="<?php echo ROOT?>assets/js/slider-bg.js"></script>
		<script src="<?php echo ROOT?>assets/js/lightbox.js"></script>
		<script src="<?php echo ROOT?>assets/js/imagesloaded.js"></script>
		<script src="<?php echo ROOT?>assets/js/daterangepicker.js"></script>
		<script src="<?php echo ROOT?>assets/js/custom.js"></script>
	</head>

	<body>
		<div class="modal show" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true" style="background-color: #fff;">
			<div class="modal-dialog modal-xl login-pop-form" role="document">
				<div class="modal-content overli" id="registermodal">
					<div class="modal-body p-0">
						<div class="resp_log_wrap">
							<div class="resp_log_thumb" style="background:url(<?php echo ROOT?>assets/img/log.jpg)no-repeat;"></div>
							<div class="resp_log_caption">
								<div class="edlio_152">
									<ul class="nav nav-pills tabs_system center" id="pills-tab" role="tablist">
										<li class="nav-item"> <a style="background: #56afff00;

color: #000;

font-size: 19px;" class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true"><i class="fas fa-sign-in-alt mr-2"></i>Login</a> </li>
									</ul>
								</div>
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
										<div class="login-form">
											<form id="frmlogin">
												<input type="hidden" name="action" value="sulogin">
												<div class="form-group">
													<label>User Name</label>
													<div class="input-with-icon">
														<input type="text" class="form-control uname required" name="uname"> <i class="ti-user"></i> </div>
												</div>
												<div class="form-group">
													<label>Password</label>
													<div class="input-with-icon">
														<input type="password" class="form-control required pwd" name="pwd"> <i class="ti-unlock"></i> </div>
												</div>
												<div class="form-group">
													<div class="eltio_ol9">
														<!-- <div class="eltio_k2">

<a href="#">Lost Your Password?</a>

</div> --></div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-md full-width pop-login">Login</button>
												</div>
												<div class="noty text-danger"></div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
	<script type="text/javascript">
	$("#login").modal({
		backdrop: 'static',
		keyboard: false,
	});
	$(document).ready(function() {
		$(document).on("submit", "#frmlogin", function(e) {
			e.preventDefault();
			frmdata = $("#frmlogin").serialize();
			$.ajax({
				url: '<?php echo ROOT?>ajax/prop-ajax.php',
				type: 'POST',
				data: frmdata,
				success: function(response) {
					console.log(response);
					jsn = $.parseJSON(response);
					if(jsn.sts == "01") {
						/* window.location.assign("dashboard/"); */
						window.location.assign(jsn.view);
					} else {
						$(".noty").html("Check Credentials");
					}
				}
			}).done(function() {
				console.log("success");
			});
		});
	});
	</script>