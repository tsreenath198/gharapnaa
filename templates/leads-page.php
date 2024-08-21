<?php
	$pageNo = isset($_REQUEST['page'])? $_REQUEST['page'] : 1;
	$sKey = (isset($_REQUEST["sKey"]) && $_REQUEST["sKey"]!='')? $_REQUEST["sKey"] : '';
	$sLeadType = (isset($_REQUEST["sLeadType"]) && $_REQUEST["sLeadType"]!='')? $_REQUEST["sLeadType"] : '';
	$sRating = (isset($_REQUEST["sRating"]) && $_REQUEST["sRating"]>0)? $_REQUEST["sRating"] : 0;
	$sEmployee = (isset($_REQUEST["sEmployee"]) && $_REQUEST["sEmployee"]>0)? $_REQUEST["sEmployee"] : 0;
	
	$sFromDt = (isset($_REQUEST["sFromDt"]) && $_REQUEST["sFromDt"]!='')? $_REQUEST["sFromDt"] : '';
	$sToDt = (isset($_REQUEST["sToDt"]) && $_REQUEST["sToDt"]!='')? $_REQUEST["sToDt"] : '';
	
	$queryStr = '';
	$actionUrl = ROOT.ADMIN_ENQUIRIES;
	$isAdmin = $session->isAdmin();
	$isMaster = $session->isMaster();
	
	if(isset($_POST['asignToEmp']))
	{
		if(isset($_POST['empId']) && $_POST['empId']>0 && isset($_POST['contactId']) && count($_POST['contactId'])>0)
		{
			$db->insertUpdateRecord("UPDATE `".TBL_CONTACTS."` SET `emp_id`='".$_POST['empId']."' WHERE `id` IN (".implode(", ", $_POST['contactId']).")");
		}
	}
	if(!$isAdmin)
	{
		$sEmployee = $session->getUserId();
	}
	
	if($sKey!='') 
	{
		$queryStr .= " AND (`name` LIKE '%".$sKey."%' OR `email` LIKE '%".$sKey."%') ";
	}
	if($sLeadType!='')
	{
		if($sLeadType==1)
		{
			$queryStr .= " AND `emp_id`>0 ";
		}
		else if($sLeadType==2)
		{
			$queryStr .= " AND (`emp_id`=0 OR `emp_id` IS NULL) ";
		}
	}
	if($sRating>0) 
	{
		$queryStr .= " AND `rating` = '".$sRating."' ";
	}
	if($sEmployee>0) 
	{
		$queryStr .= " AND `emp_id` = '".$sEmployee."' ";
	}
	if($sFromDt!='')
	{
		$queryStr .= " AND `date_added`>='".date('Y-m-d 00:00:00', strtotime($sFromDt))."' ";
	}
	if($sToDt!='')
	{
		$queryStr .= " AND `date_added`<='".date('Y-m-d 23:59:59', strtotime($sToDt))."' ";
	}
	
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_CONTACTS."` WHERE 1=1 ".$queryStr);
	$totalRecords = $countResult['totalRecords'];
	
	$enqarr = $db->getRecordsArray("SELECT *, (SELECT `emp`.`display_name` FROM `".TBL_EMPLOYEES."` `emp` WHERE `emp`.`id`=`emp_id`) `EmployeeName` FROM `".TBL_CONTACTS."` WHERE 1=1 ".$queryStr." ORDER BY `id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);

	$empArr = $db->getRecordsArray("SELECT * FROM `".TBL_EMPLOYEES."` WHERE `department`<>1 AND `is_active`=1");
	
	$searchCriteria = array(
		array('name' => 'sKey', 'value' => $sKey),
		array('name' => 'sFromDt', 'value' => $sFromDt),
		array('name' => 'sToDt', 'value' => $sToDt)
	);	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
	
?>
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
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<input type="date" name="sFromDt"  class="form-control" value="<?php echo (isset($sFromDt) && $sFromDt!='')? date("Y-m-d",strtotime($sFromDt)) : ''; ?>"  data-toggle="tooltip" data-title="From Date">
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<input type="date" name="sToDt" class="form-control" value="<?php echo (isset($sToDt) && $sToDt!='')? date("Y-m-d",strtotime($sToDt)) : ''; ?>"  data-toggle="tooltip" data-title="To Date">
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<select class="form-control input-sm" id="sRating" name="sRating">
											<option value="">-- Rating --</option>
											<?php
												foreach($RATING_ARR as $key => $val)
												{
													echo '<option value="'.$key.'" '.(($sRating==$key)? 'selected' : '').'>'.$val.'</option>';
												}
											
											?>
										</select>
									</div>
									<?php if($isAdmin) { ?>
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<select class="form-control input-sm" id="sRating" name="sEmployee">
											<option value="">-- Employee --</option>
											<?php 
												foreach($empArr as $emp)
												{
													echo '<option value="'.$emp['id'].'"  '.(($sEmployee==$emp['id'])? 'selected' : '').'>'.$emp['display_name'].'</option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<select class="form-control input-sm" id="sLeadType" name="sLeadType">
											<option value="" <?php echo ($sLeadType=='')? 'selected' : ''; ?>>-- All Leads --</option>
											<option value="1" <?php echo ($sLeadType=='1')? 'selected' : ''; ?>> Alloted </option>
											<option value="2" <?php echo ($sLeadType=='2')? 'selected' : ''; ?>> Not-Alloted </option>
											
										</select>
									</div>
									<?php } ?>
									<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
										<input type="text" class="form-control input-sm" placeholder="Name, Email, Phone" id="sRegCode" name="sKey" value="<?php echo $sKey; ?>" />
									</div>
									<!--<div class="col-lg-12 col-sm-12 col-md-12 col-12 my-1 text-right">
										<input type="submit" name="doSearch" value="Search" class="btn btn-sm btn-primary" />
									</div>-->
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
			<div class="dashboard_property">
				<form name="propertyeqform" action="" method="POST">
					<div class="">
						<table class="table table-bordered table-hover table-responsive table-striped font-12" style="overflow-wrap: anywhere;">
							<thead class="thead-dark">
								<tr>
									<?php if($isAdmin) { ?>
										<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll();" /></th>
									<?php } ?>
									<th>Name</th>
									<th style="width: 20%;">Email</th>
									<th>Phone</th>
									<th>Rating</th>
									<th>Subject</th>
									<th>Message</th>
									<th>Date</th>
									<th>Employee</th>
									<th style="width: 10%;" class="text-right"><i class="fa fa-bolt"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
									/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
									$prpobj->orderBy("en.id","DESC");
									$enqarr=$prpobj->get(TBL_CONTACTS." en",null,"*"); */
									if(count($enqarr)>0)
									{
										foreach($enqarr AS $enq){
								?>
									<tr>
										<?php if($isAdmin) { ?>
											<td><input type="checkbox" class="check-all" name="contactId[]" value="<?php echo $enq['id']; ?>" /></td>
										<?php } ?>
										<td><?php echo $enq["name"]; ?></td>
										<td><?php echo $enq["email"]; ?></td>
										<td><?php echo $enq["phone"]; ?></td>
										<td class="text-center">
											<?php 
												$enqRating = isset($RATING_ARR[$enq["rating"]])? $RATING_ARR[$enq["rating"]] : '';
												switch($enq["rating"])
												{
													case 1;
														$btn = 'btn-success';
														break;
													case 2;
														$btn = 'btn-warning';
														break;
													case 3;
														$btn = 'btn-info';
														break;
													case 4;
														$btn = 'btn-danger';
														break;
												}
												if($enqRating!='')
												{
													echo '<button class="btn btn-xs '.$btn.'">'.$enqRating.'</button>';
												}
											?>
										</td>	
										<td><?php echo $enq["subject"]; ?></td>                
										<td><textarea class="form-control-sm" rows="2"><?php echo $enq["message"]; ?></textarea></td>   
										<td><?php echo $function->getDateFormat($enq["date_added"], 'd-M-Y');?></td>  											
										<td><?php echo $enq["EmployeeName"];?></td>  
										<td class="text-right">
											<a href="<?php echo ROOT.ADD_CONTACT_ACTIVITY.$enq["id"]."/"; ?>" class="btn btn-xs btn-outline-info"><i class="fa fa-comment-dots"></i></a>
											<a href="javascript:void(0);" class="btn btn-xs btn-outline-info" id="conv_view" data-id="<?php echo $enq["id"]?>"><i class="fa fa-eye"></i></a>
											<!-- data-toggle="modal" data-target="#view_conversation" -->
										</td>                
									</tr>
								<?php 
										}
									}
									else
									{
										echo '<tr><td colspan="'.(($isAdmin)? '10' : '9').'" class="text-center">No records found.</td></tr>';
									}
								?>
							</tbody>
						</table>
						<?php if($isAdmin) { ?>
							<div class="row p-15">
								<div class="col-lg-4 col-md-4">
									<?php 
										if(isset($empArr) && count($empArr)>0)
										{
									?>
											<div class="input-group">
												<select class="form-control" name="empId" style="height: 34px !important;">
													<option value=""> Allot To </option>
													<?php 
														foreach($empArr as $emp)
														{
															echo '<option value="'.$emp['id'].'">'.$emp['display_name'].'</option>';
														}
													?>
												</select>           
												<span class="input-group-btn">
													<button class="btn btn-danger" style="padding: 6px;" type="submit" name="asignToEmp"> Allot </button>
												</span>
											</div>
									
									<?php
										}
									?>
								</div>
								<div class="col-lg-4 col-md-4"></div>
								<div class="col-lg-4 col-md-4"></div>
							</div>
						<?php } ?>
					</div>
				</form>
				<div class="row p-15">
					<div class="col-lg-4 col-md-4"></div>
					<div class="col-lg-4 col-md-4">
						<?php
							if(count($enqarr)>0)
							{
								$function->createPagination($paginationArry, $searchCriteria);
							}
						?>
					</div>
					<div class="col-lg-4 col-md-4"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>

<div class="modal fade" id="view_conv_modal" tabindex="-1" role="dialog" aria-labelledby="authomessage" aria-hidden="true">
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
								<th style="width:60%;">Comment</th>
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


$(document).on('click', '#conv_view', function(event) {
	event.preventDefault();
	var convId = $(this).data('id');
	/* $(this).parent().remove(); */
	var ratingsArr = <?php echo json_encode($RATING_ARR); ?>;
	if(convId!='')
	{
		$("#view_conv_modal").modal("show");
		
		$.ajax({
			url: '<?php echo ROOT?>ajax/prop-ajax.php',
			type: 'POST',
			data: 'action=viewconv&id='+convId+'&type=enquiry',
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
});

function checkAll()
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
	}
</script>