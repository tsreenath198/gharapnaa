<?php $isAdmin = $session->isAdmin(); ?>
<div class="container">
	<div class="row">
		<div class="col text-center">
			<div class="sec-heading center">
				<h2><?php echo $CATARR[$cat]?></h2>
			</div>
		</div>
	</div>
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
									<!--<div class="col-sm-3 col-md-3 col-12">
										<select id="ptypes" class="form-control input-sm inputselct" name="sPropertyId">
											<option value="">Select</option>
											<?php
												/* foreach($CATARR as $key => $val)
												{
													echo '<option value="'.$key.'" '.(($sPropertyId==$key)? "selected" : "").'>'.$val.'</option>';
												} */
											
											?>
										</select>
									</div>-->
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
									<?php 
										if($cat!='' && $cat!=3 && $cat!=5)
										{
									?>
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
										} else {
									?>
											<div class="col-lg-2 col-sm-4 col-md-2 col-6 my-1">
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
									<?php
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
								<hr />
								<div class="row">
									<?php 
										if($cat!='' && $cat!=3 && $cat!=5)
										{
									?>
											<div class="col-lg-6 col-md-6 col-sm-12 col-12">
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
													<!--<input type="text" class="js-range-slider" name="my_range" value="" data-min="0" data-max="10000000" data-from="<?php //echo $price_from_min; ?>" data-to="<?php //echo $price_to_max; ?>"/> -->
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-12">
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
													<input type="text" class="js-range-slider-area" name="my_area" value="" data-min="0" data-max="1000000"  data-from="<?php //echo $area_from_min; ?>" data-to="<?php //echo $area_to_max; ?>" />
												</div>-->
											</div>
									<?php
										} 
										else
										{
									?>
											<div class="col-lg-6 col-md-6 col-sm-12 col-12">
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
															<input type="text" class="js-range-slider" name="plot_price_range" value="" data-min="0" data-max="10000000" data-from="<?php //echo $plot_price_from_min; ?>" data-to="<?php //echo $plot_price_to_max; ?>"/>
														</div>-->
													</div>
												</div>	
											</div>
									
									<?php
											if($cat==3)
											{
									?>
												<div class="col-lg-6 col-md-6 col-sm-12 col-12">
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
											}
											else
											{
									?>
												<div class="col-lg-6 col-md-6 col-sm-12 col-12">
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
											}
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
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<?php 
			if(count($proarr)>0)
			{
				foreach ($proarr as $key => $prop) {	
		?>
		<!-- Single Property -->
		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="property-listing property-2">
				<div class="listing-img-wrapper">
					<div class="list-img-slide">
						<div class="click">
							<?php 
								$proimgarr = $db->getRecordsArray("SELECT * FROM ".TBL_GALLERY." WHERE pr_id='".$prop['pr_id']."'");
								if(count($proimgarr)>0){
								foreach ($proimgarr as $key => $img) {	
							?>
								<div><a href="<?php echo ROOT.($isAdmin? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$img["pr_img"]?>" class="img-fluid mx-auto" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';"></a></div>
							<?php 
								} 
							}else {
							?>
								<div><a href="<?php echo ROOT.($isAdmin? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/1.jpg"; ?>" class="img-fluid mx-auto" alt=""></a></div>
							<?php
							}
							?>
						</div>
					</div>
				</div>

				<div class="listing-detail-wrapper">
					<div class="listing-short-detail-wrap">
						<div class="_card_list_flex mb-2">
							<div class="_card_flex_01">
								<span class="_list_blickes types"><?php echo $CATARR[$cat]?></span>
							</div>
							<div class="_card_flex_last">
								<h6 class="listing-card-info-price mb-0">&#8377;<?php echo ($cat != 3 && $cat!=5)? $prop["pr_cost"] : $prop["pr_plot_cost"]; ?></h6>
							</div>
						</div>
						<!--<div class="_card_list_flex">
							<div class="_card_flex_01">
								<h4 class="listing-name verified"><a href="#" class="prt-link-detail"><?php echo $LOCATNARR[$prop["pr_location"]]?></a></h4>
							</div>
						</div>-->
					</div>
				</div>
				<?php
					if($cat != 3 && $cat!=5)
					{
				?>
						<div class="price-features-wrapper px-1 text-center">
							<div class="list-fx-features">
								<div class="listing-card-info-icon">
									<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bed.svg" alt="" width="13"></div><?php echo $prop["pr_bhk"]?>
								</div>
								<div class="listing-card-info-icon">
									<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bathtub.svg" alt="" width="13"></div><?php echo $prop["pr_bath"]?> Bath
								</div>
								<div class="listing-card-info-icon">
									<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php //echo $prop["pr_build"]?> <?php echo ($cat==1)? $prop["pr_build"].' sq.ft' : $prop["pr_total_area"].' sq.yd'; ?>
								</div>
							</div>
						</div>
				<?php					
					} else if($cat == 3) {
						
				?>
						<div class="price-features-wrapper font-12">
							<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php echo $prop["pr_plot_area"].' sq.yd'; ?>
						</div>
				<?php
					} else if($cat == 5) {
				?>
						<div class="price-features-wrapper font-12">
							<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php echo (($prop["pr_area_in_acre"]>0)? $prop["pr_area_in_acre"] : 0).' Acres '.(($prop["pr_area_in_guntha"]>0)? $prop["pr_area_in_guntha"] : 0).' Gunthas' ; ?>
						</div>
				<?php											
					}
				?>
				<div class="listing-detail-footer">
					<div class="footer-first">
						<div class="foot-location"><img src="<?php echo ROOT?>assets/img/pin.svg" alt="" width="18"><?php echo $LOCATNARR[$prop["pr_location"]]?></div>
					</div>
					<div class="footer-flex">
						<ul class="selio_style">
							<?php if(!$isAdmin) { ?>
								<li>
									<?php 
										$wlId = (isset($prop['wl_id']) && $prop['wl_id']>0)? $prop['wl_id'] : 0;
										$clsdang = ($wlId>0)?"text-danger":""; 
									?>
									<div class="prt_saveed_12lk">
										<label class="toggler toggler-danger btnwish <?php echo $clsdang?>" data-toggle="tooltip" data-id="<?php echo $prop['pr_id']?>" data-wlid="<?php echo $wlId?>" data-placement="top" data-original-title="Save property"><input type="checkbox"><i class="ti-heart"></i></label>
									</div>
								</li>
							<?php } ?>
							<li>
								<div class="prt_saveed_12lk">
									<a href="<?php echo ROOT.($isAdmin? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>" data-toggle="tooltip" data-placement="top" data-original-title="View Property"><i class="ti-arrow-right"></i></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<!-- End Single Property -->
		<?php 
				}
			}
			else
			{
				echo '<div class="col-12 text-center"> No records found.</div>';
			}
		?>		
	</div>	
	<?php 
		if(count($proarr)>0)
		{
			$function->createPagination($paginationArry, $searchCriteria);
		}				
	?>
</div>
