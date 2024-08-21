<?php

	$sKey = (isset($_REQUEST["sKey"]) && $_REQUEST["sKey"]!='')? $_REQUEST["sKey"] : '';
	$sStatus = (isset($_REQUEST["sStatus"]) && $_REQUEST["sStatus"]>=0)? $_REQUEST["sStatus"] : 1;
	
	$queryStr = '';
	$actionUrl = ROOT.ADMIN_USERS;
	
	if($sKey!='') 
	{
		$queryStr .= " AND (`u_name` LIKE '%".$sKey."%' OR `u_email` LIKE '%".$sKey."%' OR `u_phone` LIKE '%".$sKey."%' OR `u_user_id` LIKE '%".$sKey."%') ";
	}
	if($sStatus!='') 
	{
		$queryStr .= " AND `u_status`='".$sStatus."' ";
	}
	
	$pageNo = isset($_REQUEST['page'])? $_REQUEST['page'] : 1;
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_USER."` WHERE 1=1 ".$queryStr);
	$totalRecords = $countResult['totalRecords'];
	
	$searchCriteria = array(
		array('name' => 'sKey', 'value' => $sKey),
		array('name' => 'sStatus', 'value' => $sStatus)
	);	
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
	
	$userArr = $db->getRecordsArray("SELECT * FROM `".TBL_USER."` WHERE 1=1 ".$queryStr." ORDER BY `u_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);

//echo "SELECT * FROM `".TBL_USER."` WHERE 1=1 '".$queryStr."' ORDER BY `u_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
	//echo "SELECT COUNT(*) `totalRecords` FROM `".TBL_USER."`";
?>
<div class="dashboard-body">
	<div class="row">
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
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-12">
							<h4 class="mb-0">All Users </h4>
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-right">
							<!--<a href="<?php echo ROOT.ADD_EMPLOYEE; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Employee</a>-->
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>phone</th>
									<th>User Id</th>
									<th>Added Dt</th>
									<!--<th>Action</th>-->
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
									if(count($userArr)>0)
									{
										foreach($userArr AS $emp){
								?>
									<tr>
										<td><?php echo $emp["u_name"]; ?></td>
										<td><?php echo $emp["u_email"]; ?></td>
										<td><?php echo $emp["u_phone"]; ?></td>         
										<td><?php echo $emp["u_user_id"]; ?></td>                     
										<td><?php echo $function->getDateFormat($emp["u_date_added"], "d-M-Y H:i"); ?></td>                
										<!--<td><a href="<?php echo ROOT.EDIT_EMPLOYEE.'/'.$emp["id"]; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a></td>-->                
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
						if(count($userArr)>0)
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