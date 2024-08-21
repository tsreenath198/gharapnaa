<?php
	/* $pageNo = isset($_GET['page'])? $_GET['page'] : 1;
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	$countResult = (array)getSingleRow($conn, "SELECT COUNT(*) `totalRecords` FROM `".TBL_CONTACTS."`");
	$totalRecords = $countResult['totalRecords'];
	
	$enqarr = getRecordsArray($conn, "SELECT * FROM `".TBL_CONTACTS."` ORDER BY `id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);

	$empArr = getRecordsArray($conn, "SELECT * FROM `".TBL_LOGIN."` WHERE `log_type`<>1");
	
	if(isset($_POST['asignToEmp']))
	{
		if(isset($_POST['empId']) && $_POST['empId']>0 && isset($_POST['contactId']) && count($_POST['contactId'])>0)
		{
			getRecordsArray($conn, "UPDATE `".TBL_CONTACTS."` SET `emp_id`='".$_POST['empId']."' WHERE `id` IN (".implode(", ", $_POST['contactId']).")");
		}
	}
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => ROOT.ADMIN_ENQUIRIES
	); */
?>
	<div class="dashboard-body">
		<div class="dashboard-wraper">
		<!-- Basic Information -->
			<div class="frm_submit_block">	
				<h4>My Account</h4>
				<div class="frm_submit_wrap">
					<form method="POST" action="" name="profileform">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Your Name</label>
								<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Email</label>
								<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Your Designation</label>
								<input type="text" class="form-control" name="degi" value="<?php echo $degi; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Phone</label>
								<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Address</label>
								<input type="text" class="form-control" name="addr" value="<?php echo $addr?>">
							</div>
							<div class="form-group col-md-6">
								<label>City</label>
								<input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>State</label>
								<input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
							</div>
							<div class="form-group col-md-6">
								<label>PIN</label>
								<input type="text" class="form-control" name="pin" value="<?php echo $pin; ?>">
							</div>
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-sm btn-success" name="updateProfile">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
/* function checkAll()
	{
		if($("#check_all").is( ":checked" ))
		{
			$(".check-all").prop({"checked" : true});
		}
		else
		{
			//console.log($("#check_all").is( ":checked" ))
			$(".check-all").prop({"checked" : false});
		}
	} */
</script>
<script type="text/javascript">
jQuery(document).ready(function($) 
	{
		logsts="<?php echo $notlog;?>";
		if(logsts){
			if(!$("#login").hasClass("show"))
			{
				$("#login").addClass("show");
				setInterval(function(){ $(".modal-backdrop").addClass("show"); }, 100);
				
			}
			$("#login").modal({backdrop: 'static',keyboard: false ,});
		}
		
	});
</script>