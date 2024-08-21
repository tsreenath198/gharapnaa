<?php 
/* include("template.php");
head(); */

	include("../includes/config.php");
	/* include("../includes/connection.php");
	include("../includes/queries.php");
	include("../includes/functions.php");
	include("../includes/MysqliDb.php");
	include("../includes/session.php"); */
	/* 
	
	
	$path = $function->createDirectoryPath('emp');
	echo $path."====".is_dir($path);
	
	die(); */
	
	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	/* $conn = getDBConnection(); */
	
	//$profileId = 0;
	$empId = (isset($_GET['eid']) && $_GET['eid']>0)? $_GET['eid'] : 0;
	$employee = $deptEmpsData = array();
	
	$first_name  = $last_name = $display_name = $email = $phone = $address = $city = $state = $zip = $user_name = $password = $department = $role = $password1 = "";
	$tl_id = 0;
	$is_active = 1;
	
	if($empId>0)
	{
		$employee = $db->getSingleRowArray("SELECT * FROM `".TBL_EMPLOYEES."` WHERE `id`='".$empId."'");
		$deptEmpsData = $db->getRecordsArray("SELECT * FROM `".TBL_EMPLOYEES."` WHERE `department`='".$employee['department']."' AND `emp_role`=1");
		if(count($employee)>0)
		{
			$empId = $employee['id'];
			$first_name = $employee['first_name'];
			$last_name =  $employee['last_name'];
			$display_name =  $employee['display_name'];
			$email =  $employee['email'];
			$phone =  $employee['phone'];
			$address =  $employee['address'];
			$city =  $employee['city'];
			$state =  $employee['state'];
			$zip =  $employee['zip'];
			$user_name =  $employee['user_name'];
			$role =  $employee['emp_role'];
			$tl_id =  $employee['tl_id'];
			$password =  $employee['password1'];
			$is_active =  $employee['is_active'];
			$department = $employee['department'];
		}
	}
	
	if(isset($_POST['addEmployee']))
	{
		/* $userId = $session->getUserId();
		$empId = $db->escString($_POST['empId']);
		$first_name = $db->escString($_POST['first_name']);
		$last_name = $db->escString($_POST['last_name']);
		$display_name = $db->escString($_POST['display_name']);
		$email = $db->escString($_POST['email']);
		$phone = $db->escString($_POST['phone']);
		$address = $db->escString($_POST['address']);
		$city = $db->escString($_POST['city']);
		$state = $db->escString($_POST['state']);
		$zip = $db->escString($_POST['zip']);
		$user_name = $db->escString($_POST['user_name']);
		$password = $_POST['password'];
		$enc_password = MD5($_POST['password']);
		$department = $_POST['log_type'];
		$role = $_POST['log_role'];
		$privilege = '';
		$tl_id = (isset($_POST['tl_id']) && $_POST['tl_id']>0)? $_POST['tl_id'] : 0;
		$currDate = date("Y-m-d H:i:s");
		
		
		//echo $insertEmpSql.'<br />';
		//echo $profileId.'<br />';
		//print_r($_POST);
		//die();
		if($empId==0)
		{
			$directory = $function->createDirectoryPath('emp');
			$insertEmpSql = "INSERT INTO `".TBL_EMPLOYEES."` (`first_name`, `last_name`, `display_name`, `email`, `phone`, `user_name`, `password`, `password1`, `address`, `city`, `state`, `zip`, `department`, `emp_role`, `privilege`, `tl_id`, `created_by`, `created_date`, `directory`) VALUES ('".$first_name."', '".$last_name."', '".$display_name."', '".$email."', '".$phone."', '".$user_name."', '".$enc_password."', '".$password."', '".$address."', '".$city."', '".$state."', '".$zip."', '".$department."', '".$role."', '".$privilege."', '".$tl_id."', '".$userId."', '".$currDate."', '".$directory."');";
			
			
			$empId = $db->insertUpdateRecord($insertEmpSql);
			
			/* if($profileId>0)
			{
				$insertLoginSql = "INSERT INTO `".TBL_LOGIN."` (`profile_id`, `log_name`, `log_email`, `log_pwd`, `log_type`, `log_role`, `log_date_added`, `log_directory`) VALUES ('".$profileId."', '".$display_name."', '".$user_name."', '".$enc_password."', '".$department."', '".$role."', '".$currDate."', '".$directory."');";
				insertUpdateRecord($conn, $insertLoginSql);
			} *
		}
		else
		{
			$updateEmpSQL = "UPDATE `".TBL_EMPLOYEES."` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`display_name`='".$display_name."',`email`='".$email."',`phone`='".$phone."',`user_name`='".$user_name."',`password`='".$password."',`password1`='".$enc_password."',`address`='".$address."',`city`='".$city."',`state`='".$state."',`zip`='".$zip."',`department`='".$department."',`emp_role`='".$role."',`privilege`='".$privilege."',`tl_id`='".$tl_id."' WHERE `id`='".$empId."'";
			$db->insertUpdateRecord($updateEmpSQL);
			
			/* $updateLoginSQL = "UPDATE `".TBL_LOGIN."` SET `log_name`='".$display_name."',`log_email`='".$user_name."',`log_pwd`='".$enc_password."',`log_type`='".$department."',`log_role`='".$role."' WHERE `profile_id`='".$profileId."'";
			
			insertUpdateRecord($conn, $updateLoginSQL); *
		}
		header("Location: ".ROOT.ADMIN_USERS);
		die(); */
	}
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
							<form id="addemployeeform" >
								<div class="frm_submit_block">	
									<h4>Add Employee</h4>
									<hr />
									<div class="frm_submit_wrap">
										<div class="form-row">
											<input type="hidden" name="empId" value="<?php echo $empId; ?>" />
											<input type="hidden" name="action" value="addempform" /> 
											<div class="form-group col-md-4 emp-fields">
												<label>First Name</label>
												<input type="text" class="form-control required" name="first_name" id="f_name" value="<?php echo $first_name; ?>" onkeyup="checkValidate('f_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4">
												<label>Last Name</label>
												<input type="text" class="form-control" name="last_name" id="l_name" value="<?php echo $last_name; ?>" onkeyup="checkValidate('l_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Display Name</label>
												<input type="text" class="form-control required" name="display_name" id="d_name" value="<?php echo $display_name; ?>" onkeyup="checkValidate('d_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Email</label>
												<input type="email" class="form-control required" name="email" id="e_email" value="<?php echo $email; ?>" onkeyup="checkValidate('e_email', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Phone</label>
												<input type="text" class="form-control required" name="phone" id="e_phone" value="<?php echo $phone; ?>" onkeyup="checkValidate('e_phone', /^[0-9+ ]{0,15}$/, '', ['Please Enter Phone', 'Enter Digits only.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Address</label>
												<input type="text" class="form-control required" name="address" id="e_addr" value="<?php echo $address; ?>" onkeyup="checkValidate('e_addr', '', 'Please Enter Address', [])">
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>City</label>
												<input type="text" class="form-control required" name="city" id="e_city" value="<?php echo $city; ?>" onkeyup="checkValidate('e_city', /^[A-Za-z ]+$/, '', ['Please Enter City', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>State</label>
												<input type="text" class="form-control required" name="state" id="e_state" value="<?php echo $state; ?>" onkeyup="checkValidate('e_state', /^[A-Za-z ]+$/, '', ['Please Enter State', 'Characters Only.'])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>PIN</label>
												<input type="text" class="form-control required" name="zip" id="e_zip" value="<?php echo $zip; ?>" onkeyup="checkValidate('e_zip', /^[0-9+ ]{0,15}$/, '', ['Please Enter PIN', 'Enter Digits only.'])" />
											</div>
										</div>
										<hr />
										<div class="form-row">
											<div class="form-group col-md-4 emp-fields">
												<label>User Name</label>
												<input type="text" class="form-control required" name="user_name" id="eu_name" value="<?php echo $user_name; ?>" onkeyup="checkValidate('eu_name', '', 'Please Enter User Name', [])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Password</label>
												<input type="password" class="form-control required" name="password" id="e_pass" value="<?php echo $password; ?>" onkeyup="checkValidate('e_pass', '', 'Please Enter Password', [])" />
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Status</label>
												<select class="form-control required" name="is_active" id="is_active" >
													<option value="1" <?php echo (($is_active=="1")? 'selected' : '')?>>Active</option>
													<option value="0" <?php echo (($is_active=="0")? 'selected' : '')?>>In-active</option>
												</select>
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Department</label>
												<select class="form-control required" name="log_type" id="log_type" onchange="getDepertmentEmps(this.value); checkValidate('log_type', '', 'Invalid Department');" >
													<option value="" <?php echo (($department=="")? 'selected' : '')?>>-- Select Department --</option>
													<!--<option value="2" <?php echo (($department=="2")? 'selected' : '')?>>Marketing</option>
													<option value="3" <?php echo (($department=="3")? 'selected' : '')?>>Sales</option> -->
													<?php
														foreach($DEPARTMENTARR as $key => $val)
														{
															if($key!=1)
															{
																echo '<option value="'.$key.'" '.(($department==$key)? "selected" : "").'>'.$val.'</option>';
															}
														}
													
													?>
												</select>
											</div>
											<div class="form-group col-md-4 emp-fields">
												<label>Role</label>
												<select class="form-control required" id="log_role" name="log_role" onchange="enableTL(); checkValidate('log_role', '', 'Invalid Team Lead');"  >
													<option value="" <?php echo (($role=="")? 'selected' : '')?>>-- Select Role --</option>
													<!--<option value="1" <?php echo (($role=="1")? 'selected' : '')?>>Team Lead</option>
													<option value="2" <?php echo (($role=="2")? 'selected' : '')?>>Team Member</option>-->
													<?php
														foreach($ROLEARR as $key => $val)
														{
															echo '<option value="'.$key.'" '.(($role==$key)? "selected" : "").'>'.$val.'</option>';
														}
													
													?>
												</select>
											</div>
											<?php if($role=="2") { ?>
												<div class="form-group col-md-4 emp-fields" id="tl_field">
													<label>Team Lead</label>
													<select class="form-control tead-lead <?php echo ($role=="1")? "" : "required"; ?>" id="tl_id" name="tl_id" onchange="checkValidate('tl_id', '', 'Invalid Team Lead');" >
														<option value="" <?php echo (($tl_id=="")? 'selected' : '')?>>-- Select Employee --</option>
														<?php 
															if(count($deptEmpsData)>0)
															{
																foreach($deptEmpsData as $emp)
																{
																	echo '<option value="'.$emp["id"].'" '.(($emp["id"]==$tl_id)? "selected" : "").'>'.$emp["display_name"].'</option>';
																}
															}
														?>
													</select>
												</div>
											<?php } ?>
										</div>
										<div class="form-row">
											<div class="form-group col-md-12 text-right">
												<input type="button" name="addEmployee" id="add_employee" class="btn btn-success" value="Add Employee" />
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
        $(document).on('click', '#add_employee', function(event)
		{
			event.preventDefault();
			valid=true;
			$(".emp-fields>.required").each(function(index, el)
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
				frmdata=$("#addemployeeform").serialize();
				
				//frmdata = new FormData( $( 'form#contact_form' )[ 0 ] );
				
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:frmdata ,
					success:function(response){
						//console.log(response)
						$("#addemployeeform")[0].reset();
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
		function getDepertmentEmps(deptId)
		{
			if(deptId>0)
			{
				//$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data: {'action' : 'getDeptEmps', 'dept_id' : deptId} ,
					success:function(response){
						empData = $.parseJSON(response);
						var empSelect = '<option value="">-- Select Employee --</option>';
						for(ind in empData)
						{
							empSelect+='<option value="'+empData[ind]["id"]+'">'+empData[ind]["user_name"]+'</option>';
						}
						$("#tl_id").html(empSelect);
					}
				})
				.done(function() {
					//console.log("success");
					//setTimeout(function(){$(".noty").html(""); }, 3000);
				});
			}
		}
		function enableTL()
		{
			var role = $("#log_role").val();
			if(role=='1')
			{
				$(".tead-lead").removeClass('required');
				$("#tl_field").hide();
			}
			else
			{
				$(".tead-lead").addClass('required');
				$("#tl_field").show();
			}
		}
</script>