<?php
	$sesUserName = $session->getUserName();
	$sesUserEmail = $session->getUserEmail();
	$sesUserMobile = $session->getUserMobile();
	$isAdmin = $session->isAdmin();
	$userId = $session->getUserId();
	$isEmployeeLoggedin = $session->isEmployeeLoggedin();
?>

<style>.hidden{display:none}</style>
<!-- Gallery Part Start -->
<section class="gallery_parts pt-2 pb-2">
	<div class="container">
		<div class="row align-items-center">
			<?php 
				/* $prpobj->where("pr_id",$prid);
				$proimgarr=$prpobj->get("property_gallery",null,"*"); */
				
				$proimgarr = $db->getRecordsArray("SELECT * FROM `".TBL_GALLERY."` WHERE `pr_id`='".$prid."'");
				$imgcnt = count($proimgarr);
				$popimg = $imgcnt-2;
			?>
			<div class="col-lg-8 col-md-7 col-sm-12 ">
				<div class="gg_single_part left">
					<?php if(isset($proimgarr[0]["pr_img"])) { ?>
						<a href="<?php echo ROOT.PR_UPLOAD_PATH."/".$proimgarr[0]["pr_img"]?>" class="mfp-gallery">
							<img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$proimgarr[0]["pr_img"]?>" class="img-fluid mx-auto" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" style="width: 770px;height: 330px;" />
						</a>
					<?php } else { ?>
						<a href="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="mfp-gallery">
							<img src="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="img-fluid mx-auto" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" style="width: 770px;height: 330px;" />
						</a>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-5 col-sm-12 ">
				<?php 
					if(count($proimgarr)>0)
					{
						foreach ($proimgarr as $key => $img) {
							$hidcls=$key>=2?"hidden":"";
				?>
						<div class="gg_single_part-right min <?php echo $hidcls?>" style="margin-bottom: 2%;margin-top: 2%;"><a   href="<?php echo ROOT.PR_UPLOAD_PATH."/".$img["pr_img"]?>" class="mfp-gallery">
							<img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$img["pr_img"]?>" class="img-fluid mx-auto" alt=""  onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" />
							<?php if($popimg>0){?>
								<div style="width: 92%;height: 47%;background-color: rgba(149, 149, 149, 0.55);top: 172px;position: absolute;cursor: pointer;pointer-events: none;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;-webkit-align-items: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;color: white;font-size: 24px;border-radius: 5px;">+<?php echo $popimg?> more</div>
							<?php }?>
							</a>
						</div>

				<?php 
						}
					} else { 
				?>
						<div class="gg_single_part-right min>" style="margin-bottom: 2%;margin-top: 2%;">
							<a href="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="mfp-gallery">
								<img src="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="img-fluid mx-auto" alt=""  />
							</a>
						</div>
						<div class="gg_single_part-right min" style="margin-bottom: 2%;margin-top: 2%;">
							<a href="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="mfp-gallery">
								<img src="<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg" class="img-fluid mx-auto" alt=""  />
							</a>
						</div>
				<?php 
					} 
				?>
			</div>
		</div>
	</div>
</section>

<section class="gallery_bottom_block">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="mb-3 row">
					<div class="col-12 text-center">
						<div class="p-10" style="background: rgba(37, 181, 121,0.1);color: #25b579;">
							Property Id: <?php echo isset($prop['pr_reg_code'])? $prop['pr_reg_code'] : ''; ?>
						</div>
					</div>
				</div>
				<div class=""><!-- property_lexible-1 -->
					<div class="row">
						<div class="col-lg-4 col-md-4">
							<div class="pr-price-into" ><!--  style="margin-right: 100px !important;" flex-1 -->
								<div class="_card_list_flex mb-2">
									<div class="_card_flex_01">
										<span class="_list_blickes types"><?php echo $CATARR[$prop["pr_cat"]]?> </span>
									</div>
								</div>
								<h2><?php echo isset($LOCATNARR[$prop["pr_location"]])? $LOCATNARR[$prop["pr_location"]] : ''?></h2>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="price_into_last float-right" style="width:100%">
								<h2 class="float-right">₹<?php echo ($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)? $prop["pr_cost"] : $prop["pr_plot_cost"]; ?></h2>
								<div class="list-fx-features1">
									<?php
										if($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)
										{
									?>
											<div class="listing-card-info-icon1">
												<span><img src="<?php echo ROOT?>assets/img/bed.svg" alt=""><?php echo $prop["pr_bhk"]?></span>
											</div>
											<div class="listing-card-info-icon1">
												<span><img src="<?php echo ROOT?>assets/img/bath.svg" alt=""><?php echo $prop["pr_bath"]?></span>
											</div>
											<div class="listing-card-info-icon1">
												<span><img src="<?php echo ROOT?>assets/img/area.svg" alt=""><?php //echo $prop["pr_build"]?> <?php echo ($prop["pr_cat"]==1)? $prop["pr_build"].' sq.ft' : $prop["pr_total_area"].' sq.yd'?></span>
											</div>
									<?php	
										} else if($prop["pr_cat"] == 3) {
											
									?>
											<div class=""><!-- listing-card-info-icon -->
												<span><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"><?php echo $prop["pr_plot_area"].' '.$prop["pr_plot_unit"]; ?></span>
											</div>
									<?php
										} else if($prop["pr_cat"] == 5) {
									?>
											<div class=""><!-- listing-card-info-icon -->
												<span><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"><?php echo (($prop["pr_area_in_acre"]>0)? $prop["pr_area_in_acre"] : 0).' Acres '.(($prop["pr_area_in_guntha"]>0)? $prop["pr_area_in_guntha"] : 0).' Gunthas' ; ?></span>
											</div>
									<?php											
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12"></div>
		</div>
	</div>
</section>
<!-- ============================ property Name End ================================== -->

<!-- ============================ Property Detail Start ================================== -->
<section class="gray" style="padding-top: 20px;">
	<div class="container">
		<div class="row">
			<!-- property main detail -->
			<div class="col-lg-8 col-md-12 col-sm-12">
				<!-- Single Block Wrap -->
				<div class="property_block_wrap">
					<div class="property_block_wrap_header">
						<h4 class="property_block_title">About Property</h4>
					</div>
					<div class="block-body">
						<p><?php echo $prop["pr_decri"]?>.</p>
					</div>
				</div>

				<!-- Single Block Wrap -->
				<?php if($prop["pr_cat"]!=3 && $prop["pr_cat"]!=5) { ?>
					<div class="property_block_wrap">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title"> Features</h4>
						</div>
						<div class="block-body">
							<ul class="row p-0 m-0">
								<?php if($prop["pr_cat"]!=1) { ?>
									<li class="col-lg-4 col-md-6 mb-2 p-0"><b>Total Area : </b><?php echo $prop["pr_total_area"]?> sq.yd</li>
								<?php } ?>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><b>Built Up Area : </b><?php echo $prop["pr_build"]?> sq.ft</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-bed mr-1"></i><?php echo $prop["pr_bhk"]?> Bedrooms</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-bath mr-1"></i><?php echo $prop["pr_bath"]?> Bathrooms</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-home mr-1"></i><?php echo $prop["pr_balcony"]?> Balcony</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-car mr-1"></i><?php echo ($prop["pr_parking"]>0)? $prop["pr_parking"]:"0"; ?>Car Parking</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0"><?php echo ($prop["pr_opnpark"]>0)? $prop["pr_opnpark"]:'0'; ?> Open Parking</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Facing - <button class="btn btn-info btn-xs"><?php echo isset($FACARR[$prop["pr_facing"]])? $FACARR[$prop["pr_facing"]] : '';?></button> </li>
								<!--<li class="col-lg-4 col-md-6 mb-2 p-0">Locality-<?php echo $prop["pr_locality"]?> </li>-->
								<li class="col-lg-4 col-md-6 mb-2 p-0">Status - <button class="btn btn-info btn-xs"><?php echo $prop["pr_constru"]==1?"Ready to Move":"Under Construction"?></button> </li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Property Age - <?php echo ($prop["pr_agepro"]>0)? '<button class="btn btn-info btn-xs">'.$prop["pr_agepro"].' Years</button>' : ""; ?> </li>
							</ul>
						</div>
					</div>
				<?php } ?>
				
				<?php if($prop["pr_cat"]==3) { ?>
					<div class="property_block_wrap">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title"> Features</h4>
						</div>
						<div class="block-body">
							<ul class="row p-0 m-0">
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-expand-arrows-alt mr-1"></i><?php echo $prop["pr_plot_area"]; ?> sq.yd</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Facing-<?php echo isset($FACARR[$prop["pr_facing"]])? $FACARR[$prop["pr_facing"]] : '';?> </li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Type Of Road-<?php echo $ROAD_TYPES[$prop["pr_road_type"]]?> </li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Width Of Facing Road -<?php echo $prop["pr_width_road_facing"]; ?> ft</li>
							</ul>
						</div>
					</div>
				<?php } ?>
				
				<?php if($prop["pr_cat"]==5) { ?>
					<div class="property_block_wrap">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title"> Features</h4>
						</div>
						<div class="block-body">
							<ul class="row p-0 m-0">
								<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-expand-arrows-alt mr-1"></i><?php echo ($prop["pr_area_in_acre"]>0)? $prop["pr_area_in_acre"] : 0; ?> Acres, <?php echo ($prop["pr_area_in_guntha"]>0)? $prop["pr_area_in_guntha"] : 0 ; ?> Gunthas</li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Facing-<?php echo isset($FACARR[$prop["pr_facing"]])? $FACARR[$prop["pr_facing"]] : ''; ?> </li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Type Of Road-<?php echo $ROAD_TYPES[$prop["pr_road_type"]]?> </li>
								<li class="col-lg-4 col-md-6 mb-2 p-0">Width Of Facing Road -<?php echo $prop["pr_width_road_facing"]; ?> ft</li>
							</ul>
						</div>
					</div>
				<?php } ?>
				
				<!-- <div class="property_block_wrap">
					<div class="property_block_wrap_header">
						<h4 class="property_block_title"> Address</h4>
					</div>
					<div class="block-body">
						<iframe src="https://www.google.com/maps/place/Anaparthi,+Andhra+Pradesh/@16.9335084,81.946657,15z/data=!3m1!4b1!4m5!3m4!1s0x3a3790b29ea88a17:0xf79d3317a6a5626e!8m2!3d16.9340866!4d81.9555307" width="100%" height="300px"></iframe>
					</div>
				</div> -->
				<!-- Single Block Wrap -->
				
				<?php if($prop["pr_cat"]!=3 && $prop["pr_cat"]!=5) { ?>
					<?php if(isset($prop["pr_amnenitis"]) && $prop["pr_amnenitis"]!='') { ?>
						<div class="property_block_wrap">
							<?php
								$amstr=trim($prop["pr_amnenitis"],",");
								$ammarr=explode(",",$amstr);
								if($ammarr[0]){
							?>
								<div class="property_block_wrap_header">
									<h4 class="property_block_title"> Other Amenities</h4>
								</div>
								<div class="block-body">
									<ul class="row p-0 m-0">
										<?php 
											$ammMap=trim($prop["pr_amnenitis"],",");
											foreach($ammarr AS $amn)
											{
												if(isset($ammMap[$amn]))
												{
										?>    
													<li class="col-lg-4 col-md-6 mb-2 p-0"><img src="<?php echo ROOT.'assets/img/'.$ammMap[$amn]["ikon"]; ?>" style="width: 18%;" alt=""> <?php echo $ammMap[$amn]['name']; ?> </li>
										<?php 	
												}
											}
										?>
									</ul>
								</div>
							<?php }?>
						</div>
					<?php }?>
					<?php if(isset($prop["pr_soamnenitis"]) && $prop["pr_soamnenitis"]!='') { ?>
						<div class="property_block_wrap">
							<?php
								$soamstr=trim($prop["pr_soamnenitis"],",");
								$soammarr=explode(",",$soamstr);
								if(count($soammarr)>0){
							?>
							<div class="property_block_wrap_header">
								<h4 class="property_block_title"> Society Amenities</h4>
							</div>
							<div class="block-body">
								<ul class="row p-0 m-0">
									<?php 
										$soAmmMap = $function->dataMapping($SOAMNTARR, 'id');
										foreach($soammarr AS $soamn)
										{
											if(isset($soAmmMap[$soamn]))
											{
									?>
												<li class="col-lg-4 col-md-6 mb-2 p-0"><img src="<?php echo ROOT.'assets/img/'.$soAmmMap[$soamn]["ikon"]; ?>" style="width: 18%;" alt=""> <?php echo isset($soAmmMap[$soamn]['name'])? $soAmmMap[$soamn]['name'] : ''; ?> </li>
									<?php
											}
										}
									?>
								</ul>
							</div>
							<?php }?>
						</div>
					<?php }?>
				<?php }?>
				<!-- Single Block Wrap -->
				<!-- Single Block Wrap -->
				<?php 
					//if($prop["pr_link"]){
				?>
					<!--
					<div class="property_block_wrap">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title">Location</h4>
						</div>
						<div class="block-body">
							<div class="map-container">
								<iframe src="<?php //echo $prop["pr_link"]?>" class="full-width" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div>
					</div>
					-->
				<?php //}?>
				
				
				
				<?php
					if($prop["pr_youtube_link"]!='')
					{
						/* property_block_wrap */
						echo '<div class="">';
							echo '<div class="property_block_wrap_header">';
								echo '<h4 class="property_block_title"></h4>';
							echo '</div>';
							echo '<div class="block-body">';
								echo '<iframe width="100%" height="450" src="'.str_replace("watch?v=", "embed/", (isset($prop["pr_youtube_link"])? $prop["pr_youtube_link"] : '')).'"></iframe>';
							echo '</div>';
						echo '</div>';
					}
				?>
				<?php //echo "cond:".($prop["u_id"]>0);  ?>
				<?php //if($isAdmin || ($prop["a_id"]==$userId) || ($prop["u_id"]>0)){ ?>
				<?php //if($isAdmin || $isEmployeeLoggedin || ($prop["u_id"]>0)){ ?>
				<?php if($isAdmin){ ?>
					<div class="property_block_wrap my-3">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title"><?php echo isset($IWANTARR[$prop["pr_type"]])? $IWANTARR[$prop["pr_type"]] : ''; ?> Details</h4>
						</div>
						<div class="block-body">
							<ul class="row p-0 m-0 font-12">
								<?php 
									if($isAdmin && $prop["a_id"]>0)
									{
								?>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-user"></i> <?php echo isset($prop["pr_owner_name"])? ucfirst(strtolower($prop["pr_owner_name"])) : ''; ?> </li>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-envelope"></i> <?php echo isset($prop["pr_owner_email"])? strtolower($prop["pr_owner_email"]) : ''; ?> </li>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-phone"></i> <?php echo isset($prop["pr_owner_phone"])? $prop["pr_owner_phone"] : ''; ?> </li>
								<?php
									} 
									else
									{
								?>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-user"></i> <?php echo isset($prop["AgentName"])? ucfirst(strtolower($prop["AgentName"])) : ''; ?> </li>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-envelope"></i> <?php echo isset($prop["AgentEmail"])? strtolower($prop["AgentEmail"]) : ''; ?> </li>
										<li class="col-lg-4 col-md-6 mb-2 p-0"><i class="fa fa-phone"></i> <?php echo isset($prop["AgentPhone"])? $prop["AgentPhone"] : ''; ?> </li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
				<?php } ?>
				
						
					
				
			</div>
			<!-- property Sidebar -->
			<div class="col-lg-4 col-md-12 col-sm-12">
				<div class="property-sidebar">
					<?php
						/* if($prop["pr_youtube_link"]!='')
						{
							echo '<div class="sider_blocks_wrap p-3">';
								echo '<iframe width="100%" height="300" src="'.str_replace("watch?v=", "embed/", $prop["pr_youtube_link"]).'"></iframe>';
							echo '</div>';
						} */
					?>
					<div class="sider_blocks_wrap p-3">
						<div class="text-center">
							<h2 class="mb-0">Contact Seller</h2>
							<a class="_calss_tyui" href="tel:7013107291">Please share your contact</a>
						</div>
						<?php
							/* $prpobj->where("u_id",$prop["u_id"]);
							$usearr=$prpobj->getOne("user","*"); */
							$usearr = $db->getSingleRowArray("SELECT * FROM `".TBL_USER."` WHERE `u_id`='".$prop["u_id"]."'");;
						?>
						<div  class="text-bold text-warning hide cntphone">Contact Phone :<span id=""><?php echo (isset($usearr["u_phone"]))? $usearr["u_phone"] : ''; ?></span></div>
						<div id="noty" class="text-success"></div>
						<div class="login-form">
							<form method="POST" name="frmenquiry" id="frmenquiry">
								<input type="hidden" name="action" value="enquiry">
								<input type="hidden" name="prid" value="<?php echo (isset($prop["pr_id"]) && $prop["pr_id"]>0)? $prop["pr_id"] : 0; ?>">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="form-group enquiry-form">
											<label>Name</label><span class="text-danger"> * <span id="err_name" class="err-msg"></span></span>
											<input type="text" class="form-control required" name="txtname" value="<?php echo $sesUserName;?>" id="txtname" placeholder="Name" onkeyup="checkValidate('txtname', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
										</div>
									</div>
									<div class="col-lg-12 col-md-12">
										<div class="form-group enquiry-form">
											<label>Email</label><span class="text-danger"> * <span id="err_email" class="err-msg"></span></span>
											<input type="email" class="form-control required" name="txtemail" value="<?php echo $sesUserEmail;?>" id="txtemail" placeholder="Email" onkeyup="checkValidate('txtemail', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])" />
										</div>
									</div>
									<div class="col-lg-12 col-md-12">
										<div class="form-group enquiry-form">
											<label>Phone</label><span class="text-danger"> * <span id="err_phone" class="err-msg"></span></span>
											<input type="text" class="form-control required" name="txtphone" value="<?php echo $sesUserMobile;?>" id="txtphone" placeholder="Phone" onkeyup="checkValidate('txtphone', /^[0-9+ ]{0,15}$/, '', ['Please Enter Phone', 'Enter Digits only.'])">
										</div>
									</div>
								</div>
								<div class="default-terms_wrap"></div>
								<div class="default-terms_wrap">
									<div class="default-terms_flex">
										<input id="tm" class="checkbox-custom" name="tm" type="checkbox">
										<label for="tm" class="checkbox-custom-label"></label>
									</div>
									<div class="default-terms">I agree to be contacted by Gharapnaa and other
									agents via WhatsApp, SMS, Phone, Email ect</div>
								</div>
								<div class="notify"></div>
								<div class="form-group">
									<button type="submit" class="btn btn-md full-width pop-login">Send Message</button>
								</div>
							</form>
						</div>
					</div>
					<!-- Featured Property -->
					<div class="sidebar-widgets">
						<h4>Similar Property</h4>
						<div class="sidebar_featured_property">
							<?php 
								//ini_set("display_errors",1);
								/* $prpobj->where("pr_cat",$prop['pr_cat']);
								$prpobj->orderBy("pr.pr_id","DESC");
								$prpobj->join("property_gallery pg","pg.pr_id=pr.pr_id","INNER");
								$procatarr=$prpobj->get("property pr",4,"*"); */
								
								$procatarr = $db->getRecordsArray("SELECT `pr`.*, `pg`.`pr_img` FROM `".TBL_PROPERTY."` `pr` INNER JOIN `".TBL_GALLERY."` `pg` ON `pr`.`pr_id`=`pg`.`pr_id` WHERE `pr_is_publish`=1 AND `pr`.`pr_status`=1 AND `pr`.`pr_cat`='".$prop['pr_cat']."' ORDER BY `pr`.`pr_id` DESC LIMIT 0, 4");
								
								
								
								//echo $prpobj->getLastQuery();
								if(count($procatarr)>0)
								{
									foreach ($procatarr as $key => $catpro) 
									{
							?>
									<!-- List Sibar Property -->
									<div class="sides_list_property">
										<div class="sides_list_property_thumb">
											<img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$catpro["pr_img"]?>" class="img-fluid" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';" />
										</div>
										<div class="sides_list_property_detail">
											<h4><a href="<?php echo ROOT."property-details/".$catpro['pr_id']."/"; ?>"><?php echo $LOCATNARR[$catpro["pr_location"]]?></a></h4>
											<div class="lists_property_price">
												<div class="lists_property_types">
													<div class="property_types_vlix sale">For Sale</div>
												</div>
												<div class="lists_property_price_value">
													<h4>₹ <?php echo ($catpro["pr_cat"]==3 || $catpro["pr_cat"]==5)? $catpro["pr_plot_cost"] : $catpro["pr_cost"]?></h4>
												</div>
											</div>
										</div>
									</div>
							<?php 
									}
								}
							?>
							<!-- List Sibar Property -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
		
	jQuery(document).ready(function($) {
		$(document).on("submit","#frmenquiry",function(e){
			e.preventDefault();

			valid = true;
			$(".enquiry-form>.required").each(function(index, el)
			{
				if($(el).val()=='')
				{
					valid = false;
					$(this).addClass('has-error');
					$(this).parent().addClass('txt-error');
				}
			});
			
			if(valid)
			{
				$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
				$(".has-error").removeClass('has-error');
				$(".txt-error").removeClass('txt-error');
				
				frmdata=$("#frmenquiry").serialize();
				$.ajax({
				url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:frmdata ,
					success:function(response){
						//console.log(response)
						//$("#frmenquiry")[0].reset();
						jsn=$.parseJSON(response);
						$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
					}
				})
				.done(function() {
					//console.log("success");
				});

			}
		});
	});
</script>