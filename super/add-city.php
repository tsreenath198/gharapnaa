<?php 
	include("../includes/config.php");

	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	$cityId = (isset($_GET['cityId']) && $_GET['cityId']>0)? $_GET['cityId'] : 0;
	$cityData = array();
	
	$loc_name  = $district_id = $district_name = $state_id = $state_name = "";
	$is_active = $country_id = 1;
	$country_name = "India";
	
	if($cityId>0)
	{
		$cityData = $db->getSingleRowArray("SELECT * FROM `".TBL_LOCATIONS."` WHERE `loc_id`='".$cityId."'");
		if(count($cityData)>0)
		{
			$cityId = $cityData['loc_id'];
			$loc_name = $cityData['loc_name'];
			$district_id = $cityData['district_id'];
			$state_id = $cityData['state_id'];
		}
	}
	
	$statesList = $db->getRecordsArray("SELECT * FROM `".TBL_STATES."` WHERE `is_active`=1 ORDER BY `state_name` ASC");
	$districtsList = $db->getRecordsArray("SELECT * FROM `".TBL_DISTRICTS."` WHERE `is_active`=1 ORDER BY `district_name` ASC");
?>
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
	<!--<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets//img/slider-5.jpg);" data-overlay="5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="breadcrumbs-wrap">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" aria-current="page">Add Employee</li>
					</ol>
					<h2 class="breadcrumb-title">Add Employee</h2>
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
						<div class="dashboard-wraper">
							<!-- Basic Information -->
							<form id="addcityform" >
								<div class="frm_submit_block">	
									<h4>Add City</h4>
									<hr />
									<div class="frm_submit_wrap">
										<div class="form-row">
											<input type="hidden" name="loc_id" value="<?php echo $cityId; ?>" />
											<input type="hidden" name="action" value="addcityform" /> 
											
											<input type="hidden" name="country_id" value="<?php echo $country_id; ?>" />
											<input type="hidden" name="country_name" value="<?php echo $country_name; ?>" />
											
											<div class="form-group col-md-4 city-fields">
												<label>City Name</label>
												<input type="text" class="form-control required" name="loc_name" id="f_name" value="<?php echo $loc_name; ?>" onkeyup="checkValidate('f_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4 city-fields">
												<label>State</label>
												<select class="form-control required" name="state_id" id="state_id" onchange="getDistricts(this.value); checkValidate('state_id', '', 'Invalid State');" >
													<option value="" <?php echo (($state_id=="")? 'selected' : '')?>>-- Select State --</option>
													<?php
														foreach($statesList as $val)
														{
															echo '<option value="'.$val['id'].'" '.(($state_id==$val['id'])? "selected" : "").'>'.$val['state_name'].'</option>';
														}
													
													?>
												</select>
											</div>
											<div class="form-group col-md-4 city-fields">
												<label>District</label>
												<select class="form-control required" name="district_id" id="district_id" onchange="checkValidate('district_id', '', 'Invalid District');" >
													<option value="" <?php echo (($district_id=="")? 'selected' : '')?>>-- Select District --</option>
													<?php
														foreach($districtsList as $val)
														{
															echo '<option value="'.$val['id'].'" '.(($district_id==$val['id'])? "selected" : "").'>'.$val['district_name'].'</option>';
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-4 city-fields">
												<label>Status</label>
												<select class="form-control required" name="is_active" id="is_active" >
													<option value="1" <?php echo (($is_active=="1")? 'selected' : '')?>>Active</option>
													<option value="0" <?php echo (($is_active=="0")? 'selected' : '')?>>In-active</option>
												</select>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-12 text-right">
												<input type="button" name="addCity" id="add_city" class="btn btn-success" value="Add City" />
												<div class="notify"></div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- ============================ User Dashboard End ================================== -->




<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="call_action_wrap">
<div class="call_action_wrap-head">
<h3>Do You Have Questions ?</h3>
<span>We'll help you to grow your career and growth.</span>
</div>
<a href="#" class="btn btn-call_action_wrap">Contact Us Today</a>
</div>

</div>
</div>
</div>
</section>
<?php include_once("../footer.php"); ?>

<script type="text/javascript">
        $(document).on('click', '#add_city', function(event)
		{
			event.preventDefault();
			valid=true;
			$(".city-fields>.required").each(function(index, el)
			{
				if($(el).val()=='')
				{
					valid=false;
					$(this).addClass('has-error');
					$(this).parent().addClass('txt-error');
				}
			});
			if(valid)
			{
				$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				$(".has-error").removeClass('has-error');
				$(".txt-error").removeClass('txt-error');
				frmdata=$("#addcityform").serialize();
				
				//frmdata = new FormData( $( 'form#contact_form' )[ 0 ] );
				
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:frmdata ,
					success:function(response){
						$("#addcityform")[0].reset();
						jsn=$.parseJSON(response);
						$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
						//window.location.href = jsn.redirectUrl;
						window.location.assign(jsn.redirectUrl);
					}
				})
				.done(function() {
				//console.log("success");
				//setTimeout(function(){$(".noty").html(""); }, 3000);

				});
			}
		});
		function getDistricts(stateId)
		{
			if(stateId>0)
			{
				//$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data: {'action' : 'getDistricts', 'state_id' : stateId} ,
					success:function(response){
						distData = $.parseJSON(response);
						var distSelect = '<option value="">-- Select District --</option>';
						for(ind in distData)
						{
							distSelect+='<option value="'+distData[ind]["id"]+'">'+distData[ind]["district_name"]+'</option>';
						}
						$("#district_id").html(distSelect);
					}
				})
				.done(function() {
					//console.log("success");
					//setTimeout(function(){$(".noty").html(""); }, 3000);
				});
			}
		}
</script>