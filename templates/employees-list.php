<?php

	$pageNo = isset($_GET['page'])? $_GET['page'] : 1;
	$sKey = (isset($_REQUEST["sKey"]) && $_REQUEST["sKey"]!='')? $_REQUEST["sKey"] : '';
	$sRole = (isset($_REQUEST["sRole"]) && $_REQUEST["sRole"]!='')? $_REQUEST["sRole"] : '';
	$sDepartment = (isset($_REQUEST["sDepartment"]) && $_REQUEST["sDepartment"]!='')? $_REQUEST["sDepartment"] : '';
	$sStatus = (isset($_REQUEST["sStatus"]) && $_REQUEST["sStatus"]>=0)? $_REQUEST["sStatus"] : 1;
	
	$actionUrl = ROOT.LIST_EMPLOYEE;
	$queryStr = '';
	
	if($sKey!='') 
	{
		$queryStr .= " AND (`display_name` LIKE '%".$sKey."%' OR `email` LIKE '%".$sKey."%' OR `phone` LIKE '%".$sKey."%' OR `user_name` LIKE '%".$sKey."%' OR `emp_code` LIKE '%".$sKey."%') ";
	}
	if($sStatus!='') 
	{
		$queryStr .= " AND `is_active`='".$sStatus."' ";
	}
	if($sRole!='') 
	{
		$queryStr .= " AND `emp_role`='".$sRole."' ";
	}
	if($sDepartment!='') 
	{
		$queryStr .= " AND `department`='".$sDepartment."' ";
	}
	
	$recordsFrom = (($pageNo-1)*RECORDS_LIMIT);
	
	$countResult = $db->getSingleRowArray("SELECT COUNT(*) `totalRecords` FROM `".TBL_EMPLOYEES."` WHERE `department`<>1 ".$queryStr);
	$totalRecords = $countResult['totalRecords'];
	
	
	$searchCriteria = array(
		array('name' => 'sKey', 'value' => $sKey),
		array('name' => 'sRole', 'value' => $sRole),
		array('name' => 'sDepartment', 'value' => $sDepartment),
		array('name' => 'sStatus', 'value' => $sStatus)
	);	
	
	$paginationArry = array(
		'pageNo' => $pageNo, 
		'pageLimit' => PAGES_LIMIT, 
		'recordsLimit' => RECORDS_LIMIT, 
		'totalRecords' => $totalRecords,
		'baseUrl' => $actionUrl
	);
							
	$empArr = $db->getRecordsArray("SELECT * FROM `".TBL_EMPLOYEES."` WHERE `department`<>1 ".$queryStr." ORDER BY `id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT);

	//echo "SELECT * FROM `".TBL_LOGIN."` WHERE `log_type`<>1 ORDER BY `log_id` DESC LIMIT ".$recordsFrom.", ".RECORDS_LIMIT;
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
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<input type="text" class="form-control input-sm" placeholder="Name, Email, Phone" id="sRegCode" name="sKey" value="<?php echo $sKey; ?>" />
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sStatus" class="form-control input-sm inputselct" name="sStatus" >
											<option value="1" <?php echo ($sStatus=='1')? 'selected' : ''; ?> > Active </option>
											<option value="0" <?php echo ($sStatus=='0')? 'selected' : ''; ?> > In-Active </option>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sDepartment" class="form-control input-sm inputselct" name="sDepartment" >
											<option value="" <?php echo (($sDepartment=="")? 'selected' : '')?>> Department </option>
											<?php
												foreach($DEPARTMENTARR as $key => $val)
												{
													if($key!=1)
													{
														echo '<option value="'.$key.'" '.(($sDepartment==$key)? "selected" : "").'>'.$val.'</option>';
													}
												}
											
											?>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3 col-md-2 col-12 my-1">
										<select id="sRole" class="form-control input-sm inputselct" name="sRole" >
											<option value="" <?php echo (($sRole=="")? 'selected' : '')?>> Role </option>
											<?php
												foreach($ROLEARR as $key => $val)
												{
													echo '<option value="'.$key.'" '.(($sRole==$key)? "selected" : "").'>'.$val.'</option>';
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
							<h4 class="mb-0">All Employees </h4>
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-right">
							<a href="<?php echo ROOT.ADD_EMPLOYEE; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Employee</a>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>Emp Code</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Status</th>
									<th>Added Dt</th>
									<th>Action</th>
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
									if(count($empArr)>0)
									{
										foreach($empArr AS $emp){
								?>
									<tr>
										<td><?php echo $emp["emp_code"]; ?></td>
										<td><?php echo $emp["first_name"].' '.$emp["last_name"]; ?></td>
										<td><?php echo $emp["user_name"]; ?></td>
										<td><?php echo isset($DEPARTMENTARR[$emp["department"]])? $DEPARTMENTARR[$emp["department"]] : ''; ?></td>                
										<td><?php echo ($emp["is_active"]==1)? 'Active' : 'In-Active'; ?></td>                
										<td><?php echo $function->getDateFormat($emp["created_date"], "d-M-Y H:i"); ?></td>                
										<td><a href="<?php echo ROOT.EDIT_EMPLOYEE.$emp["id"]."/"; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a></td>                
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
						if(count($empArr)>0)
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