<?php
	$isAdmin = $session->isAdmin();
	$isEmployee = $session->isEmployeeLoggedin();
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <div class="container">
	<form method="POST" name="frmprop" id="frmprop" enctype="multipart/form-data">
		<div class="row">
			<!-- property main detail -->
			<div class="col-lg-7 col-md-12 col-sm-12">
				<!-- Single Block Wrap -->
				<div class="property_block_wrap">
					<div class="property_block_wrap_header">
						<!--<ul class="nav nav-pills tabs_system" id="pill-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active headtab disabled" id="pills-walk-tab" data-toggle="pill" href="#pills-walk" role="tab" aria-controls="pills-walk" aria-selected="true">Basic Info</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled headtab" id="pills-nearby-tab" data-toggle="pill" href="#pills-nearby2" role="tab" aria-controls="pills-nearby2" aria-selected="false">Address</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled headtab" id="pills-nearby-tabs" data-toggle="pill" href="#pills-nearby" role="tab" aria-controls="pills-nearby" aria-selected="false">Photos</a>
							</li>
						</ul>-->
						
						<ul class="nav nav-pills tabs_system nav-justified">
							<li class="nav-item active" id="info-item"><a class="nav-link headtab active <?php echo (($isAdmin)? "" : "disabled"); ?>" href="#info" id="info-tab" <?php echo (($isAdmin)? "onclick='enableTab(\"info\");'" : ""); ?>>Home</a></li>
							<li class="nav-item" id="addr-item"><a class="nav-link headtab <?php echo (($isAdmin)? "" : "disabled"); ?>" href="#addr" id="addr-tab"  <?php echo (($isAdmin)? "onclick='enableTab(\"addr\");'" : ""); ?>>Address</a></li>
							<li class="nav-item" id="photo-item"><a class="nav-link headtab <?php echo (($isAdmin)? "" : "disabled"); ?>" href="#photo"  id="photo-tab"  <?php echo (($isAdmin)? "onclick='enableTab(\"photo\");'" : ""); ?>>Gallery</a></li>
						</ul>
					</div>
					<script>
						function enableTab(tab)
						{
							//console.log(tab)
							$(".tab-pane").removeClass("fade active show");
							$(".headtab, .nav-item").removeClass("active");
							$("#"+tab).addClass("fade active show");
							$("#"+tab+"-tab").addClass("active");
						}
					</script>
					<div class="block-body">
						<div class="sidetab-content">
							<div class="tab-content" id="pill-tabContent">
								<!-- Book Now Tab -->
								<div class="tab-content">
									<div id="info" class="tab-pane fade active show">
										<div class="frm_submit_block">	
											<h3>Basic Information</h3>
											<div class="frm_submit_wrap">
												<div class=""> <!-- <div class="form-row"> -->
													<input type="hidden" name="propertyId" id="propertyId" value="<?php echo $propertyId; ?>" /> 
													<div class="form-group col-md-12">
														<div class="form-group col-md-12">
															<label>I am a</label><span class="text-danger">*</span>
															<div class="_leads_status">
																<?php
																	foreach($IWANTARR as $key => $val)
																	{
																		echo '<span class="defbuton procls '.((isset($prop['pr_type']) && $prop['pr_type']==$key)? 'active' : '').'" style="padding: 10px 25px;" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																	}
																?>
															</div>
															<input type="hidden" name="i_want_to" id="procls" value="<?php echo (isset($prop['pr_type'])&&$prop['pr_type']!=0)? $prop['pr_type'] : ''; ?>" class="mandfld aprequired">
														</div>
													</div>

													<div class="form-group col-md-12">
														<label>Property Type</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($CATARR as $key => $val)
																{
																	echo '<span class="defbuton protyp '.((isset($prop['pr_cat']) && $prop['pr_cat']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															
															?>
														</div>
														<input type="hidden" name="property_type" id="protyp" value="<?php echo (isset($prop['pr_cat'])&& $prop['pr_cat']!=0)? $prop['pr_cat'] : ''; ?>" class="mandfld">
													</div>
													<?php //echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "apart aparthide" ); ?>
													<div class="form-group col-md-12 apart aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?>">
														<label>Construction Status</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($CONST_STATUS as $key => $val)
																{
																	echo '<span class="defbuton consts '.((isset($prop['pr_constru']) && $prop['pr_constru']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="construction_status" id="consts" value="<?php echo (isset($prop['pr_constru'])&&$prop['pr_constru']!=0)? $prop['pr_constru'] : ''; ?>" class="mandfld">
													</div>
												
													<div class="form-group col-md-12 agri <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "hide" ); ?> ">
														<label>Possession Status</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($POSS_STATUS as $key => $val)
																{
																	echo '<span class="defbuton possts '.((isset($prop['pr_posts']) && $prop['pr_posts']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="possesion_status" id="possts" value="<?php echo (isset($prop['pr_posts'])&&$prop['pr_posts']!=0)? $prop['pr_posts'] : ''; ?>" class="parequired prequired">
													</div>
													<div class="form-group col-md-12 apart <?php echo (((isset($prop['pr_constru']) && $prop['pr_constru']==1) || (isset($prop['pr_posts']) && $prop['pr_posts']==1))? "" : "hide" ); ?>" id="moveready">
														<label>Property Age (in years)</label><span class="text-danger">* <span id="err_ageprop" class="err-msg"></span></span>
														<input type="number" min="0" name="age_of_property" id="ageprop" class="form-control <?php echo (isset($prop['pr_constru']) && $prop['pr_constru']==1)? "mandfld" : ""; ?> <?php echo (isset($prop['pr_posts']) && $prop['pr_posts']==1)? "parequired prequired" : ""; ?>" onkeyup="checkValidate('ageprop', /^[0-9]{0,2}$/, '(Enter digits only.)');" maxlength="2" value="<?php echo isset($prop['pr_agepro'])? $prop['pr_agepro'] : ''; ?>" >
													</div>
													<div class="form-group col-md-12 <?php echo (((isset($prop['pr_constru']) && $prop['pr_constru']==2) || (isset($prop['pr_posts']) && $prop['pr_posts']==2))? "" : "hide" ); ?>" id="undercon">
														<label>Possession Date</label>
														<input type="text" name="possesion_date" id="possdate" class="form-control <?php echo (isset($prop['pr_constru']) && $prop['pr_constru']==2)? "mandfld" : ""; ?> <?php echo (isset($prop['pr_posts']) && $prop['pr_posts']==2)? "parequired prequired" : ""; ?>" value="<?php echo (isset($prop['pr_posdt'])&&($prop['pr_posdt']!="0000-00-00"))? date("Y-m-d",strtotime($prop['pr_posdt'])) : ''; ?>">
													</div>
													<!--<div class="form-group col-md-12 hide" id="posdt">
														<label>Possession Date</label>
														<input type="text" name="posdt" id="posdt" class="form-control flatpickr">
													</div> -->
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']=='3' || $prop['pr_cat']=='5'))? "hide" : "" ); ?> ">
														<label>BHK</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																$i=0;
																foreach($BHKARR as $val)
																{
																	$i++;
																	echo '<span class="defbuton bedroom '.(($propertyId==0 && $i>4)? 'more-hide' : '').' '.((isset($prop['pr_bhk']) && $prop['pr_bhk']==$val)? 'active' : '').'" data-val="'.$val.'"><a href="#">'.$val.'</a></span>';
																	if($propertyId==0)
																	{
																		echo (($i==4)? '<span class="bedroom_hide" onclick="removeHide(\'bedroom\');" style="cursor:pointer;">+ More</span>' : '');
																	}
																}
															?>
														</div>
														<input type="hidden" name="bedroom" id="bedroom" value="<?php echo isset($prop['pr_bhk'])? $prop['pr_bhk'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Bathrooms</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																$i=0;
																foreach($BATHROOMS as $key => $val)
																{
																	$i++;
																	echo '<span class="defbuton bathroom '.(($propertyId==0 && $i>4)? 'more-hide' : '').' '.((isset($prop['pr_bath']) && $prop['pr_bath']!='' && $prop['pr_bath']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																	if($propertyId==0)
																	{
																		echo (($i==4)? '<span class="bathroom_hide" onclick="removeHide(\'bathroom\');" style="cursor:pointer;">+ More</span>' : '');
																	}
																}
															?>
														</div>
														<input type="hidden" name="bathroom" id="bathroom" value="<?php echo isset($prop['pr_bath'])? $prop['pr_bath'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?>">
														<label>Balcony</label><span class="text-danger">*</span>
														
														<div class="_leads_status">
															<?php
																$i=0;
																foreach($BALCONY as $key => $val)
																{
																	$i++;
																	echo '<span class="defbuton bacony '.(($propertyId==0 && $i>4)? 'more-hide' : '').' '.((isset($prop['pr_balcony']) && $prop['pr_balcony']!='' && $prop['pr_balcony']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																	if($propertyId==0)
																	{
																		echo (($i==4)? '<span class="bacony_hide" onclick="removeHide(\'bacony\');" style="cursor:pointer;">+ More</span>' : '');
																	}
																}
															?>
														</div>
														<input type="hidden" name="bacony" id="bacony" value="<?php echo isset($prop['pr_balcony'])? $prop['pr_balcony'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Furnish Type</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($FURNISH_TYPE as $key => $val)
																{
																	echo '<span class="defbuton furnish '.((isset($prop['pr_furnish']) && $prop['pr_furnish']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="furnish" id="furnish" value="<?php echo (isset($prop['pr_furnish'])&&$prop['pr_furnish']!=0)? $prop['pr_furnish'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Covered Parking</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																$i=0;
																foreach($COVERED_PARKING as $key => $val)
																{
																	$i++;
																	echo '<span class="defbuton copark '.(($propertyId==0 && $i>4)? 'more-hide' : '').' '.((isset($prop['pr_parking']) && $prop['pr_parking']!='' && $prop['pr_parking']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																	if($propertyId==0)
																	{
																		echo (($i==4)? '<span class="copark_hide" onclick="removeHide(\'copark\');" style="cursor:pointer;">+ More</span>' : '');
																	}
																}
															?>
														</div>
														<input type="hidden" name="coparking" id="copark" value="<?php echo isset($prop['pr_parking'])? $prop['pr_parking'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Open Parking</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																$i=0;
																foreach($OPEN_PARKING as $key => $val)
																{
																	$i++;
																	echo '<span class="defbuton opnpark '.(($propertyId==0 && $i>4)? 'more-hide' : '').' '.((isset($prop['pr_opnpark']) && $prop['pr_opnpark']!='' && $prop['pr_opnpark']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																	if($propertyId==0)
																	{
																		echo (($i==4)? '<span class="opnpark_hide" onclick="removeHide(\'opnpark\');" style="cursor:pointer;">+ More</span>' : '');
																	}
																}
															?>
														</div>
														<input type="hidden" name="opnparking" id="opnpark" value="<?php echo isset($prop['pr_opnpark'])? $prop['pr_opnpark'] : ''; ?>" class="mandfld">
													</div>
													<div class="form-group col-md-12">
														<label>Facing</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($FACARR as $key => $val)
																{
																	echo '<span class="defbuton facing '.((isset($prop['pr_facing']) && $prop['pr_facing']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="facing" id="facing" value="<?php echo isset($prop['pr_facing'])? $prop['pr_facing'] : ''; ?>" class="mandfld aprequired">
													</div>
													<!--<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Facing</label><span class="text-danger">*</span>
														<div class="_leads_status">
															<?php
																foreach($FACARR as $key => $val)
																{
																	echo '<span class="defbuton facing '.((isset($prop['pr_facing']) && $prop['pr_facing']==$key)? 'active' : '').'" data-val="'.$key.'"><a href="#">'.$val.'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="facing" id="facing" value="<?php echo isset($prop['pr_facing'])? $prop['pr_facing'] : ''; ?>" class="mandfld">
													</div>-->
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Other Amenities</label>
														<div class="_leads_status">
															
															<?php
																$amnarr = isset($prop['pr_amnenitis'])? explode(",",trim($prop['pr_amnenitis'])) : array();
																foreach($AMNTARR as $amnVal)
																{
																	echo '<span class="defbuton amnenitis '.(in_array($amnVal["id"], $amnarr)? 'active':'').'" data-val="'.$amnVal["id"].'" style="padding: 4px 0px;"><a href="#" class="text-center"> <img src="'.ROOT.'assets/img/'.$amnVal["ikon"].'" style="width: 18%;" alt=""> <br>'.$amnVal["name"].'</a></span>';
																}
															
															?>
														</div>
														<input type="hidden" name="other_amnenitis" id="amnenitis" value="<?php echo isset($prop['pr_amnenitis'])? $prop['pr_amnenitis'] : ''; ?>">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Society Amenities</label>
														<div class="_leads_status">
							
															<?php
																$soamnarr = isset($prop['pr_soamnenitis'])? explode(",",trim($prop['pr_soamnenitis'])): array();
																foreach($SOAMNTARR as $socAmn)
																{
																	echo '<span class="defbuton socamnenitis '.(in_array($socAmn["id"], $soamnarr)? 'active':'').'" data-val="'.$socAmn["id"].'" style="padding: 4px 0px;"><a href="#" class="text-center"> <img src="'.ROOT.'assets/img/'.$socAmn["ikon"].'" style="width: 18%;" alt=""> <br>  '.$socAmn["name"].'</a></span>';
																}
															?>
														</div>
														<input type="hidden" name="social_amnenitis" id="socamnenitis" value="<?php echo isset($prop['pr_soamnenitis'])? $prop['pr_soamnenitis'] : ''; ?>">
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?>">
														<label>Cost</label><span class="text-danger">* <span id="err_txtcost" class="err-msg"></span></span>
														<input type="number" min="0" id="txtcost" class="form-control txtcost mandfld" name="cost" autocomplete="text" maxlength="15" onkeyup="checkValidate('txtcost', /^[0-9]{0,15}$/, 'price value should be in digits')" placeholder="in rupees" onblur="setPropertyCost(this.value);" value="<?php echo (isset($prop['pr_cost']) && $prop['pr_cost']>0)? $prop['pr_cost'] : ''; ?>">
													</div>
													<div class="form-group col-md-12 agri <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "hide" ); ?> ">
														<label><span id="plot_price_label"></span> Price</label><span class="text-danger">* <span id="err_plot_price" class="err-msg"></span></span>
														<input type="number" min="0" id="plot_price" class="form-control plot_price parequired prequired" name="plot_price" autocomplete="text" maxlength="15" onkeyup="checkValidate('plot_price', /^[0-9]{0,15}$/, 'price value should be in digits')" value="<?php echo (isset($prop['pr_plot_cost'])&&$prop['pr_plot_cost']>0)? $prop['pr_plot_cost'] : ''; ?>" placeholder="in rupees" onblur="setPropertyCost(this.value);">
													</div>
													<div class="form-group col-md-12 ">
														<label>Maintenance Charge Per month</label><span class="text-danger"><span id="err_txtmaint" class="err-msg"></span></span>
														<input type="number" min="0" id="txtmaint" class="form-control txtmaint" name="maintaining_charges" autocomplete="text" maxlength="15" onkeyup="checkValidate('txtmaint', /^[0-9]{0,15}$/, 'price value should be in digits')" placeholder="in rupees" value="<?php echo (isset($prop['pr_maintarea'])&&$prop['pr_maintarea']!=0)? $prop['pr_maintarea'] : ''; ?>">
													</div>
													<div class="form-group col-md-12 ahide hide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5 || $prop['pr_cat']==1))? "hide" : "" ); ?> ">
														<label>Total Area</label><span class="text-danger">* <span id="err_totalarea" class="err-msg"></span></span>
														<div class="input-group mb-3">
															  <input type="number" min="0" id="totalarea" class="form-control totalarea mand-err" name="pr_total_area" placeholder="Total Area" aria-label="Total Area" autocomplete="text" maxlength="15" onkeyup="checkValidate('totalarea', /^[0-9]{0,15}$/, 'area value should be in digits')" value="<?php echo (isset($prop['pr_total_area']) && $prop['pr_total_area']!=0)? $prop['pr_total_area'] : ''; ?>" onblur="totalArea(this.value);" >
															  <div class="input-group-append">
																<span class="input-group-text" id="basic-addon2">sq.yd</span>
															  </div>
														</div>
													</div>
													<div class="form-group col-md-12 aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
													
														<label>Build up Area</label><span class="text-danger">* <span id="err_txtbuildarea" class="err-msg"></span></span>
														<div class="input-group mb-3">
															  <input type="number" min="0" id="txtbuildarea" class="form-control txtbuildarea mandfld mand-err" name="build_up_area" placeholder="Build up Area" aria-label="Build up Area" autocomplete="text" maxlength="15" onkeyup="checkValidate('txtbuildarea', /^[0-9]{0,15}$/, 'area value should be in digits')" onblur="builtArea(this.value);" value="<?php echo (isset($prop['pr_build'])&&$prop['pr_build']!=0)? $prop['pr_build'] : ''; ?>">
															  <div class="input-group-append">
																<span class="input-group-text" id="basic-addon2">sq.ft</span>
															  </div>
														</div>
														<!--<input type="text" class="form-control txtbuildarea required" name="txtbuildarea" placeholder="">-->
														
														<!--<input type="text" id="txtcost" class="form-control txtcost required" name="txtcost" autocomplete="text" maxlength="15" onkeyup="checkValidate('txtcost', /^[0-9]{0,15}$/, 'price value should be in digits')" placeholder="in rupees"> -->
													</div>
													<div class="form-group col-md-12 apart aparthide <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "hide" : "" ); ?> ">
														<label>Carpet Area (optional)</label><span class="text-danger"><span id="err_txtcarparea" class="err-msg"></span></span>
														<div class="input-group mb-3">
															  <input type="number" min="0" id="txtcarparea" class="form-control txtcarparea" name="carpet_area" placeholder="Carpet Area" aria-label="Carpet Area" aria-describedby="carpet-area"  autocomplete="text" maxlength="15" onkeyup="checkValidate('txtcarparea', /^[0-9]{0,15}$/, 'area value should be in digits')" value="<?php echo (isset($prop['pr_carpt'])&&$prop['pr_carpt']!=0)? $prop['pr_carpt'] : ''; ?>">
															  <div class="input-group-append">
																<span class="input-group-text" id="carpet-area">sq.ft</span>
															  </div>
														</div>
														<!--<input type="text" class="form-control txtcarparea" name="txtcarparea">-->
													</div>		
													<div class="form-group col-md-12 plot <?php echo ((isset($prop['pr_cat']) && $prop['pr_cat']==3)? "" : "hide" ); ?> ">
														<label> Area</label><span class="text-danger">* <span id="err_plot_area" class="err-msg"></span></span>
														<div class="input-group mb-3">
															  <input type="number" min="0" id="plot_area" class="form-control txtlength prequired mand-err" name="plot_area" placeholder="Area" aria-label="Area" autocomplete="text" maxlength="15" onkeyup="checkValidate('plot_area', /^[0-9]{0,15}$/, 'area value should be in digits')" onblur="calcPlotArea('plot');" value="<?php echo (isset($prop['pr_plot_area'])&&$prop['pr_plot_area']!=0)? $prop['pr_plot_area'] : ''; ?>">
															  <div class="input-group-append">
																<span class="input-group-text" id="basic-addon2">sq.yd</span>
															  </div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 agri agri-need <?php echo ((isset($prop['pr_cat']) && $prop['pr_cat']==5)? "" : "hide" ); ?> ">
															<label>Area</label> <span class="text-danger"> * <span id="err_area_in_acre" class="err-msg"></span></span>
															<div class="input-group mb-3">
																<input type="number" min="0" id="area_in_acre" class="form-control area_in_acre parequired mand-err" name="area_in_acre" placeholder="Area in" aria-label="Area" autocomplete="text" maxlength="3" onkeyup="checkValidate('area_in_acre', /^[0-9]{1,3}$/, 'value should be lessthen or equal to 999', [], 0, 999)" value="<?php echo (isset($prop['pr_area_in_acre'])&&$prop['pr_area_in_acre']!=0)? $prop['pr_area_in_acre'] : ''; ?>" onblur="calcPlotArea('al'); checkValidate('area_in_acre', /^[0-9]{1,3}$/, 'value should be lessthen or equal to 999', [], 0, 999);">
																<div class="input-group-append">
																	<span class="input-group-text" id="basic-addon2">Acre(s)</span>
																</div>
															</div>
														
															<!--<input type="number" min="0" class="form-control txtlength parequired" id="al_area" name="al_area"  maxlength="15" onkeyup="checkValidate('al_area', /^[0-9]{0,15}$/, 'area value should be in digits')" onblur="calcPlotArea('al');"  value="<?php echo (isset($prop['pr_plot_area'])&&$prop['pr_plot_area']!=0)? $prop['pr_plot_area'] : ''; ?>">-->
														</div>
														<div class="col-md-6 agri agri-need <?php echo ((isset($prop['pr_cat']) && $prop['pr_cat']==5)? "" : "hide" ); ?>">
															<label><br /></label> <span class="text-danger">  <span id="err_area_in_guntha" class="err-msg"></span></span>
															<div class="input-group mb-3">
																<input type="number" min="0" id="area_in_guntha" class="form-control area_in_guntha parequired mand-err" name="area_in_guntha" placeholder="Area in" aria-label="Area" autocomplete="text" maxlength="2" onkeyup="checkValidate('area_in_guntha', /^[0-9]{1,2}$/, 'value should be 1 to 39', [], 0, 39)" value="<?php echo (isset($prop['pr_area_in_guntha'])&&$prop['pr_area_in_guntha']!=0)? $prop['pr_area_in_guntha'] : ''; ?>" onblur="calcPlotArea('al'); checkValidate('area_in_guntha', /^[0-9]{1,2}$/, 'value should be 1 to 39', [], 0, 39);">
																<!--  onchange="onChangeFunction('area_in_guntha', this.value, 0,39)" -->
																<div class="input-group-append">
																	<span class="input-group-text" id="basic-addon2">Guntha(s)</span>
																</div>
															</div>
															<!--<label>Area Unit</label><span class="text-danger"> * <span id="err_plot_unit" class="err-msg"></span></span>
															<select type="text" class="form-control txtlength" id="plot_unit" name="plot_unit" onblur="calcPlotArea('al');">
																<?php
																	foreach($UNITARR as $val)
																	{
																		echo '<option value="'.$val.'" '.((isset($prop['pr_plot_unit']) && $prop['pr_plot_unit']==$val)? 'selected': '').'>'.$val.'</option>';
																	}
																?>
															</select>-->
														</div>
													</div>
													<!--<div class="row agri <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "hide" ); ?>">
														<div class="col-md-6">
															<label>Length</label><span class="text-danger"><span id="err_plot_length" class="err-msg"></span></span>
															<div class="input-group mb-3">
																  <input type="text" id="plot_length" class="form-control txtlength" name="plot_length" placeholder="Length" aria-label="Length" maxlength="10" onkeyup="checkValidate('plot_length', /^[0-9]{0,10}$/, 'length value should be in digits')" value="" onblur="calcPlotArea();" value="<?php echo isset($prop['pr_lenth'])? $prop['pr_lenth'] : ''; ?>" />
																  <div class="input-group-append">
																	<span class="input-group-text">ft</span>
																  </div>
															</div>
														</div>
														<div class="col-md-6">
															<label>Width</label> <span class="text-danger"><span id="err_plot_width" class="err-msg"></span></span>
															<div class="input-group mb-3">
																  <input type="text" id="plot_width" class="form-control txtlength" name="plot_width" placeholder="Width" aria-label="Width" maxlength="10" onkeyup="checkValidate('plot_width', /^[0-9]{0,10}$/, 'width value should be in digits')" value="" onblur="calcPlotArea();" value="<?php echo isset($prop['pr_width'])? $prop['pr_width'] : ''; ?>" />
																  <div class="input-group-append">
																	<span class="input-group-text">ft</span>
																  </div>
															</div>
														</div>
													</div>-->
													<!--<div class="form-group col-md-12">
														<label>Offers</label>
														<input type="text" class="form-control txtoffer" name="offer" value="<?php //echo isset($prop['pr_offer'])? $prop['pr_offer'] : ''; ?>">
													</div>-->
													<div class="form-group col-md-12 agri <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "hide" ); ?>">
														<label>Width Of Facing Road</label> <span class="text-danger"><span id="err_width_facing_road" class="err-msg"></span></span>
														<div class="input-group mb-3">
															  <input type="number" min="0" id="width_facing_road" class="form-control width_facing_road" name="width_facing_road" placeholder="Width Of Facing Road" aria-label="Width Of Facing Road" maxlength="10" onblur="" value="<?php echo (isset($prop['pr_width_road_facing']) && $prop['pr_width_road_facing']!=0)? $prop['pr_width_road_facing'] : ''; ?>"> <!-- mand-err parequired prequired checkValidate('width_facing_road', /^[0-9]{1,10}$/, 'width value should be in digits', [], 0, 0, 1) -->
															  <div class="input-group-append">
																<span class="input-group-text">ft</span>
															  </div>
														</div>
														<!--<input type="text" class="form-control txtoffer" name="width_facing_road">-->
													</div>
													<div class="form-group col-md-12 agri <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? "" : "hide" ); ?>">
														<label>Type Of Road</label> <span class="text-danger"> * <span id="err_pr_road_type" class="err-msg"></span></span>
														<select id="pr_road_type" name="pr_road_type" class="form-control pr_road_type parequired prequired">
															<option value="" <?php echo (isset($prop['pr_road_type'])&&($prop['pr_road_type']=='')? 'selected' : ''); ?>>-- Road Type --</option> 
															<?php
																foreach($ROAD_TYPES as $key => $val)
																{
																	echo '<option value="'.$key.'" '.(isset($prop['pr_road_type'])&&($prop['pr_road_type']==$key)? 'selected' : '').'><a href="#">'.$val.'</a></option>';
																}
															?>
														</select>
														<!--<input type="text" class="form-control txtoffer" name="width_facing_road">-->
													</div>
												</div>
												<div class="form-group col-md-12">
													<label>Description</label>
													<input type="text" class="form-control txtdecri" name="description"  value="<?php echo isset($prop['pr_decri'])? $prop['pr_decri'] : ''; ?>" onblur="propertyDesc(this.value);">
												</div>
												<div class="form-row col-md-12" style="padding-top: 15px;">
													<button class="btn theme-bg rounded" id="frstbtn" type="button">Continue</button>
												</div>
											</div>
										</div>
									</div>
									<div id="addr" class="tab-pane fade">
										<div class="frm_submit_block">	
											<h3>Address</h3>
											<div class="frm_submit_wrap">
												<div class="form-row">
													<div class="form-group col-md-12">
														<label>City Here</label><span class="text-danger"> *</span>
														<select  class=" txtlocation inputselct srequired" name="txtlocation">
															<option value=""></option>
															<?php
																foreach($locarr AS $loc){	
															?>
															<option value='<?php echo $loc['loc_id']?>' <?php echo (isset($prop['pr_location']) && $prop['pr_location']==$loc['loc_id'])? 'selected' : ''; ?>><?php echo $loc["loc_name"]?></option>
															<?php
																}
															?>
														</select>
													</div>
													<div class="clear-fix"></div>
													<div class="form-group col-md-12">
														<label>Building/Project/Society</label><span class="text-danger"> *</span>
														<input type="text" class="form-control txtbuild srequired" name="txtbuild" value="<?php echo isset($prop['pr_buildproj'])? $prop['pr_buildproj'] : '';?>" placeholder="">
													</div>
													<div class="form-group col-md-12">
														<label>Locality</label><span class="text-danger"> *</span>
														<input list="datalocalty" type="text" class="form-control txtlocality srequired" name="txtlocality" value="<?php echo isset($prop['pr_locality'])? $prop['pr_locality'] : '';?>" placeholder="">
														<datalist id="datalocalty">
															<?php 
																////$locsql="SELECT DISTINCT(pr_locality) FROM `property` WHERE pr_locality!='NULL'";
																//$localarr=$prpobj->rawQuery($locsql);

																$localarr = $db->getRecordsArray("SELECT DISTINCT `pr_locality` FROM `".TBL_PROPERTY."` WHERE pr_locality!='NULL'");

																foreach($localarr AS $loclty){
															?>
																<option value="<?php echo $loclty['pr_locality']?>">
															<?php }?>
														</datalist>
													</div>
													<div class="form-group col-md-12">
														<label>Location Link</label><span class="text-danger">  <span id="err_txtlink" class="err-msg"></span></span>
														<input type="text" class="form-control txtlink" name="txtlink" id="txtlink" value="<?php echo isset($prop['pr_link'])? $prop['pr_link'] : '';?>" placeholder="URL Link" onblur="isValid('txtlink', /^https?:\/\/([\w\d\-]+\.)+\w{2,}(\/.+)?$/);" onkeyup="checkValidate('txtlink', /^https?:\/\/([\w\d\-]+\.)+\w{2,}(\/.+)?$/, 'Link only')">
													</div>
													<div class="aih <?php echo ((isset($prop['pr_cat']) && ($prop['pr_cat']==1))? "" : "hide" ); ?> form-row">
														<div class="form-group col-md-4">
															<label>Flat No  </label>
															<input type="number" min="0" class="form-control faltno " name="faltno" id="faltno" maxlength="4" value="<?php echo isset($prop['pr_flatno'])? $prop['pr_flatno'] : '';?>" onkeyup="checkValidate('flatno', /^[0-9]{0,4}$/, 'digits only')" />
														</div>
														<div class="form-group col-md-4">
															<label>Floor No </label><span class="text-danger"> * <span id="err_txtflrno" class="err-msg"></span></span>
															<input type="number" min="0" class="form-control txtflrno aih-need" name="txtflrno" id="txtflrno" maxlength="4" value="<?php echo isset($prop['pr_floor'])? $prop['pr_floor'] : '';?>" onkeyup="checkValidate('txtflrno', /^[0-9]{0,4}$/, 'digits only')">
														</div>
														<div class="form-group col-md-4">
															<label>Total Floors </label><span class="text-danger"> * <span id="err_ttlfllor" class="err-msg"></span></span>
															<input type="number" min="0" class="form-control ttlfllor aih-need" name="ttlfllor" id="ttlfllor" maxlength="4" value="<?php echo isset($prop['pr_ttlfllor'])? $prop['pr_ttlfllor'] : '';?>" onkeyup="checkValidate('ttlfllor', /^[0-9]{0,4}$/, 'digits only')">
														</div>
													</div>
												</div>
												<?php 
													if($isEmployee)
													{
												?>
													<div class="form-row">
														<div class="form-group col-md-12">
															<label>Owner Name</label><span class="text-danger"> * <span id="err_owner_name" class="err-msg"></span></span>
															<input type="text" id="owner_name" class="form-control ownername srequired" name="pr_owner_name" value="<?php echo isset($prop['pr_owner_name'])? $prop['pr_owner_name'] : '';?>" placeholder="" onkeyup="checkValidate('owner_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])">
														</div>
														<div class="form-group col-md-12">
															<label>Owner Email</label><span class="text-danger"> * <span id="err_owner_email" class="err-msg"></span></span>
															<input type="email" id="owner_email" class="form-control owneremail srequired" name="pr_owner_email" value="<?php echo isset($prop['pr_owner_email'])? $prop['pr_owner_email'] : '';?>" placeholder="" onkeyup="checkValidate('owner_email', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])">
														</div>
														<div class="form-group col-md-12">
															<label>Owner Phone</label><span class="text-danger"> * <span id="err_owner_phone" class="err-msg"></span></span>
															<input type="text" id="owner_phone" class="form-control ownerphone srequired" name="pr_owner_phone" value="<?php echo isset($prop['pr_owner_phone'])? $prop['pr_owner_phone'] : '';?>" placeholder="" onkeyup="checkValidate('owner_phone', /^[0-9+ ]{0,15}$/, '', ['Please Enter Phone', 'Enter Digits only.'])">
														</div>
													</div>
												<?php
													}
												?>
												<div class="form-row col-md-12" style="padding-top: 15px;">
													<a href="#" class="btn btn-theme" style="background: #a8a8a8;border: 1px solid #a8a8a8;" id="frstback">Back</a><a href="#" class="btn btn-theme" type="button" id="secndbtn">Continue</a>	
												</div>
											</div>
										</div>
									</div>
									<div id="photo" class="tab-pane fade">
										<!-- Schools -->
										<div class="frm_submit_block">	
											<h3>Gallery</h3>
											<div class="frm_submit_wrap">
												<div class="form-row">
													<div class="form-group col-md-12">
														<label>Upload Gallery <b><i style="font-size:10px;">(max file size <?php echo FILE_SIZE/(1024*1000);?> MB)</i></b></label>
														<!-- <form action="https://themezhub.net/upload-target" class="dropzone dz-clickable primary-dropzone">
														<div class="dz-default dz-message">
														<i class="ti-gallery"></i>
														<span>Drag & Drop To Change Logo</span>
														</div>
														</form> -->
													</div>
													<div class="notify-img" style="font-style:italic;font-size:12px;font-weight:bold;"></div>
													<div class="form-group col-md-12">
														<!--<input type="file" id="input_file_id" name="files[]" onchange="preview_image();" multiple />-->
														<input type="file" name="file" id="file" multiple />
														<div class="gallery-image-list" id="uploads"><!-- The file uploads will be shown here --></div>
														<!--<button onclick="uploadFile(event)">Upload files</button>
														<div id="listfiles" class="view_list"></div>
														<input class="hidden" type="file" style="visibility:hidden;" id="input_file_id" onchange="fileList(event)" name="files[]" multiple onchange="change();">-->

														<div id="image_preview">
															<?php
																if(count($galleriesArr)>0)
																{
																	foreach($galleriesArr as $val)
																	{
																		echo '<div class="img-preview-div"><div class="rem-img remove-img  remove-img-action" data-id="'.$val["pg_id"].'" data-pid="'.$val["pr_id"].'"><i class="fa fa-times"></i></div><a href="'.ROOT.PR_UPLOAD_PATH.'/'.$val["pr_img"].'"><img src="'.ROOT.PR_UPLOAD_PATH.'/'.$val["pr_img"].'" class="img-fluid img-thumbnail mx-auto" alt="" style="min-height:190px;" ></a></div>';
																	}		
																}
															?>
														</div>
													</div>
													<div class="form-group col-md-12 mt-5">
														<label>Youtube Link</label><span class="text-danger">  <span id="err_youtube_link" class="err-msg"></span></span>
														<input type="text" id="youtube_link" class="form-control txtlink" name="pr_youtube_link" value="<?php echo isset($prop['pr_youtube_link'])? $prop['pr_youtube_link'] : '';?>" placeholder="Youtube Link"  onkeyup="checkValidate('youtube_link', /^https?:\/\/([\w\d\-]+\.)+\w{2,}(\/.+)?$/, 'You Link only')" onblur="youtubePreview(/^https?:\/\/([\w\d\-]+\.)+\w{2,}(\/.+)?$/);">
													</div>
													<div class="form-group col-md-12">
														<div id="youtube_preview">
															<?php 
																if(isset($prop['pr_youtube_link']) && $prop['pr_youtube_link']!=''){
																	echo '<iframe width="350" height="300" src="'.(isset($prop['pr_youtube_link'])? str_replace('watch?v=', 'embed/', $prop['pr_youtube_link']) : '').'"></iframe>';
																}
															?>
														</div>
													</div>
												</div>

												<div class="form-row col-md-12" style="padding-top: 15px;">
												<a href="#" class="btn btn-theme" style="background: #a8a8a8;
												border: 1px solid #a8a8a8;" id="scndback">Back</a><button class="btn btn-theme" type="submit" id="btnsubmit" name="btnsubmit">Submit</button>	
												</div>
											</div>
										</div>
									</div>
								</div>

								<!--<div class="tab-pane fade show active" id="pills-walk" role="tabpanel" aria-labelledby="pills-walk-tab">
									
								</div>
								<div class="tab-pane fade " id="pills-nearby2" role="tabpanel" aria-labelledby="pills-walk-tab">
									
								</div>
								<div class="tab-pane fade" id="pills-nearby" role="tabpanel" aria-labelledby="pills-nearby-tab">
									
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- property Sidebar -->
			<div class="col-lg-5 col-md-12 col-sm-12">
				<div class="property-sidebar side_stiky ">
					<div class="_prtis_list mb-4">
						<div class="_prtis_list_header min">
							<h4 class="m-0" style="font-size: 18px;">Your Property  <span class="theme-cl">Card Preview</span>
								<?php
									if($isAdmin && isset($propertyId) && $propertyId>0)
									{
										if(isset($prop['pr_is_publish']) && $prop['pr_is_publish']==1)
										{
											echo '<button class="btn btn-danger float-right" type="submit" id="unpublish" name="unpublish">Un Publish</button>';
										}
										else
										{
											echo '<button class="btn btn-info float-right" type="submit" id="unpublish" name="publish">Publish</button>';
										}
									}
								?>
							</h4>
						</div>
						<div class="_prtis_list_body">
							<div class="row">
								<div class="property-listing property-2">
									<div class="listing-img-wrapper">
										<div class="list-img-slide">
											<div class="click">
												<?php
													if(count($galleriesArr)>0)
													{
														foreach($galleriesArr as $val)
														{
															echo '<div id="img-dummy"><a href="'.ROOT.PR_UPLOAD_PATH.'/'.$val["pr_img"].'"><img src="'.ROOT.PR_UPLOAD_PATH.'/'.$val["pr_img"].'" class="img-fluid mx-auto" alt="" onerror="this.src=\''.ROOT.PR_UPLOAD_PATH.'/1.jpg\';" ></a></div>';
														}		
													}
													else
													{
														echo '<div id="card_img_preview"><div id="img-dummy"><a href="'.ROOT.PR_UPLOAD_PATH.'/1.jpg"><img src="'.ROOT.PR_UPLOAD_PATH.'/1.jpg" class="img-fluid mx-auto" alt=""  onerror="this.src=\''.ROOT.PR_UPLOAD_PATH.'/1.jpg\';" ></a></div><br /></div>';
													}
												?>
												<!--
												<?php 
												if($file!=''){
												?>	
														<div><a href="<?php echo ROOT.PR_UPLOAD_PATH."/".$file?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$file?>" class="img-fluid mx-auto" alt=""></a></div>
												<?php }else{?>
													<div><a href="<?php echo ROOT.PR_UPLOAD_PATH."/1.jpg"?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/1.jpg"?>" class="img-fluid mx-auto" alt=""></a></div>
												<?php }?>	
												-->
											</div>
										</div>
									</div>
									<div class="listing-detail-wrapper">
										<div class="listing-short-detail-wrap">
											<div class="_card_list_flex mb-2">
												<div class="_card_flex_01">
													<span class="_list_blickes types"><span id="typeOfBHK"><?php echo isset($prop['pr_bhk'])? $prop['pr_bhk'] : ''; ?></span>&nbsp;<span id="typeOfProperty"><?php echo (isset($prop['pr_cat']) && $prop['pr_cat']!='' && isset($CATARR[$prop['pr_cat']]))? $CATARR[$prop['pr_cat']] : ''; ?></span></span>
												</div>
												<div class="_card_flex_last">
													<h6 class="listing-card-info-price mb-0">&#8377;<span id="propertyCost"><?php echo (isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? (isset($prop['pr_plot_cost'])? $prop['pr_plot_cost'] : '') : (isset($prop['pr_cost'])? $prop['pr_cost'] : ''); ?></span> </h6>
												</div>
											</div>
											<div class="_card_list_flex"><div class="_card_flex_01"></div></div>
										</div>
									</div>
									<div class="price-features-wrapper">
									<div> 
										<div id="propertyTotalArea">
											<?php
												if(isset($prop['pr_cat']))
												{
													if($prop['pr_cat']==2 || $prop['pr_cat']==4)
													{
											?>
														<b>Total Area : </b>
														<?php 
															echo (isset($prop['pr_total_area'])? $prop['pr_total_area'].' sq.yd' : '');
														?>
											<?php
													}
												}
											?>
										</div>
										<div id="propertyArea">
											<b><?php echo (isset($prop['pr_cat']) && $prop['pr_cat']!=3 && $prop['pr_cat']!=5)? 'Built Up ' : '';?>Area : </b>
											<?php 
												//echo (isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? (isset($prop['pr_plot_area'])? $prop['pr_plot_area'].' '.$prop['pr_plot_unit'] : '') : (isset($prop['pr_build'])? $prop['pr_build'].' sq. ft' : ''); 
												if(isset($prop['pr_cat']))
												{
													if($prop['pr_cat']==3)
													{
														echo $prop['pr_plot_area'].' sq.yd.';
													} 
													else if($prop['pr_cat']==5)
													{
														echo ((isset($prop['pr_area_in_acre'])>0)? $prop['pr_area_in_acre'] : 0).' Acres, '.((isset($prop['pr_area_in_guntha'])>0)? $prop['pr_area_in_guntha'] : 0).' Gunthas';
													}
													else
													{
														/* echo $prop['pr_build'].(($prop['pr_cat']==1)? ' sq.ft' : ' sq.yd'); */
														echo $prop['pr_build'].' sq.ft';
													}
												}
											?>
										</div>
										<div id="propertyDesc">
											<b>Desc : </b><span><?php echo isset($prop['pr_decri'])? $prop['pr_decri'] : ''; ?></span>
										</div>
									</div>
									<!--
									<div class="list-fx-features">
										<div class="listing-card-info-icon">
											<div class="inc-fleat-icon"><img src="assets/img/bed.svg" alt="" width="13"></div> <?php //echo $bedroom?>Beds
										</div>
										<div class="listing-card-info-icon">
											<div class="inc-fleat-icon"><img src="assets/img/bathtub.svg" alt="" width="13"></div>-<?php //echo $bathroom?> Bath
										</div>
										<div class="listing-card-info-icon">
											<div class="inc-fleat-icon"><img src="assets/img/move.svg" alt="" width="13"></div>-<?php //echo $txtbuildarea?> sqft
										</div>
									</div>
									-->
									</div>

									<!--
									<div class="listing-detail-footer">
										<div class="footer-first">
											<div class="foot-location"><img src="assets/img/pin.svg" alt="" width="18"><?php //echo (isset($LOCATNARR[$txtlocation])? $LOCATNARR[$txtlocation] : ''); ?></div>
										</div>
										<div class="footer-flex">
											<ul class="selio_style">
												<li>
												<div class="prt_saveed_12lk">
												<label class="toggler toggler-danger" data-toggle="tooltip" data-placement="top" data-original-title="Save property"><input type="checkbox"><i class="ti-heart"></i></label>
												</div>
												</li>

												<li>
												<div class="prt_saveed_12lk">
												<a href="<?php //echo ROOT."property-details/".$proid?>" data-toggle="tooltip" data-placement="top" data-original-title="View Property"><i class="ti-arrow-right"></i></a>
												</div>
												</li>
											</ul>
										</div>
									</div>
									-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .has-error{border: 1px solid #f00!important;}
    .txt-error{color:red!important;}
</style>
<script type="text/javascript">

/* ======== Property Type ==== */

$(document).on("change", "input[name^='file']", function(e){
    e.preventDefault();
	
	var rootUrl = "<?php echo ROOT; ?>";
	var prUploadPath = "<?php echo PR_UPLOAD_PATH; ?>";
    var This    =   this,
        display =   $("#uploads");
        image_preview =   $("#card_img_preview");
	var propertyId = $("#propertyId").val();

	$.each(This.files, function(i, obj){
		var file = This.files[i];
		var xhr = new XMLHttpRequest();
		var formData = new FormData();
		formData.append('action', 'insertImg');
		formData.append('pid', propertyId);
		formData.append('file', file);

		// Open
		//console.log(file.name)
		xhr.open('POST', rootUrl+'ajax/prop-ajax.php', true);
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				$("#img-dummy").remove();
				var resp = JSON.parse(xhr.response);
				
				if(resp.status=="error")
				{
					$(".notify-img").addClass(resp.type).html(resp.message).fadeOut(10000);
				}
				else
				{
					display.append('<div class="img-preview-div"><div class="rem-img remove-img  remove-img-action" data-id="'+resp.id+'" data-pid="'+propertyId+'"><i class="fa fa-times"></i></div><a href="'+rootUrl+prUploadPath+'/'+resp.file_name+'"><img src="'+rootUrl+prUploadPath+'/'+resp.file_name+'" class="img-fluid img-thumbnail mx-auto" alt="" style="min-height:190px;" ></a></div>');
					/* image_preview.append('<div class="img-preview-div"><a href="'+rootUrl+'images/'+resp.file_name+'"><img src="'+rootUrl+'images/'+resp.file_name+'" class="img-fluid mx-auto" alt="" style="min-height:190px;" ></a></div>'); */
					image_preview.append('<div id="img-dummy"><a href="'+rootUrl+prUploadPath+'/'+resp.file_name+'"><img src="'+rootUrl+prUploadPath+'/'+resp.file_name+'" class="img-fluid mx-auto" alt=""></a></div>');
				}
				if(resp.message=="Invalid User.")
				{
					window.location.href=rootUrl;
				}
			}
		}
  
		/* xhr.open('POST', this.options.action);

		// Set headers
		xhr.setRequestHeader("Cache-Control", "no-cache");
		xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.setRequestHeader("Content-Type", "multipart/form-data");
		xhr.setRequestHeader("X-File-Name", file.fileName);
		xhr.setRequestHeader("X-File-Size", file.fileSize);
		xhr.setRequestHeader("X-File-Type", file.type); */
		

		// Send
		xhr.send(formData);
	});
});

$(document).on('click', '.remove-img-action', function(event) {
	event.preventDefault();
	var imgId = $(this).data('id');
	var pid = $(this).data('pid');
	$(this).parent().remove();
	if(imgId!='')
	{
		//$("#mailOTP").addClass('disabled');
		///$(".notify-otp").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
		$.ajax({
			url: '<?php echo ROOT?>ajax/prop-ajax.php',
			type: 'POST',
			data: 'action=removeimg&id='+imgId+'&pid='+pid,
			success:function(response){
				//console.log(response);	
				jsn=$.parseJSON(response);
				if(jsn.status=='success')
				{
					//$(this).parent().remove();
					//$("#frmregister")[0].reset();
					//location.reload();
					//$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
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
$(document).on('click', '.protyp', function(event) {
	event.preventDefault();
	$(".protyp").removeClass("active").removeClass("has-error");
	$(".protyp").parent().parent().removeClass('txt-error');
	
	$(".aih, .ahide").addClass("hide");
	$(".aih-need").removeClass("srequired");
	$(".totalarea").removeClass("mandfld");
	
	$(this).addClass("active");
	$("#protyp").val($(this).data('val'));
	$("#propertyTotalArea").html('');
	/* $(".aria_label").text(''); */
	
	var porpertyVal = $(this).data('val');
	var properties = <?php echo json_encode($CATARR);?>;
	
	var isBHK = true;
	var cost = 0;
	if(porpertyVal==3)
	{
		isBHK = false;
		$(".plot, .agri").removeClass("hide");
		$(".aparthide, .agri-need, .ahide").addClass("hide");
		
		$("#consts").removeClass("mandfld");
		//$("#consts").addClass("parequired");
		$("#possts").addClass("prequired");
		$("#plot_price_label").text("Plot");
		cost = $("#plot_price").val();
		calcPlotArea('plot');

	} 
	else if(porpertyVal==5)
	{
		isBHK = false;
		$(".agri").removeClass("hide");
		$(".aparthide, .plot, .ahide").addClass("hide");
		$("#consts").removeClass("mandfld");
		//$("#consts").addClass("parequired");
		$("#possts").addClass("parequired");
		cost = $("#plot_price").val();
		$("#plot_price_label").text("");
		calcPlotArea('al');
		
	}else{
		$(".agri, .plot").addClass("hide");
		$(".aparthide").removeClass("hide");
	
		$("#possts").removeClass("parequired").removeClass("prequired");
		$("#consts, #totalarea").addClass("mandfld");
		
		cost = $("#txtcost").val();
		
		$("#propertyArea").html('<b>Built Up Area</b>: '+$("#txtbuildarea").val()+' sq.ft');
		if($(this).data('val')==1)
		{			
			$(".ahide").addClass("hide");
			$(".aih").removeClass("hide");
			$(".totalarea").removeClass("mandfld");
			$(".aih-need").addClass("srequired");
			/* $(".chage_dimension").text('sq.ft'); */
		}
		else
		{
			$("#propertyTotalArea").html('<b>Total Area</b>: '+$("#totalarea").val()+' sq.yd');
			$(".ahide").removeClass("hide");
			/* $(".chage_dimension").text('sq.yd'); */
			/* $("#propertyArea").html('<b>Area</b>: '+$("#txtbuildarea").val()+' sq.yd'); */
		}

	}
	
	$("#typeOfProperty").text(properties[porpertyVal]);
	$("#typeOfBHK").text('');
	$("#propertyCost").text(cost);
	var bhk = ($("#bedroom").val()!= '')? $("#bedroom").val() : '';
	if(bhk!='' && isBHK)
	{
		//var bhks = <?php echo json_encode($BHKARR);?>;
		$("#typeOfBHK").text(bhk);
	}
	
	
	//var propertyName = 
});
/* ======== Property Type ==== */

/* ======= Construction Status ===== */
$(document).on('click', '.consts', function(event) 
{
	event.preventDefault();
	$(".consts").removeClass("active").removeClass("has-error");
	$(".consts").parent().parent().removeClass('txt-error');
	$(this).addClass("active");
	$("#consts").val($(this).data('val'));
	
	if($(this).data('val')==1)
	{
		$("#moveready").removeClass("hide");
		$("#undercon").addClass("hide");
		
		$("#possdate").removeClass("mandfld");
		$("#ageprop").addClass("mandfld");
		
	}else{
		$("#undercon").removeClass("hide");
		$("#moveready").addClass("hide");
		
		$("#ageprop").removeClass("mandfld");
		$("#possdate").addClass("mandfld");
	}
});
/* ======= Construction Status ===== */

/* ========= Possessive Status ==== */
$(document).on('click', '.possts', function(event) {
	event.preventDefault();
	$(".possts").removeClass("active").removeClass("has-error");
	$(".possts").parent().parent().removeClass('txt-error');
	$(this).addClass("active");
	$("#possts").val($(this).data('val'));
	
	if($(this).data('val')==1)
	{
		$("#moveready").removeClass("hide");
		$("#undercon").addClass("hide");
		
		$("#possdate").removeClass("parequired").removeClass("prequired");
		$("#ageprop").addClass("parequired").addClass("prequired");
		
	}else{
		$("#moveready").addClass("hide");
		$("#undercon").removeClass("hide");
		
		$("#ageprop").removeClass("parequired").removeClass("prequired");
		$("#possdate").addClass("parequired").addClass("prequired");
	}
});
/* ========= Possessive Status ==== */

/* ======== First Submit ======== */

$(document).on('click', '#frstbtn,#scndback', function(event) 
{
	event.preventDefault();
	$(".hide").removeClass("required");
	$(".hide").removeClass("mandfld");
	valid=true;
	$(".has-error").removeClass("has-error");
	$(".txt-error").removeClass("txt-error");
	
	var minLimitArr = {'ageprop' : 0, 'txtcost' : 1, 'txtbuildarea' : 1, 'plot_price' : 1, 'plot_area' : 1, 'width_facing_road' : 0, 'area_in_acre' : 0, 'area_in_guntha' : 0};
	var maxLimitArr = {'area_in_acre' : 999, 'area_in_guntha' : 39};
	
	/* ==== Testing ===== */
	
	//if($("#"))
	/* ==== Testing ===== */
	
	var propertyType = $("#protyp").val();
	
	$("#frmprop .aprequired").each(function(index, el) 
	{
		var id = $(el).attr("id");
		var value = $(el).val();
		var type = $(el).attr("type");
		if(type=="number" && typeof minLimitArr[id]!='undefined')
		{
			if(typeof maxLimitArr[id]!='undefined' && (parseInt(value)<minLimitArr[id] || parseInt(value)>maxLimitArr[id]))
			{
				valid=false;
				throwError(id, $(this), "mand-err");
				$("#err_"+id).text('Value should be '+minLimitArr[id]+' to '+maxLimitArr[id]+'.');
			}
			else if(parseInt(value)<minLimitArr[id])
			{
				valid=false;
				throwError(id, $(this), "mand-err");
				$("#err_"+id).text('Minimum value required.');
			} 
		}
		if(!$(el).val())
		{
			valid=false;
			throwError(id, $(this), "mand-err");
		}  
		if(valid)
		{
			$("#err_"+id).text('');
		}
	});
	
	if(propertyType==3)
	{
		$("#frmprop .prequired").each(function(index, el) 
		{
			var id = $(el).attr("id");
			var value = $(el).val();
			var type = $(el).attr("type");
			if(type=="number" && typeof minLimitArr[id]!='undefined')
			{
				if(typeof maxLimitArr[id]!='undefined' && (parseInt(value)<minLimitArr[id] || parseInt(value)>maxLimitArr[id]))
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Value should be '+minLimitArr[id]+' to '+maxLimitArr[id]+'.');
				}
				else if(parseInt(value)<minLimitArr[id])
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Minimum value required.');
				} 
			}
			if(!$(el).val())
			{
				valid=false;
				throwError(id, $(this), "mand-err");
			}  
			if(valid)
			{
				$("#err_"+id).text('');
			}
		});
	}
	else if(propertyType==5)
	{
		$("#frmprop .parequired").each(function(index, el) 
		{
			var id = $(el).attr("id");
			var value = $(el).val();
			var type = $(el).attr("type");
			if(type=="number" && typeof minLimitArr[id]!='undefined')
			{
				if(typeof maxLimitArr[id]!='undefined' && (parseInt(value)<minLimitArr[id] || parseInt(value)>maxLimitArr[id]))
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Value should be '+minLimitArr[id]+' to '+maxLimitArr[id]+'.');
				}
				else if(parseInt(value)<minLimitArr[id])
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Minimum value required.');
				} 
				//console.log(parseInt(value), minLimitArr[id], parseInt(value)<minLimitArr[id])
			}
			if(!$(el).val())
			{
				valid=false;
				throwError(id, $(this), "mand-err");
			}  
			if(valid)
			{
				$("#err_"+id).text('');
			}
		});
	}
	else
	{
		$("#frmprop .mandfld").each(function(index, el) 
		{			
			var id = $(el).attr("id");
			var value = $(el).val();
			var type = $(el).attr("type");
			if(type=="number" && typeof minLimitArr[id]!='undefined')
			{
				if(typeof maxLimitArr[id]!='undefined' && (parseInt(value)<minLimitArr[id] || parseInt(value)>maxLimitArr[id]))
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Value should be '+minLimitArr[id]+' to '+maxLimitArr[id]+'.');
				}
				else if(parseInt(value)<minLimitArr[id])
				{
					valid=false;
					throwError(id, $(this), "mand-err");
					$("#err_"+id).text('Minimum value required.');
				} 
			}
			if(!$(el).val())
			{
				valid=false;
				throwError(id, $(this), "mand-err");
			}  
			if(valid)
			{
				$("#err_"+id).text('');
			}
		});
	}
		
	if(valid)
	{
		$(".headtab").removeClass("fade active show");
		$(".tab-pane").removeClass("fade active show");
		$(".tab-pane").addClass("fade");
		$("#addr-tab").addClass(" active ");
		$("#addr").addClass(" active show");
	}
	$("html, body").animate({ scrollTop: 200 }, "slow");
});
/* ======== First Submit ======== */

/* ======== First Button Back ====== */
$(document).on('click', '#frstback', function(event) {
	event.preventDefault();
	$(".headtab").removeClass("fade active show");
	$(".tab-pane").removeClass("fade active show");
	$(".tab-pane").addClass("fade");
	$("#info-tab").addClass(" active ");
	$("#info").addClass(" active show");
	$("html, body").animate({ scrollTop: 200 }, "slow");
	
});
/* ======== First Button Back ====== */

/* ======== Second Submit ======== */
$(document).on('click', '#secndbtn', function(event) {
	event.preventDefault();
	$(".hide").removeClass("srequired");
	svalid=true;
	$(".has-error").removeClass("has-error");
	$(".txt-error").removeClass("txt-error");
	$(".srequired").each(function(index, el) 
	{
		if(!$(el).val())
		{
			svalid=false;
			$(this).addClass('has-error');
			$(this).parent().addClass('txt-error');
		}  
		//console.log(svalid);
	});

	if(svalid){
		$(".headtab").removeClass("fade active show");
		$(".tab-pane").removeClass("fade active show");
		$(".tab-pane").addClass("fade");
		$("#photo-tab").addClass(" active ");
		$("#photo").addClass(" active show");
	}
});
/* ======== Second Submit ======== */

/* var date = new Date();
var yr = date.getFullYear();
var mnth = date.getMonth();
var day = date.getDate();
var currDate = date.toISOString().slice(0, 10);

console.log(currDate) */

$('.inputselct').select2();
flatpickr("#possdate", { ltInput: true,
    dateFormat: "Y-m-d",   
	minDate:  new Date()
});
function isValid(id, regExp)
{
	var regExp = new RegExp(regExp);
	var value = $("#"+id).val();
	if(!regExp.test(value))
	{
		$("#"+id).val('');
		$("#err_"+id).text('');
		$("#"+id).removeClass("has-error");
		$("#"+id).parent().removeClass('txt-error');
	}
}
function youtubePreview(regExp)
{
	var yLink = $("#youtube_link").val();
	var regExp = new RegExp(regExp);
	if(!regExp.test(yLink))
	{
		$("#youtube_link").val('');
		$("#err_youtube_link").text('');
		$("#youtube_link").removeClass("has-error");
		$("#youtube_link").parent().removeClass('txt-error');
	}
	else
	{
		yLink = yLink.replace("watch?v=", "embed/");
		$("#youtube_preview").html("<iframe width='350' height='300' src='"+yLink+"'></iframe>");
	}
	
}
function setPropertyCost(val)
{
	$("#propertyCost").text(val);
}
function propertyDesc(val) 
{
	$("#propertyDesc").html('<b>Desc</b>: '+val);
}
function builtArea(val)
{
	/* var propertyType = $("#protyp").val();
	var val = val+((propertyType!='1')? ' sq.ft' : ' sq.yd'); */
	var val = val+' sq.ft';
	$("#propertyArea").html('<b>Built Up Area</b>: '+val);
}
function totalArea(val)
{
	var val = val+' sq.yd';
	$("#propertyTotalArea").html('<b>Total Area</b>: '+val);
}
function calcPlotArea(type)
{
	if(type=='plot')
	{
		var area = $("#plot_area").val();
		$("#propertyArea").html('<b>Area</b>: '+area+' sq.yd');
	}
	else if(type=='al')
	{
		var acres = $("#area_in_acre").val();
		var guntha = $("#area_in_guntha").val();
		if(acres=='' && guntha!='')
		{
			$("#area_in_acre").val('0');
		}
		if(guntha=='' && acres!='')
		{
			$("#area_in_guntha").val('0');
		}
		$("#propertyArea").html('<b>Area</b>: '+acres+' Acre(s), '+guntha+' Guntha(s)');
	}
	/* var area = (type=='plot')? $("#plot_area").val() : $("#al_area").val();
	var unit = (type=='plot')? 'Sq. Yd.' : $("#plot_unit").val(); */
	/* var length = $("#plot_length").val();
	var width = $("#plot_width").val(); */
	
	/* if(length!='' && width!='' && (parseInt(length)*parseInt(width)!=parseInt(area)))
	{
		$("#err_plot_length, #err_plot_width, #plot_area").html("Area value not matched.");
	}
	else
	{
		$("#err_plot_length, #err_plot_width, #plot_area").html("");
	} */
	
}
/* ====== enable & hide option for more like balcony, parking areas count ===  */
function removeHide(className)
{
	$("."+className+".more-hide").removeClass("more-hide");
	$("."+className+"_hide").addClass("more-hide");
}
/* ====== enable & hide option for more like balcony, parking areas count ===  */
/* ======== image preview ===== */




/* ======== image preview ===== */


	jQuery(document).ready(function($) 
	{
		
		flatpickr("#posdt", {
			enableTime: true,
			dateFormat: "Y-m-d",
		});





		
		$(document).on('click', '.procls', function(event) {
			event.preventDefault();
			$(".procls").removeClass("active").removeClass("has-error");
			$(".procls").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#procls").val($(this).data('val'));
			if($(this).data('val')==1){
				$(".rent").removeClass("hide");
			}else{
				$(".rent").addClass("hide");
			}
		});
		
		$(document).on('click', '.prosts', function(event) {
			event.preventDefault();
			$(".prosts").removeClass("active").removeClass("has-error");
			$(".prosts").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#prosts").val($(this).data('val'));
		});
		
		
		
		$(document).on('click', '.bedroom', function(event) {
			event.preventDefault();
			$(".bedroom").removeClass("active").removeClass("has-error");
			$(".bedroom").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#bedroom").val($(this).data('val'));
			var propertyType = ($("#protyp").val()!= '0')? $("#protyp").val() : '';
			if(propertyType!=3 && propertyType!=5)
			{
				//var bhks = <?php echo json_encode($BHKARR);?>;
				$("#typeOfBHK").text($(this).data('val'));
			}
		});
		$(document).on('click', '.bathroom', function(event) {
			event.preventDefault();
			$(".bathroom").removeClass("active").removeClass("has-error");
			$(".bathroom").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#bathroom").val($(this).data('val'));
		});
		$(document).on('click', '.facing', function(event) {
			event.preventDefault();
			$(".facing").removeClass("active").removeClass("has-error");
			$(".facing").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#facing").val($(this).data('val'));
		});
		$(document).on('click', '.bacony', function(event) {
			event.preventDefault();
			$(".bacony").removeClass("active").removeClass("has-error");
			$(".bacony").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#bacony").val($(this).data('val'));
		});
		$(document).on('click', '.furnish', function(event) {
			event.preventDefault();
			$(".furnish").removeClass("active").removeClass("has-error");
			$(".furnish").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#furnish").val($(this).data('val'));
		});
		$(document).on('click', '.copark', function(event) {
			event.preventDefault();
			$(".copark").removeClass("active").removeClass("has-error");
			$(".copark").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#copark").val($(this).data('val'));
		});
		$(document).on('click', '.opnpark', function(event) {
			event.preventDefault();
			$(".opnpark").removeClass("active").removeClass("has-error");
			$(".opnpark").parent().parent().removeClass('txt-error');
			$(this).addClass("active");
			$("#opnpark").val($(this).data('val'));
		});
		/* $(document).on('click', '.secpre', function(event) {
			event.preventDefault();
			$(".secpre").removeClass("active");
			$(this).addClass("active");
			$("#secpre").val($(this).data('val'));
		});
		$(document).on('click', '.rentyp', function(event) {
			event.preventDefault();
			$(".rentyp").removeClass("active");
			$(this).addClass("active");
			$("#rentyp").val($(this).data('val'));
		}); */
		
		$(document).on('click', '.amnenitis', function(event) {
			event.preventDefault();
			$(this).toggleClass("active");
			var amenval=[];
			$("._leads_status>.amnenitis.active").each(function(index, el)
			{
				if($(el).data('val')!='')
				{
					amenval.push($(el).data('val'));
				}
			});
			
			amenval = (amenval.length>0)? (JSON.stringify(amenval).replace("[", ",").replace("]", ",")) : '';
			/* 
			if($(this).hasClass("active")){
				amenval+=","+$(this).data("val").toString();
			} */
			
			$("#amnenitis").val(amenval);

		});
		$(document).on('click', '.socamnenitis', function(event) {
			event.preventDefault();
			$(this).toggleClass("active");
			
			var soamenval=[];
			$("._leads_status>.socamnenitis.active").each(function(index, el)
			{
				if($(el).data('val')!='')
				{
					soamenval.push($(el).data('val'));
				}
			});
			
			soamenval = (soamenval.length>0)? (JSON.stringify(soamenval).replace("[", ",").replace("]", ",")) : '';
			
			/* if($(this).hasClass("active")){
				soamenval+=","+$(this).data("val").toString();
			} */
			
			$("#socamnenitis").val(soamenval);

		});
		/* $("#btnsubmit").on("keypress", function (event) {
            //console.log("aaya");
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
               // alert("You pressed the Enter key!!");
                event.preventDefault();
                return false;
            }
        }); */
	});
	$('#frmprop').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>