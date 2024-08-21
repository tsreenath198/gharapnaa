<?php 
	$isAdmin = $session->isAdmin();
	$isMaster = $session->isMaster();
	
?>
<div class="dashboard-body">
	<!--<div class="row">
		<div class="col-lg-12 col-md-12">
			<div id="accordion">
				<div class="card">
					<div class="card-header" data-toggle="collapse" href="#openSearch">
						Search
						<a class="collapsed card-link float-right">
							<i class="fa fa-filter"></i>
						</a>
					</div>
					<div id="openSearch" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<form name="searchform" method="POST" action="<?php //echo $actionUrl.'/1'; ?>">
								<div class="row form-group">
									<div class="col-sm-3 col-md-3 col-12">
										<select id="ptypes" class="form-control input-sm inputselct" name="sPropertyId">
											<option value="">Property Type</option>
											<?php
												/* foreach($CATARR as $key => $val)
												{
													echo '<option value="'.$key.'" '.(($sPropertyId==$key)? "selected" : "").'>'.$val.'</option>';
												} */
											
											?>
										</select>
									</div>
									<div class="col-sm-3 col-md-3 col-12">
										<select id="txtlocation" class="form-control input-sm inputselct" name="sLocation">
											<option value="" <?php //echo ($sLocation=='')? 'selected' : ''; ?> > Location</option>
											<?php 
												//foreach($locationArr AS $loc){
											?>
												<option value="<?php //echo $loc["loc_id"]?>" <?php //echo ($sLocation==$loc["loc_id"])? 'selected' : ''; ?>><?php //echo $loc["loc_name"]?></option>
											<?php
												//}
											?>    
										</select>
									</div>
									<div class="col-sm-3 col-md-3 col-12">
										<input type="text" class="form-control input-sm" placeholder="Property Id" id="sRegCode" name="sRegCode" value="<?php //echo $sRegCode; ?>" />
									</div>
									<?php 
										//if($cat!='' && $cat!=3 && $cat!=5)
										//{
									?>
											<!--<div class="col-sm-3 col-md-3 col-12">
												<select id="txtbhk" name="bhk" class="form-control input-sm">
													<option value="" <?php //echo ($fibhk=='')? 'selected' : ''; ?>>-- Select BHK --</option> 
													<?php
														/* foreach($BHKARR as $val)
														{
															echo '<option value="'.$val.'" '.(($fibhk==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
														} */
													?>
												</select>
											</div>->
									
									<?php
										//}
									?>
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
	</div>-->
	<?php if($isAdmin) { ?>
		<nav class="nav nav-pills nav-fill mb-1" style="border: 1px solid #007bff;border-radius: 4px;">
			<a class="nav-item nav-link <?php echo ($cat<=0 || $cat=='')? "active disabled" : ""; ?>" href="<?php echo ROOT.(($cat<=0 || $cat=='')? ADMIN_PR_ALL : ADMIN_PR_ACTIVE).'1/'; ?>"><?php echo implode('-', array_map('ucfirst', explode('-', $type)));; ?> Properties</a>
			<a class="nav-item nav-link <?php echo ($cat==1)? "active disabled" : ""; ?>" href="<?php echo ROOT.ADMIN_APART_LIST.'1/'; ?>">Apartment</a>
			<a class="nav-item nav-link <?php echo ($cat==2)? "active disabled" : ""; ?>" href="<?php echo ROOT.ADMIN_HOME_LIST.'1/'; ?>">Independent Home</a>
			<a class="nav-item nav-link <?php echo ($cat==4)? "active disabled" : ""; ?>" href="<?php echo ROOT.ADMIN_VILLA_LIST.'1/'; ?>">Villa</a>
			<a class="nav-item nav-link <?php echo ($cat==3)? "active disabled" : ""; ?>" href="<?php echo ROOT.ADMIN_PLOT_LIST.'1/'; ?>">Plot</a>
			<a class="nav-item nav-link <?php echo ($cat==5)? "active disabled" : ""; ?>" href="<?php echo ROOT.ADMIN_AGRI_LAND_LIST.'1/'; ?>">Agriculture Land</a>
		</nav>
	<?php } ?>
	<div class="card mb-1">
		<div class="card-header c-header" data-toggle="collapse" href="#openSearch">
			<?php
				$recordsFrom = isset($recordsFrom)? $recordsFrom : 0;
				$totalRecords = isset($totalRecords)? $totalRecords : 0;
				if(count($proarr)>0) {
			?>
				Showing Records ( <?php echo ($recordsFrom+1); ?> to <?php echo $recordsFrom+count($proarr); ?> ) / <?php echo $totalRecords; ?> 
			<?php 
				} else { echo 'Search'; }
			?>
			<a class="collapsed card-link float-right">
				<i class="fa fa-filter"></i>
			</a>
		</div>
		<div id="openSearch" class="collapse" data-parent="#accordion">
			<div class="card-body">
				<form name="searchform" method="POST" action="<?php echo $actionUrl.'1/'; ?>">
					<div class="row">
						<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
							<select id="ptypes" class="form-control input-sm inputselct" name="sPropertyId" onchange="enableOption(this.value);" <?php echo (isset($isEnableType) && $isEnableType)? 'disabled' : ''; ?> >
								<option value="">Property Type</option>
								<?php
									foreach($CATARR as $key => $val)
									{
										echo '<option value="'.$key.'" '.(($sPropertyId==$key)? "selected" : "").'>'.$val.'</option>';
									}
								
								?>
							</select>
						</div>
						<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
							<input type="date" name="sFromDt"  class="form-control" value="<?php echo (isset($sFromDt) && $sFromDt!='')? date("Y-m-d",strtotime($sFromDt)) : ''; ?>"  data-toggle="tooltip" data-title="From Date">
						</div>
						<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
							<input type="date" name="sToDt" class="form-control" value="<?php echo (isset($sToDt) && $sToDt!='')? date("Y-m-d",strtotime($sToDt)) : ''; ?>"  data-toggle="tooltip" data-title="To Date">
						</div>
						<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
							<select id="txtlocation" class="form-control input-sm inputselct" name="sLocation">
								<option value="" <?php echo ($sLocation=='')? 'selected' : ''; ?> >Location</option>
								<?php 
									foreach($locationArr AS $loc){
								?>
									<option value="<?php echo $loc["loc_id"]?>" <?php echo ($sLocation==$loc["loc_id"])? 'selected' : ''; ?>><?php echo $loc["loc_name"]?></option>
								<?php
									}
								?>    
							</select>
						</div>
						<div class="col-lg-2 col-sm-4 col-md-2 col-12 my-1">
							<input type="text" class="form-control input-sm" placeholder="Property Id" id="sRegCode" name="sRegCode" value="<?php echo $sRegCode; ?>" />
						</div>
						<?php 
							if($isAdmin)
							{
								//if($cat!=3 && $cat!=5)
								//{
						?>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sCStatus" name="sCStatus" class="form-control input-sm">
											<option value="" <?php echo ($sCStatus=='')? 'selected' : ''; ?>>Construction Status</option> 
											<?php
												foreach($CONST_STATUS as $val)
												{
													echo '<option value="'.$val.'" '.(($sCStatus==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sFurnishType" name="sFurnishType" class="form-control input-sm">
											<option value="" <?php echo ($sFurnishType=='')? 'selected' : ''; ?>>-- Furnish Type --</option> 
											<?php
												foreach($FURNISH_TYPE as $val)
												{
													echo '<option value="'.$val.'" '.(($sFurnishType==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sBHK" name="sBHK" class="form-control input-sm">
											<option value="" <?php echo ($sBHK=='')? 'selected' : ''; ?>>-- BHK --</option> 
											<?php
												foreach($BHKARR as $val)
												{
													echo '<option value="'.$val.'" '.(($sBHK==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sBolcony" name="sBolcony" class="form-control input-sm">
											<option value="" <?php echo ($sBolcony=='-1')? 'selected' : ''; ?>>-- Bolcony --</option> 
											<?php
												foreach($BALCONY as $val)
												{
													echo '<option value="'.$val.'" '.(($sBolcony==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sBath" name="sBath" class="form-control input-sm">
											<option value="" <?php echo ($sBath=='-1')? 'selected' : ''; ?>>-- Bathrooms --</option> 
											<?php
												foreach($BALCONY as $val)
												{
													echo '<option value="'.$val.'" '.(($sBath==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sCparking" name="sCparking" class="form-control input-sm">
											<option value="" <?php echo ($sCparking=='-1')? 'selected' : ''; ?>> Covered Parking </option> 
											<?php
												foreach($COVERED_PARKING as $val)
												{
													echo '<option value="'.$val.'" '.(($sCparking==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<select id="sOparking" name="sOparking" class="form-control input-sm">
											<option value="" <?php echo ($sOparking=='-1')? 'selected' : ''; ?>>-- Open Parking --</option> 
											<?php
												foreach($OPEN_PARKING as $val)
												{
													echo '<option value="'.$val.'" '.(($sOparking==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>									
							<?php
								//} else {
							?>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 alplot <?php echo ($cat==3 || $cat==5)? '' : 'hide'; ?> ">
										<select id="sPstatus" name="sPstatus" class="form-control input-sm">
											<option value="" <?php echo ($sPstatus=='')? 'selected' : ''; ?>>Possession Status</option> 
											<?php
												foreach($POSS_STATUS as $val)
												{
													echo '<option value="'.$val.'" '.(($sPstatus==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
									<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1 alplot <?php echo ($cat==3 || $cat==5)? '' : 'hide'; ?> ">
										<select id="sRoadType" name="sRoadType" class="form-control input-sm">
											<option value="" <?php echo ($sRoadType=='')? 'selected' : ''; ?>>Road Type</option> 
											<?php
												foreach($ROAD_TYPES as $val)
												{
													echo '<option value="'.$val.'" '.(($sRoadType==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
									</div>
						<?php
								//}
						}
						?>
							<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
								<select id="sFacing" name="sFacing" class="form-control input-sm">
									<option value="" <?php echo ($sFacing=='')? 'selected' : ''; ?>>-- Facing --</option> 
									<?php
										foreach($FACARR as $key => $val)
										{
											echo '<option value="'.$key.'" '.(($sFacing==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
										}
									?>
								</select>
							</div>
					</div>
					<?php echo ($isAdmin)? '<hr />' : ''; ?>
					<div class="row">
						<?php 
							if($isAdmin)
							{
								//if($cat!=3 && $cat!=5)
								//{
						?>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<h6 style="font-size: 12px;">Price</h6>
										<div class="rg-slider">
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Minimum</span>
													<input type="number" class="form-control input-sm" min="0" name="price_from_min" value="<?php echo $price_from_min; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Maximum</span>
													<input type="number" class="form-control input-sm" min="0" name="price_to_max" value="<?php echo $price_to_max; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
												</div>
											</div>	
											<!--<input type="text" class="js-range-slider" name="my_range" value="" data-min="0" data-max="10000000" data-from="<?php echo $price_from_min; ?>" data-to="<?php echo $price_to_max; ?>"/> -->
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12 apartiv <?php echo ($cat!=3 && $cat!=5)? '' : 'hide'; ?>">
										<h6 style="font-size: 12px;"><?php echo($cat==1 || $cat=='')? 'Built Up' : 'Total '; ?> Area (<?php echo($cat==1 || $cat=='')? 'sq.ft' : 'sq.yd'; ?>)</h6>
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-6">
												<span class="range-legend">Minimum</span>
												<input type="number" class="form-control input-sm" min="0" name="area_from_min" value="<?php echo $area_from_min; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<span class="range-legend">Maximum</span>
												<input type="number" class="form-control input-sm" min="0" name="area_to_max" value="<?php echo $area_to_max; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
											</div>
										</div>	
										<!--<div class="rg-slider">
											<input type="text" class="js-range-slider-area" name="my_area" value="" data-min="0" data-max="1000000"  data-from="<?php echo $area_from_min; ?>" data-to="<?php echo $area_to_max; ?>" />
										</div>-->
									</div>
							<?php
								//} 
								//else
								//{
							?>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12 alplot <?php echo ($cat==3 || $cat==5)? '' : 'hide'; ?>">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<h6 style="font-size: 12px;">Price</h6>
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6">
														<span class="range-legend">Minimum</span>
														<input type="number" class="form-control input-sm" min="0" name="plot_price_from_min" value="<?php echo $plot_price_from_min; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6">
														<span class="range-legend">Maximum</span>
														<input type="number" class="form-control input-sm" min="0" name="plot_price_to_max" value="<?php echo $plot_price_to_max; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
													</div>
												</div>	
												<!--<div class="rg-slider">
													<input type="text" class="js-range-slider" name="plot_price_range" value="" data-min="0" data-max="10000000" data-from="<?php echo $plot_price_from_min; ?>" data-to="<?php echo $plot_price_to_max; ?>"/>
												</div>-->
											</div>
										</div>	
									</div>
						
							<?php
									//if($cat==3)
									//{
							?>
										<div class="col-lg-6 col-md-6 col-sm-12 col-12 alplot plotarea <?php echo ($cat==3)? '' : 'hide'; ?> ">
											<h6 style="font-size: 12px;">AREA (sq.yd)</h6>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Minimum</span>
													<input type="number" class="form-control input-sm" min="0" name="plot_area_from_min" value="<?php echo $plot_area_from_min; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Maximum</span>
													<input type="number" class="form-control input-sm" min="0" name="plot_area_to_max" value="<?php echo $plot_area_to_max; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="" />
												</div>
											</div>
										</div>
							<?php
									//}
									//else
									//{
							?>
										<div class="col-lg-6 col-md-6 col-sm-12 col-12 alplot alarea <?php echo ($cat==5)? '' : 'hide'; ?> ">
											<h6 style="font-size: 12px;">AREA (Acre's)</h6>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Minimum</span>
													<input type="number" class="form-control input-sm" min="0" max="998" id="al_area_from_min" name="al_area_from_min" value="<?php echo $al_area_from_min; ?>" maxlength="3" placeholder="" />
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<span class="range-legend">Maximum</span>
													<input type="number" class="form-control input-sm" min="0" max="999" id="al_area_to_max" name="al_area_to_max" value="<?php echo $al_area_to_max; ?>" maxlength="3" placeholder="" />
												</div>
											</div>
										</div>
						<?php
									//}
								//}
							}
						?>
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
	<!-- <div class="row">
		<div class="col-lg-6 col-md-6 col-12">
			Showing Records (<?php //echo ($recordsFrom+1); ?> to <?php //echo $recordsFrom+RECORDS_LIMIT; ?>) / <?php //echo $totalRecords; ?>
		</div>
	</div>-->
	<div class="row">
		<div class="col-lg-12 col-md-12">
				<div class="dashboard_property">
					<div class="">
						<table class="table table-bordered table-hover table-responsive table-striped font-12">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Property Id</th>
									<th scope="col">Property</th>
									<th scope="col">Added By</th>
									<th scope="col" class="m2_hide">Posted On</th>
									<th scope="col">Status</th>
									<th scope="col" class="text-right"><i class="fa fa-bolt"></i></th>
								</tr>
							</thead>
							<tbody>
								<!-- tr block -->
								<?php
									/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
									$prpobj->where("u_id",$_SESSION["UID"]);
									$prpobj->join("property_gallery pg","pg.pr_id=pr.pr_id","INNER");
									$proarr=$prpobj->get("property pr",null,"*"); */
									
									if(count($proarr)>0)
									{
										foreach($proarr AS $prop){
								?>
									<tr>
										<td>
											<div class="_leads_posted"><a href="<?php echo ROOT.(($isAdmin)? ADMIN_PROPERTY_EDIT : USER_PROPERTY_EDIT).$prop['pr_id'].'/'; ?>" ><?php echo $prop["pr_reg_code"]; ?></a></div>
										</td>
										<td>
											<div class="dash_prt_wrap">
												<div class="dash_prt_thumb">
													<a href="<?php echo ROOT.(($isAdmin)? ADMIN_PROPERTY_EDIT : USER_PROPERTY_EDIT).$prop['pr_id'].'/'; ?>" ><img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$prop["pr_img"]?>" class="img-fluid" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" /></a>
												</div>
												<div class="dash_prt_caption">
													<h5> <a href="<?php echo ROOT.(($isAdmin)? ADMIN_PROPERTY_EDIT : USER_PROPERTY_EDIT).$prop['pr_id'].'/'; ?>" ><?php echo $CATARR[$prop["pr_cat"]]?></a></h5>
													<div class="prt_dashb_lot"><?php echo $LOCATNARR[$prop["pr_location"]]?></div>
													<div class="prt_dash_rate"><span>₹<?php echo ($prop["pr_cat"]==3 || $prop["pr_cat"]==5)? $prop["pr_plot_cost"] : $prop["pr_cost"]?></span></div>
												</div>
											</div>
										</td>
										<td>
										<?php 
											if(isset($prop["u_name"]) && isset($prop["u_email"]) && isset($prop["u_phone"])) {
												if($prop["u_name"]!='' || $prop["u_email"]!='' || $prop["u_phone"]!='') { 
										?>
													<div class="dash_prt_wrap">
														<div class="dash_prt_caption">
															<h5></h5>
															<div class="prt_dashb_lot"><?php echo $prop["u_name"];?></div>
															<div class="prt_dashb_lot"><?php echo $prop["u_email"];?></div>
															<div class="prt_dashb_lot"><?php echo $prop["u_phone"];?></div>
														</div>
													</div>
										<?php 
												} else {
													echo '<td>You</td>';
												} 
											}
										?>
										</td>
										<td class="m2_hide">
											<div class="_leads_posted"><h5><?php echo Date("d-m Y h:i",strtotime($prop["pr_date"]))?></h5></div>
											<!-- <div class="_leads_view_title"><span>16 Days ago</span></div> -->
										</td>
										<td class="">
											<?php echo ($prop["pr_is_publish"]==1)? "Published" : (($prop["pr_is_publish"]==2)? "Unpublished" : "Pending"); ?>
											<!-- <div class="_leads_view_title"><span>16 Days ago</span></div> -->
										</td>
										<td class="text-right">
											<div class="btn-group btn-group-sm">
												<?php if($isMaster) { ?>
													<button type="button" class="<?php echo (isset($prop['pr_status']) && $prop['pr_status']==1)? 'btn-info' : 'btn-inverse' ?> btnstatus"  data-id="<?php echo $prop["pr_id"]?>" data-status="<?php echo (isset($prop["pr_status"])&&$prop["pr_status"]==1)? '0' : '1'?>" data-toggle="tooltip" data-placement="top" title="<?php echo ($prop['pr_status']==1)? 'Make In-Active..?' : 'Active..?' ?>">
														<a href="#" class="text-white"><i class="fas fa-star"></i></a>
													</button>
													<button type="button" class="btn-danger btndelete"  data-toggle="tooltip" data-placement="top" title="Delete..?" data-pr="<?php echo $prop["pr_id"]?>"><a href="#" class="text-white"><i class="fas fa-trash" ></i></a></button>
												<?php } else { ?>
														<a href="<?php echo ROOT.(($isAdmin)? ADMIN_PROPERTY_EDIT : USER_PROPERTY_EDIT).$prop['pr_id'].'/'; ?>" class="btn btn-xs btn-outline-info float-right"><i class="fa fa-eye"></i></a>
														<!--echo '<button type="button" class="btn-xs btn-danger btnstatus" data-status="'.((isset($prop["pr_status"])&&$prop["pr_status"]==1)? '0' : '1').'" data-id="'.$prop["pr_id"].'"><a href="#" class="text-white"><i class="fas fa-trash"></i></a></button>';-->
												<?php } ?>
											</div>
										</td>
									</tr>	
								<?php 
										}
									} else {
										echo '<tr class="text-center"><td colspan="5">No records found.</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4">
							
						</div>
						<div class="col-lg-4 col-md-4">
							<?php
								if(count($proarr)>0)
								{
									$function->createPagination($paginationArry, $searchCriteria);
								}
							?>
						</div>
					</div>
				</div>
		</div>
	</div>
<!-- row -->


</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on("click",".btnstatus",function(e){
			e.preventDefault();
			//btnsts= $(this);
			if(confirm("Are you want to change the property status ?"))
			{
				$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				var status = $(this).data("status");
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:{"action":"propertystatus","prid":$(this).data("id"),"status":$(this).data("status")} ,
					success:function(response){
						jsn=$.parseJSON(response);
						//$(".btn-status-color-"+status).removeClass("btn-info").removeClass("btn-primary").addClass(((status==1)? 'btn-primary' : 'btn-info'));
						$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
						location.reload();
					}
				})
				.done(function() {
					//console.log("success");
				});
			}
		});

		$(document).on("click",".btndelete",function(e){
			e.preventDefault();
			btndel= $(this);
			if(confirm("Are you want to delete property ?"))
			{
				$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:{"action":"delproprty","prid":$(this).data("pr")} ,
					success:function(response){
						//console.log(response);	

						jsn=$.parseJSON(response);
						/* if(jsn.type=="success"){
							btndel.closest("tr").remove();
						} */
						$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
						location.reload();
					}
				})
				.done(function() {
					console.log("success");
				});
			}
		});

	//jQuery(document).ready(function($) {
/* 	    $(document).on("click",".btnsts",function(e){
	 e.preventDefault();
	btnsts= $(this);
$.ajax({
	url: '<?php echo ROOT?>ajax/prop-ajax.php',
	type: 'POST',
	data:{"action":"stsproprty","prid":$(this).data("id"),"sts":$(this).data("sts")} ,
	success:function(response){
		console.log(response);	

		jsn=$.parseJSON(response);
		if(jsn.sts=="01"){
location.reload();

		}
	}
})
.done(function() {
	console.log("success");
});

}); */

	});
</script>
<script>
	function enableOption(val)
	{
		$(".apartiv, .alplot, .plotarea, .alarea").addClass('hide');
		if(val==3)
		{
			$(".alplot, .plotarea").removeClass("hide");
			$(".alarea").addClass("hide");
		}
		else if(val==5)
		{
			$(".alplot, .alarea").removeClass("hide");
			$(".plotarea").addClass("hide");
		}
		else
		{
			$(".apartiv").removeClass("hide");
		}
	}
</script>