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
	/* print_r($_REQUEST); */
	$type = (isset($_REQUEST["type"]) && $_REQUEST["type"]!='')? $_REQUEST["type"] : 'enquiry';
	$sKey = (isset($_REQUEST["sKey"]) && $_REQUEST["sKey"]!='')? $_REQUEST["sKey"] : '';
	$sStatus = (isset($_REQUEST["sStatus"]) && $_REQUEST["sStatus"]>='0')? $_REQUEST["sStatus"] : '0';
	$sEmployee = (isset($_REQUEST["sEmployee"]) && $_REQUEST["sEmployee"]>0)? $_REQUEST["sEmployee"] : 0;
	
	$sFromDt = (isset($_REQUEST["sFromDt"]) && $_REQUEST["sFromDt"]!='')? $_REQUEST["sFromDt"] : ((isset($_REQUEST["sToDt"]) && $_REQUEST["sFromDt"]=='')? '' : date('Y-m-d'));
	$sToDt = (isset($_REQUEST["sToDt"]) && $_REQUEST["sToDt"]!='')? $_REQUEST["sToDt"] : ((isset($_REQUEST["sToDt"]) && $_REQUEST["sToDt"]=='')? '' : date('Y-m-d'));
	
	$queryStr = '';
	$actionUrl = ROOT.ADMIN_REMINDER_LIST;
	
	$isAdmin = $session->isAdmin();
	$isMaster = $session->isMaster();
	
	if(!$isAdmin)
	{
		$sEmployee = $session->getUserId();
	}
/* echo $type;
die(); */
	if($sFromDt!='')
	{
		$queryStr .= " AND `tr`.`remind_date`>='".date('Y-m-d 00:00:00', strtotime($sFromDt))."' ";
	}
	if($sToDt!='')
	{
		$queryStr .= " AND `tr`.`remind_date`<='".date('Y-m-d 23:59:59', strtotime($sToDt))."' ";
	}
	if($type=='enquiry')
	{		
		if($sKey!='') 
		{
			$queryStr .= " AND (`tc`.`email` LIKE '%".$sKey."%' OR `tc`.`phone` LIKE '%".$sKey."%') "; 
			 /* OR `pr`.`pr_reg_code` LIKE '%".$sKey."%' */
		}
		if($sEmployee>0) 
		{
			$queryStr .= " AND `tc`.`emp_id` = '".$sEmployee."' "; 
		}
		$searchSql = "SELECT `tr`.*, `tc`.`id` `recordId`, `tc`.`name`, `tc`.`email`, `tc`.`phone`, (SELECT `display_name` FROM `".TBL_EMPLOYEES."` WHERE `id`=`tr`.`added_by`) `addedBy` FROM `".TBL_REMINDERS."` `tr` LEFT JOIN `".TBL_CONTACTS."` `tc` ON `tc`.`id`=`tr`.`contact_id` WHERE `tc`.`status`=1 AND `tr`.`type`='".$type."' ".$queryStr." AND `tr`.`is_done`='".$sStatus."'  ORDER BY `tr`.`id` DESC ";
		
		$searchCountSql = "SELECT COUNT(*) `totalRecords` FROM `".TBL_REMINDERS."` `tr` LEFT JOIN `".TBL_CONTACTS."` `tc` ON `tc`.`id`=`tr`.`contact_id` WHERE `tc`.`status`=1 AND `tr`.`type`='".$type."' ".$queryStr." AND `tr`.`is_done`='".$sStatus."' ";
		
		
		/* echo $searchSql;
		die(); */
		
	}
	if($type=='property')
	{
		if($sKey!='') 
		{
			$queryStr .= " AND (`te`.`eq_email` LIKE '%".$sKey."%' OR `te`.`eq_mobile` LIKE '%".$sKey."%') ";
			/* `eq_name` LIKE '%".$sKey."%' OR  */
		}
		if($sEmployee>0) 
		{
			$queryStr .= " AND `te`.`emp_id` = '".$sEmployee."' "; 
		}
		$searchSql = "SELECT `tr`.*, `te`.`eq_id` `recordId`, `te`.`eq_name` `name`, `te`.`eq_email` `email`, `te`.`eq_mobile` `phone`, (SELECT `display_name` FROM `".TBL_EMPLOYEES."` WHERE `id`=`tr`.`added_by`) `addedBy` FROM `".TBL_REMINDERS."` `tr` LEFT JOIN `".TBL_ENQUIRIES."` `te` ON `te`.`eq_id`=`tr`.`contact_id` WHERE `te`.`eq_status`=1 AND `tr`.`type`='".$type."' ".$queryStr." AND `tr`.`is_done`='".$sStatus."' AND `tr`.`remind_date` <= '".date("Y-m-d")."' ORDER BY `tr`.`id` DESC ";
		
		$searchCountSql = "SELECT COUNT(*) `totalRecords` FROM `".TBL_REMINDERS."` `tr` LEFT JOIN `".TBL_ENQUIRIES."` `te` ON `te`.`eq_id`=`tr`.`contact_id` WHERE `te`.`eq_status`=1 AND `tr`.`type`='".$type."' ".$queryStr." AND `tr`.`is_done`='".$sStatus."' AND `tr`.`remind_date` <= '".date("Y-m-d")."' ";
	}
	
	$pageNo = isset($_REQUEST['page'])? $_REQUEST['page'] : 1;
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	$countResult = $db->getSingleRowArray($searchCountSql);
	$totalRecords = $countResult['totalRecords'];
	
	
	$searchCriteria = array(
		array('name' => 'sKey', 'value' => $sKey),
		array('name' => 'sStatus', 'value' => $sStatus),
		array('name' => 'sFromDt', 'value' => $sFromDt),
		array('name' => 'sToDt', 'value' => $sToDt)
	);	
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl.$type.'/1/'
	);
	
	/* echo $searchSql." LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;  */
	
	$remindersArr = $db->getRecordsArray($searchSql." LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);
	
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
		<!--<div class="row">
			<div class="col-lg-12 col-md-12">
				<div id="accordion">
					<div class="card">
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
										<div class="col-lg-4 col-sm-4 col-md-2 col-12 my-1">
											<select id="sStatus" class="form-control input-sm inputselct" name="sStatus" >
												<option value="1" <?php echo ($sStatus=='1')? 'selected' : ''; ?> > Active </option>
												<option value="0" <?php echo ($sStatus=='0')? 'selected' : ''; ?> > In-Active </option>
											</select>
										</div>
										
										<div class="col-lg-4 col-sm-4 col-md-2 col-12 my-1">
											<input type="text" class="form-control input-sm" placeholder="Name, Email, Phone" id="sRegCode" name="sKey" value="<?php echo $sKey; ?>" />
										</div>
										<div class="col-lg-4 col-sm-4 col-md-2 col-12 my-1">
											<input type="submit" name="doSearch" value="Search" class="btn btn-sm btn-primary" />
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<div class="row mb-1">
			<div class="col-lg-12 col-md-12">
				<ul class="nav nav-pills nav-fill">
					<li class="nav-item">
						<a class="nav-link <?php echo ($type=='enquiry')? 'active disabled' : '' ;?>" href="<?php echo $actionUrl.'enquiry/1/'; ?>" style="border: 1px solid #007bff;">Enquiry Reminders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($type=='property')? 'active disabled' : '' ;?>" href="<?php echo $actionUrl.'property/1/'; ?>" style="border: 1px solid #007bff;">Property Reminders</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div id="accordion">
					<div class="card mb-0">
						<div class="card-header c-header" data-toggle="collapse" href="#openSearch">
							<?php
								$recordsFrom = isset($recordsFrom)? $recordsFrom : 0;
								$totalRecords = isset($totalRecords)? $totalRecords : 0;
								if(count($remindersArr)>0)
								{
							?>
									Showing Records ( <?php echo ($recordsFrom+1); ?> to <?php echo $recordsFrom+count($remindersArr); ?> ) / <?php echo $totalRecords; ?> 
							<?php
								}
								else
								{
									echo 'Search';
								}
							?>
							<a class="collapsed card-link float-right">
								<i class="fa fa-filter"></i>
							</a>
						</div>
						<div id="openSearch" class="collapse" data-parent="#accordion">
							<div class="card-body">
								<form name="searchform" method="POST" action="<?php echo $actionUrl.$type.'/1/'; ?>">
									<div class="row">
										<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
											<input type="date" name="sFromDt"  class="form-control" value="<?php echo (isset($sFromDt) && $sFromDt!='')? date("Y-m-d",strtotime($sFromDt)) : ''; ?>"  data-toggle="tooltip" data-title="From Date">
										</div>
										<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
											<input type="date" name="sToDt" class="form-control" value="<?php echo (isset($sToDt) && $sToDt!='')? date("Y-m-d",strtotime($sToDt)) : ''; ?>"  data-toggle="tooltip" data-title="To Date">
										</div>
										<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
											<select id="sStatus" class="form-control input-sm inputselct" name="sStatus" >
												<option value="1" <?php echo ($sStatus=='1')? 'selected' : ''; ?> > Done </option>
												<option value="0" <?php echo ($sStatus=='0')? 'selected' : ''; ?> > Not Done </option>
											</select>
										</div>
										<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
											<input type="text" class="form-control input-sm" placeholder="Name, Email, Phone" id="sRegCode" name="sKey" value="<?php echo $sKey; ?>" />
										</div>
										<div class="col-lg-4 col-sm-4 col-md-2 col-12 my-1">
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
				<div class="card mt-1">
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-responsive table-striped font-12">
								<thead class="thead-dark">
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>phone</th>
										<th style="width:35%;">Comment</th>
										<th>Remider Dt</th>
										<th>Added By</th>
										<th class="text-center">Status</th>
										<th class="text-right" style="width:10%;"><i class="fa fa-bolt"></i></th>
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
										if(count($remindersArr)>0)
										{
											foreach($remindersArr as $rem){
									?>
										<tr>
											<td><?php echo $rem["name"]; ?></td>
											<td><?php echo $rem["email"]; ?></td>
											<td><?php echo $rem["phone"]; ?></td>         
											<td><?php echo $rem["remind_message"]; ?></td>                     
											<td><?php echo $function->getDateFormat($rem["remind_date"], "d-M-Y H:i"); ?></td>                
											<td><?php echo $rem["addedBy"]; ?></td>                
											<td class="text-center">
												<?php 
													$class = (isset($rem["is_done"])&&$rem["is_done"]=='1')? 'btn-success' : 'btn-danger';
													echo '<button class="btn btn-xs '.$class.'" >'.((isset($rem["is_done"])&&$rem["is_done"]=='1')? 'Done' : 'Not-Done').'</button>'; 
												?>
											</td>                
											<td class="text-right">
												
												<?php
													$urlSlug = '';
													$convId = '';
													if($type=='property')
													{
														$urlSlug = ADD_PROPERTY_ACTIVITY;
														$convId = 'pr_conv_view';
													}
													else if($type=='enquiry')
													{
														$urlSlug = ADD_CONTACT_ACTIVITY;
														$convId = 'eq_conv_view';
													}
													if($urlSlug!='' && $convId!='')
													{
												?>
														<a href="<?php echo ROOT.$urlSlug.$rem["contact_id"]."/"; ?>" class="btn btn-xs btn-outline-info"><i class="fa fa-comment-dots"></i></a>
														<a href="javascript:void(0);" class="btn btn-xs btn-outline-info" id="<?php echo $convId; ?>" data-id="<?php echo $rem["contact_id"]?>"><i class="fa fa-eye"></i></a>
												<?php
													}
												?>
												<!--<a href="<?php //echo ROOT.(($type=='property')? ADD_PROPERTY_ACTIVITY : (($type=='enquiry'))? ADD_CONTACT_ACTIVITY : '' ).$rem["recordId"]."/"; ?>" class="btn btn-xs btn-outline-info float-right"><i class="fa fa-comment-dots"></i></a>-->
												
											</td>           
										</tr>
									<?php 
											}
										}
										else
										{
											echo '<tr><td colspan="6" class="text-center">No records found.</td></tr>';
										}
									?>
								</tbody>
							</table>
						</div>
						<?php
							if(count($remindersArr)>0)
							{
								$function->createPagination($paginationArry, $searchCriteria);
							}
						?>
					</div>
				</div>
				<!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-enquiry-tab" data-toggle="pill" href="#pills-enquiry" role="tab" aria-controls="pills-enquiry" aria-selected="true">Enquiry Reminders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-property-tab" data-toggle="pill" href="#pills-property" role="tab" aria-controls="pills-property" aria-selected="false">Property Reminders</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-enquiry" role="tabpanel" aria-labelledby="pills-enquiry-tab">..fffffff.</div>
					<div class="tab-pane fade" id="pills-property" role="tabpanel" aria-labelledby="pills-property-tab">..ggggggggggggg.</div>
				</div>-->
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

<div class="modal fade font-12" id="view_conv_modal" tabindex="-1" role="dialog" aria-labelledby="authomessage" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered login-pop-form modal-lg" role="document">
		<div class="modal-content" id="authomessage">
			<span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
			<div class="modal-body">
				<h4 class="modal-header-title">Conversation List</h4>
				<div class="login-form">
					<table class="table table-bordered table-responsive font-12">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Rating</th>
								<th style="width:60%">Comment</th>
								<th>Added By</th>
								<th>Date Added</th>
							</tr>
						</thead>
						<tbody id="conv_records_list">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
		 
<script>

function sendAjax(convId = 0, type = '')
{
	$("#view_conv_modal").modal("show");
	var ratingsArr = <?php echo json_encode($RATING_ARR); ?>;
	$.ajax({
		url: '<?php echo ROOT?>ajax/prop-ajax.php',
		type: 'POST',
		data: 'action=viewconv&id='+convId+'&type='+type,
		success:function(response){	
			jsn=$.parseJSON(response);
			if(jsn.status=='success')
			{
				var convList = jsn.data;
				
				var tableData = '';
				if(convList.length>0)
				{
					for(var i=0; i<convList.length; i++)
					{
						tableData += '<tr><td>'+(i+1)+'</td><td>'+ratingsArr[convList[i]['rating']]+'</td><td>'+convList[i]['comment']+'</td><td>'+convList[i]['addedBy']+'</td><td>'+getDateFormat(convList[i]['date_added'], 'dd-MM-yyyy')+'</td></tr>';
					}
				}
				else
				{
					tableData += '<tr><td colspan="5" class="text-center">No records found.</td></tr>';
				}
				$("#conv_records_list").html(tableData);
			}
			if(jsn.status=='error')
			{
				//$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
			}
			/* setTimeout(function(){
				$('#mailOTP').removeClass('disabled');
			},60000); */
		}
	})
	.done(function() {
		//console.log("success");
		//setTimeout(function(){$(".noty").html(""); }, 3000);

	});
}
$(document).on('click', '#eq_conv_view', function(event) {
	event.preventDefault();
	var convId = $(this).data('id');
	
	if(convId!='')
	{
		sendAjax(convId, 'enquiry');
	}
});
$(document).on('click', '#pr_conv_view', function(event) {
	event.preventDefault();
	var convId = $(this).data('id');
	if(convId!='')
	{
		sendAjax(convId, 'property');
	}
});
</script>