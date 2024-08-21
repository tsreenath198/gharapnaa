<?php 

	/* $sLocations = getRecordsArray($conn, "SELECT `pr_location` FROM `".TBL_PROPERTY."` WHERE `pr_is_publish`=1 AND `pr_status`=1 GROUP BY `pr_location`");
	$locationArr = $locationMap = array();
	foreach($locarr AS $loc)
	{
		$locationMap[$loc['loc_id']] = isset($locationMap[$loc['loc_id']])? $locationMap[$loc['loc_id']] : array();
		$locationMap[$loc['loc_id']] = $loc;
	}
	
	foreach($sLocations as $key => $val)
	{
		$locationArr[] = array('loc_id' => $val['pr_location'], 'loc_name' => (isset($locationMap[$val['pr_location']]['loc_name'])? $locationMap[$val['pr_location']]['loc_name'] : ''));
	} */
?>
<div class="container">
	<!--<div class="row m-0">
		<div class="short_wraping">
			<div class="row align-items-center">
				<div class="col-lg-7 col-md-12 col-sm-12 order-lg-2 order-md-3  col-sm-12">
					<div class="shorting_pagination">
						<div class="shorting_pagination_laft">
							<h5>Showing <?php //echo $procnt?> results</h5>
						</div>
					</div>
				</div>

				<div class="col-lg-5 col-md-6 col-sm-12 order-lg-3 order-md-2 col-sm-6">
					<form id="p_search_form" name="propertySearchForm" method="post" action="">
						<div class="shorting-right">
							<label> &nbsp;</label>
							<div class="form-group">
								<div class="input-with-icon">
									<select id="txtcat" class="form-control" name="ptypes" onchange="formSubmit()">
										<option value="" <?php //echo ($ptypes=='')? 'selected' : ''; ?>>Type of property</option>
										<?php
											/* foreach($CATARR as $key => $val)
											{
												echo '<option value="'.$key.'" '.(($ptypes==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
											} */
										?>
									</select>
									<input type="submit" style="display:none;" name="propertySearch" id="propertySearch" />
								</div>
							</div>
						</div>
					</form>
					<script>
					function formSubmit()
					{
						$("#propertySearch").trigger('click');
					}
					</script>
				</div>
			</div>
		</div>
	</div>-->
	<div class="row">
		<div class="row col-md-12 col-lg-12">
			<!-- property Sidebar -->
			<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="search-stiky">
				<form name="frmfilter" method="POST">
					<div class="page-sidebar p-0">
						<a class="filter_links" data-toggle="collapse" href="#fltbox" role="button" aria-expanded="false" aria-controls="fltbox">Open Advance Filter<i class="fa fa-sliders-h ml-2"></i></a>
						<div class="collapse" id="fltbox">
							<!-- Find New Property -->
							<div class="sidebar-widgets p-4">
								<!--<input type="hidden" name="pr_cat" value="<?php //echo $ptypes; ?>" />-->
								<div class="form-group">
									<div class="input-with-icon">
										<select id="txtcat" class="form-control" name="ptypes" onchange="formSubmit()" required>
											<option value="" <?php echo ($ptypes=='')? 'selected' : ''; ?>>Type of property</option>
											<?php
												foreach($CATARR as $key => $val)
												{
													echo '<option value="'.$key.'" '.(($ptypes==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
												}
											?>
										</select>
										<!-- <input type="submit" style="display:none;" name="propertySearch" id="propertySearch" /> -->
									</div>
								</div>
								<script>
									function formSubmit()
									{
										$("#propertySearch").trigger('click');
									}
								</script>
								<div class="form-group">
									<div class="">
										<select id="txtlocation" class="form-control inputselct" name="txtlocation">
											<option value="" <?php echo ($filocal=='')? 'selected' : ''; ?> >All Location</option>
											<?php 
												foreach($locationArr AS $loc){
											?>
												<option value="<?php echo $loc["loc_id"]?>" <?php echo ($filocal==$loc["loc_id"])? 'selected' : ''; ?>><?php echo $loc["loc_name"]?></option>
											<?php
												}
											?>    
										</select>
									</div>
								</div>
								<?php 
									if(isset($ptypes) && $ptypes!=3 && $ptypes!=5)
									{
								?>
										<div class="form-group">
											<div class="input-with-icon">
												<select id="txtbhk" name="txtbhk" class="form-control">
													<option value="" <?php echo ($fibhk=='')? 'selected' : ''; ?>>-- Select BHK --</option> 
													<?php
														foreach($BHKARR as $val)
														{
															echo '<option value="'.$val.'" '.(($fibhk==$val)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
														}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="input-with-icon">
												<select id="consttype" name="consttype" class="form-control">
													<option value="" <?php echo ($constType=='')? 'selected' : ''; ?>>-- Construction Status --</option> 
													<?php
														foreach($CONST_STATUS as $key => $val)
														{
															echo '<option value="'.$key.'" '.(($constType==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
														}
													?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12">
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
										</div>									
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 pt-2">
												<h6 style="font-size: 12px;"><?php echo($ptypes==1 || $ptypes=='')? 'Built Up' : 'Total '; ?> Area (<?php echo($ptypes==1 || $ptypes=='')? 'sq.ft' : 'sq.yd'; ?>)</h6>
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
										</div>	
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 pt-2">
												<h6 style="font-size: 12px;">Advance Features</h6>
												<ul class="row p-0 m-0">
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-1" class="checkbox-custom" name="opnpark" type="checkbox" <?php echo ($filopnpark)? 'checked' : '';?> />
														<label for="a-1" class="checkbox-custom-label font-12">Open Parking</label>
													</li>
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-2" class="checkbox-custom" name="bacony" type="checkbox" <?php echo ($fibacony)? 'checked' : '';?>>
														<label for="a-2" class="checkbox-custom-label font-12">Balcony</label>
													</li>
													<!--<li class="col-lg-6 col-md-6 p-0">
														<input id="a-3" class="checkbox-custom" name="gaspip" type="checkbox" <?php //echo ($figaspip)? 'checked' : '';?>>
														<label for="a-3" class="checkbox-custom-label">Gas Pipeline</label>
													</li>
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-5" class="checkbox-custom" name="microwave" type="checkbox" <?php //echo ($filmicrowave)? 'checked' : '';?>>
														<label for="a-5" class="checkbox-custom-label">Microwave</label>
													</li>
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-6" class="checkbox-custom" name="petallow" type="checkbox" <?php //echo ($filpetallow)? 'checked' : '';?>>
														<label for="a-6" class="checkbox-custom-label">Pet Allow</label>
													</li>-->
													
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-3" class="checkbox-custom" name="cctv" type="checkbox" <?php echo ($filcctv)? 'checked' : '';?>>
														<label for="a-3" class="checkbox-custom-label font-12">CCTV</label>
													</li>
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-5" class="checkbox-custom" name="lift" type="checkbox" <?php echo ($fillift)? 'checked' : '';?>>
														<label for="a-5" class="checkbox-custom-label font-12">Lift</label>
													</li>
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-6" class="checkbox-custom" name="gatedcommunity" type="checkbox" <?php echo ($filgc)? 'checked' : '';?>>
														<label for="a-6" class="checkbox-custom-label font-12">Gated Community</label>
													</li>
													
													<li class="col-lg-6 col-md-6 p-0">
														<input id="a-8" class="checkbox-custom" name="furnshtyp" type="checkbox" <?php echo ($filfurnshtyp)? 'checked' : '';?>>
														<label for="a-8" class="checkbox-custom-label font-12">Furnished</label>
													</li>			
												</ul>
											</div>
										</div>
								<?php
									}
									else
									{
								?>
										<div class="form-group">
											<div class="input-with-icon">
												<select id="posstype" name="posstype" class="form-control">
													<option value="" <?php echo ($possType=='')? 'selected' : ''; ?>>-- Possesion Status --</option> 
													<?php
														foreach($POSS_STATUS as $key => $val)
														{
															echo '<option value="'.$key.'" '.(($possType==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
														}
													?>
												</select>
											</div>
										</div>
										<?php
											if(isset($ptypes) && $ptypes==5)
											{
										?>
												<!--<div class="form-group">
													<div class="input-with-icon">
														<select type="text" class="form-control txtlength" id="plot_unit" name="plot_unit">
															<option value="" <?php //echo ($plot_unit=='')? 'selected' : ''; ?>>-- Unit --</option> 
															<?php
																/* foreach($UNITARR as $val)
																{
																	echo '<option value="'.$val.'" '.(($plot_unit==$val)? 'selected': '').'>'.$val.'</option>';
																} */
															?>
														</select>
													</div>
												</div>-->
										<?php
											}
										?>
										
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

										<?php
											if(isset($ptypes) && $ptypes==3)
											{
										?>
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 pt-2">
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
														<!--<div class="rg-slider">
															<input type="text" class="js-range-slider-area" name="plot_area" value="" data-min="0" data-max="1000000"  data-from="<?php //echo $plot_area_from_min; ?>" data-to="<?php //echo $plot_area_to_max; ?>" />
														</div>-->
													</div>
												</div>	
										<?php
											}
											else
											{
										?>
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 pt-2">
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
															<!--<div class="col-lg-6 col-md-6 col-sm-6">
																<span class="range-legend">Acres</span>
																<input type="number" class="form-control input-sm" min="0" id="area_in_acre" name="area_in_acre" value="<?php //echo $area_in_acre; ?>" maxlength="3" placeholder="" />
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6">
																<span class="range-legend">Gunthas</span>
																<input type="number" class="form-control input-sm" min="0" id="area_in_guntha" name="area_in_guntha" value="<?php //echo $area_in_guntha; ?>" maxlength="2" placeholder="" />
															</div>-->
														</div>	
														<!--<div class="rg-slider">
															<input type="text" class="js-range-slider-area" name="plot_area" value="" data-min="0" data-max="1000000"  data-from="<?php //echo $plot_area_from_min; ?>" data-to="<?php //echo $plot_area_to_max; ?>" />
														</div>-->
													</div>
												</div>
										<?php
											}
										?>
										<!--<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 pt-2">
												<h6 style="font-size: 12px;">AREA <?php //echo (isset($ptypes) && $ptypes==3)? '(sq.yd)' : ((isset($plot_unit) && $plot_unit!='')? '('.$plot_unit.')' : ''); ?></h6>
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6">
														<span class="range-legend">Minimum</span>
														<input type="number" class="form-control input-sm" min="0" name="plot_area_from_min" value="<?php //echo $plot_area_from_min; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="Min." />
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6">
														<span class="range-legend">Maximum</span>
														<input type="number" class="form-control input-sm" min="0" name="plot_area_to_max" value="<?php echo $plot_area_to_max; ?>" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" placeholder="Max." />
													</div>
												</div>	
												<!--<div class="rg-slider">
													<input type="text" class="js-range-slider-area" name="plot_area" value="" data-min="0" data-max="1000000"  data-from="<?php echo $plot_area_from_min; ?>" data-to="<?php //echo $plot_area_to_max; ?>" />
												</div>--
											</div>
										</div>	-->
								<?php
									}
								?>
							
								<!--
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
										<h6>Choose Price</h6>
										<div id="slider-range" class="price-filter-range" name="rangeInput"></div>
											<div style="margin:30px auto">
												<input type="number" min=0 max="9999999" oninput="validity.valid||(value='1000');" name="price_from" id="min_price" class="price-range-field" />
												<input type="number" min=0 max="100000000" oninput="validity.valid||(value='100000000');"  name="price_to" id="max_price" class="price-range-field" />
											</div>
										</div>
									</div>	
								</div>
								-->
								<!--<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
										<h6>Choose Price</h6>
										<div class="rg-slider">
											<input type="text" class="js-range-slider" name="my_range" value="" data-min="0" data-max="10000000" data-from="<?php //echo $price_from_min; ?>" data-to="<?php //echo $price_to_max; ?>"/>
										</div>
									</div>
								</div>									
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
										<h6>BUILT UP AREA (SQ.FT.)</h6>
										<div class="rg-slider">
											<input type="text" class="js-range-slider-area" name="my_area" value="" data-min="0" data-max="10000"  data-from="<?php //echo $area_from_min; ?>" data-to="<?php //echo $area_to_max; ?>" />
										</div>
									</div>
								</div>	
	 
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 pt-4">
										<h6>Advance Features</h6>
										<ul class="row p-0 m-0">
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-1" class="checkbox-custom" name="opnpark" type="checkbox" <?php //echo ($filopnpark)? 'checked' : '';?> />
												<label for="a-1" class="checkbox-custom-label">Open Parking</label>
											</li>
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-2" class="checkbox-custom" name="bacony" type="checkbox" <?php //echo ($fibacony)? 'checked' : '';?>>
												<label for="a-2" class="checkbox-custom-label">Balcony</label>
											</li>
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-3" class="checkbox-custom" name="gaspip" type="checkbox" <?php //echo ($figaspip)? 'checked' : '';?>>
												<label for="a-3" class="checkbox-custom-label">Gas Pipeline</label>
											</li>
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-5" class="checkbox-custom" name="microwave" type="checkbox" <?php //echo ($filmicrowave)? 'checked' : '';?>>
												<label for="a-5" class="checkbox-custom-label">Microwave</label>
											</li>
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-6" class="checkbox-custom" name="smoktyp" type="checkbox" <?php //echo ($filsmoktyp)? 'checked' : '';?>>
												<label for="a-6" class="checkbox-custom-label">Smoking Allow</label>
											</li>
											<li class="col-lg-6 col-md-6 p-0">
												<input id="a-8" class="checkbox-custom" name="furnshtyp" type="checkbox" <?php //echo ($filfurnshtyp)? 'checked' : '';?>>
												<label for="a-8" class="checkbox-custom-label">Furnished</label>
											</li>			
										</ul>
									</div>
								</div>	-->
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 pt-4">
										<button type="submit" class="btn theme-bg rounded full-width" name="btnsubmit" id="propertySearch">Find New Property</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- Sidebar End -->	
</div>				
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class=" ">
					<div class="row ">
						<?php 
							//$lgmd=$proarr[1]?"6":"6";
							if($procnt>0){
							foreach ($proarr as $key => $prop) {
						?>
							<!-- Single Property -->
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="property-listing property-2">
									<div class="listing-img-wrapper">
										<div class="list-img-slide">
											<div class="click">
												<?php 
													$proimgarr = $db->getRecordsArray("SELECT * FROM ".TBL_GALLERY." WHERE pr_id='".$prop['pr_id']."'");
													if(count($proimgarr)>0){
														foreach ($proimgarr as $key => $img) {
												?>
													<div><a href="<?php echo ROOT."property-details/".$prop["pr_id"]."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$img["pr_img"]?>" class="img-fluid mx-auto" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" ></a></div>
												<?php 
														} 
													} else {
												?>
													<div><a href="<?php echo ROOT."property-details/".$prop["pr_id"]."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/1.jpg"; ?>" class="img-fluid mx-auto" alt=""></a></div>
												<?php
													}
												?>
												<?php
													/* if($prop["pr_youtube_link"]!='')
													{
														//echo '<div><iframe width="100%" height="300" src="'.str_replace("watch?v=", "embed/", $prop["pr_youtube_link"]).'"></iframe></div>';
													} */
												?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 text-center">
											<div class="p-10" style="background: rgba(37, 181, 121,0.1);color: #25b579;">
												Property Id: <a href="<?php echo ROOT."property-details/".$prop["pr_id"]."/"; ?>"><?php echo $prop['pr_reg_code']?></a>
											</div>
										</div>
									</div>

									<div class="listing-detail-wrapper">
										<div class="listing-short-detail-wrap">
											<div class="_card_list_flex mb-2">
												<div class="_card_flex_01">
													<span class="_list_blickes types"><?php echo $CATARR[$prop['pr_cat']]?></span>
												</div>
												<div class="_card_flex_last">
													<h6 class="listing-card-info-price mb-0">&#8377;<?php echo ($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)? $prop["pr_cost"] : $prop["pr_plot_cost"]; ?></h6>
												</div>
											</div>
											<!--<div class="_card_list_flex">
												<div class="_card_flex_01">
													<h4 class="listing-name verified"><a href="<?php //echo ROOT.(isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS)."/".$prop['pr_id']?>" class="prt-link-detail"><?php //echo $LOCATNARR[$prop["pr_location"]]?></a></h4>
												</div>
											</div>-->
										</div>
									</div>

									<?php
										if($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)
										{
									?>
											<div class="price-features-wrapper px-1 text-center">
												<div class="list-fx-features2" style="display:block !important;">
													<div class="listing-card-info-icon1">
														<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bed.svg" alt="" width="13"></div><?php echo $prop["pr_bhk"]?>
													</div>
													<div class="listing-card-info-icon1">
														<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bathtub.svg" alt="" width="13"></div><?php echo $prop["pr_bath"]?> Bath
													</div>
													<div class="listing-card-info-icon1">
														<div class="inc-fleat-icon" data-toggle="tooltip" data-placement="top" title="Build Up Area"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php //echo $prop["pr_build"] ?> <?php echo ($prop["pr_cat"]==1)? $prop["pr_build"].' sq.ft' : $prop["pr_total_area"].' sq.yd'; ?>
													</div>
												</div>
											</div>
											
											
									<?php	
										
										} else if($prop["pr_cat"] == 3) {
											
									?>
											<div class="price-features-wrapper font-12">
												<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php echo $prop["pr_plot_area"].' sq.yd.'; ?>
											</div>
									<?php
										} else if($prop["pr_cat"] == 5) {
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
												<li>
													<?php 
														/* $clsdang = (isset($prop['wl_id']) && $prop['wl_id']>0)? "text-danger":"";  */
														$clsdang = ""; 
														if(isset($prop['wl_id']) && $prop['wl_id']>0)
														{
															$clsdang = "text-danger";
														}	
													?>
													<div class="prt_saveed_12lk">
														<label class="toggler toggler-danger btnwish <?php echo $clsdang?>" data-toggle="tooltip" data-id="<?php echo $prop['pr_id']?>" data-wlid="<?php echo $prop['wl_id']?>" data-placement="top" data-original-title="Save property"><input type="checkbox"><i class="ti-heart"></i></label>
													</div>
												</li>
												<li>
													<div class="prt_saveed_12lk">
														<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>" data-toggle="tooltip" data-placement="top" data-original-title="View Property"><i class="ti-arrow-right"></i></a>
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
						} else {
						?>
						<div class="text-danger">No Property available.Search With Another Location</div>
						<?php }?>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>