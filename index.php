<?php 

//include("template.php");

	include("includes/config.php");
	//include("includes/MysqliDb.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/session.php"); */
	//$conn = getDBConnection();
	$alertMsgArr = array();
?>
<?php include_once("header.php"); ?>
<!-- ============================ Hero Banner  Start================================== -->
	<div class="image-cover hero_banner" style="background:url(assets/img/banner-3.png) no-repeat;" data-overlay="0">
		<div class="container">
			<h1 class="big-header-capt mb-0">Search Your Next Home</h1>
			<p class="text-center mb-4">Find new & featured property located in your local city.</p>
			<!-- Type -->
			<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12 col-md-12">
					<div class="full_search_box nexio_search lightanic_search hero_search-radius modern">
						<div class="search_hero_wrapping">
							<form action="<?php echo ROOT.($session->isAdmin()? ADMIN_PR_BUY : USER_PR_BUY); ?>" method="POST">
								<div class="row">
									<div class="col-lg-5 col-md-5 col-sm-12">
										<div class="form-group">
											<label>Type of property</label>
											<div class="input-with-icon">
												<select id="ptypes" class="form-control inputselct" name="ptypes">
													<option value="">Select</option>
													<?php
														foreach($CATARR as $key => $val)
														{
															echo '<option value="'.$key.'">'.$val.'</option>';
														}
													
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label>City</label>
											<div class="input-with-icon">
												<select id="txtloc" class="form-control inputselct" name="txtloc">
													<option value="">All Location</option>
													<?php 
														foreach($locarr AS $loc){
													?>
														<option value="<?php echo $loc["loc_id"]?>"><?php echo $loc["loc_name"]?></option>
													<?php
														}
													?>    
												</select>
											</div>
										</div>
									</div>

									<!--
									<div class="col-lg-3 col-md-3 col-sm-12 d-md-none d-lg-block">
										<div class="form-group">
											<label>locality</label>
											<div class="input-with-icon">
												<select id="txtLocality" class="form-control " name="txtLocality">
													<option value=''>All Locality</option>
												</select>
											</div>
										</div>
									</div>
									-->
									<div class="col-lg-1 col-md-2 col-sm-12 small-padd">
										<div class="form-group none">
											<button type="submit" class="btn search-btn"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</form>
							<!-- Collapse Advance Search Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- ============================ Hero Banner End ================================== -->

<!-- ============================ Property Type Start ================================== -->
	<section class="gray-simple min pt-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="sec-heading center">
						<h2>Featured Property Types</h2>
						<p>Find All Type of Property.</p>
					</div>
				</div>
			</div>
			<?php
				/* $prpobj->groupBy("pr_cat");
				$prpobj->where("pr_status",1);
				$prpobj->where("pr_is_publish",1);
				$proarr=$prpobj->get("property",null,"COUNT(pr_id) AS cnt,pr_cat"); */
				$proarr = $db->getRecordsArray("SELECT COUNT(pr_id) AS cnt,pr_cat FROM `".TBL_PROPERTY."` WHERE `pr_is_publish`=1 AND `pr_status`=1 GROUP BY `pr_cat`");
				foreach($proarr AS $prop){
					$procnt[$prop['pr_cat']]=$prop["cnt"];
				}
			?>
			<div class="row justify-content-center">
				<div class="col-lg col-md-4">
					<!-- Single Category -->
					<div class="property_cats_boxs">
						<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_FEATURED_APART : USER_FEATURED_APART).'1/'; ?>" class="category-box">
							<div class="property_category_short">
								<div class="category-icon clip-1"><i class="flaticon-beach-house-2"></i></div>
								<div class="property_category_expand property_category_short-text">
									<h4>Apartment </h4>
									<p><?php echo (isset($procnt[1]) && $procnt[1]>0)?$procnt[1]:0?> Property</p>
								</div>
							</div>
						</a>	
					</div>
				</div>
				<div class="col-lg col-md-4">
					<!-- Single Category -->
					<div class="property_cats_boxs">
						<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_FEATURED_HOME : USER_FEATURED_HOME).'1/'; ?>" class="category-box">
							<div class="property_category_short">
								<div class="category-icon clip-2">
									<i class="flaticon-cabin"></i>
								</div>
								<div class="property_category_expand property_category_short-text">
									<h4>Independent Home</h4>
									<p><?php echo (isset($procnt[2]) && $procnt[2]>0)?$procnt[2]:0?> Property</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg col-md-4">
					<!-- Single Category -->
					<div class="property_cats_boxs">
						<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_FEATURED_PLOT : USER_FEATURED_PLOT).'1/'; ?>" class="category-box">
							<div class="property_category_short">
								<div class="category-icon clip-3">
									<i class="flaticon-apartments"></i>
								</div>
								<div class="property_category_expand property_category_short-text">
									<h4>Plot</h4>
									<p><?php echo (isset($procnt[3]) && $procnt[3]>0)?$procnt[3]:0?> Property</p>
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg col-md-4">
					<!-- Single Category -->
					<div class="property_cats_boxs">
						<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_FEATURED_VILLA : USER_FEATURED_VILLA).'1/'; ?>" class="category-box">
							<div class="property_category_short">
								<div class="category-icon clip-4">
									<i class="flaticon-student-housing"></i>
								</div>
								<div class="property_category_expand property_category_short-text">
									<h4>Villa</h4>
									<p><?php echo (isset($procnt[4]) && $procnt[4]>0)?$procnt[4]:0?> Property</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg col-md-4">
					<!-- Single Category -->
					<div class="property_cats_boxs">
						<a href="<?php echo ROOT.($session->isAdmin()? ADMIN_FEATURED_AGRI_LAND : USER_FEATURED_AGRI_LAND).'1/'; ?>" class="category-box">
							<div class="property_category_short">
								<div class="category-icon clip-5">
									<i class="flaticon-modern-house-4"></i>
								</div>
								<div class="property_category_expand property_category_short-text">
									<h4> Agriculture Land</h4>
									<p><?php echo (isset($procnt[5]) && $procnt[5]>0)?$procnt[5]:0?> Property</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- ============================ Property Type End ================================== -->

<!-- ============================ Recent Property Start ================================== -->

	<section class="pt-0 min pt-3">
		<div class="container" style="padding-top: 50px;">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-8">
					<div class="sec-heading center">
						<h2>Featured Listed Property</h2>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<?php 
					//$uid=$_SESSION['UID'];
					
					$wlid = "";
					$userId = $session->getUserId();
					
					if($userId>0)
					{
						$getQuery = "SELECT `pr`.*, `wl`.`wl_id` FROM `".TBL_PROPERTY."` `pr` LEFT JOIN `".TBL_WISHLIST."` `wl` ON `pr`.`pr_id`=`wl`.`pr_id` AND `wl`.`u_id`='".$userId."' WHERE `pr_is_publish`=1 AND `pr_status`=1 ORDER BY `pr_id` DESC LIMIT 0, 3";
					}
					else
					{
						$getQuery = "SELECT * FROM `".TBL_PROPERTY."` WHERE `pr_is_publish`=1 AND `pr_status`=1 ORDER BY `pr_id` DESC LIMIT 0, 3";
					}
					$proarr = $db->getRecordsArray($getQuery);
					
					
					/* $wlid = "";
					ini_set("display_errors",1);
					$prpobj->orderBy('pr.pr_id',"DESC");
					$prpobj->where("pr_status",1);
					$prpobj->where("pr_is_publish",1);					
					if(isset($_SESSION['UID'])){
						$prpobj->join("wishlist wl","pr.pr_id=wl.pr_id AND wl.u_id=$_SESSION[UID]","LEFT");
						$wlid=$_SESSION['UID']?",wl.wl_id":"";
					}
					$proarr=$prpobj->get("property pr",3,"pr.pr_id,pr.u_id,pr.pr_title,pr.pr_decri,pr.pr_type,pr.pr_cat,pr.pr_age,pr.pr_bhk,pr.pr_room,pr.pr_bath,pr.pr_balcony,pr.pr_parking,pr.pr_opnpark,pr.pr_location,pr.pr_locality,pr.pr_cost,pr.pr_maintarea,pr.pr_furnish,pr.pr_build,pr.pr_buildproj,pr.pr_carpt,pr.pr_offer,pr.pr_constru,pr.pr_flatno,pr.pr_floor,pr.pr_addr,pr.pr_city,pr.pr_dist,pr.pr_state,pr.pr_ttlfllor,pr.pr_contactname,pr.pr_amnenitis,pr.pr_soamnenitis,pr.pr_posdt,pr.pr_agepro,pr.pr_mobile,pr.pr_email,pr.pr_link,pr.pr_posts,pr.pr_lenth,pr.pr_width,pr.pr_plot_area,pr.pr_plot_cost,pr.pr_plot_unit,pr.pr_area_in_acre,pr.pr_area_in_guntha,pr.pr_total_area,pr.pr_status$wlid");
					//echo $prpobj->getLastQuery(); */
					foreach ($proarr as $key => $prop) {
				?>	
					<!-- Single Property -->
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="property-listing property-2">
							<div class="listing-img-wrapper">
								<div class="list-img-slide">
									<div class="click">
										<?php 
											/* $prpobj->where("pr_id",$prop['pr_id']);
											$proimgarr=$prpobj->get("property_gallery",null,"*"); */
											$proimgarr = $db->getRecordsArray("SELECT * FROM `".TBL_GALLERY."` WHERE `pr_id`='".$prop['pr_id']."'");;
											if(count($proimgarr)>0){
												foreach ($proimgarr as $key => $img) {
										?>
													<div><a href="<?php echo ROOT.($session->isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$img["pr_img"]?>" class="img-fluid mx-auto" alt=""  onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';"></a></div>
										<?php 
												}
											} else {
										?>
												<div><a href="<?php echo ROOT.($session->isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>"><img src="<?php echo ROOT.PR_UPLOAD_PATH."/1.jpg"; ?>" class="img-fluid mx-auto" alt=""></a></div>
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
											<span class="_list_blickes types"><?php echo $CATARR[$prop['pr_cat']]?></span>
										</div>
										<div class="_card_flex_last">
											<h6 class="listing-card-info-price mb-0">&#8377;<?php echo ($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)? $prop["pr_cost"] : $prop["pr_plot_cost"]; ?></h6>
										</div>
									</div>
									<!--<div class="_card_list_flex">
										<div class="_card_flex_01">
											<h4 class="listing-name verified"><a href="<?php echo ROOT.($session->isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS)."/".$prop['pr_id']?>" class="prt-link-detail"><?php echo isset($LOCATNARR[$prop["pr_location"]])? $LOCATNARR[$prop["pr_location"]] : ''; ?></a></h4>
										</div>
									</div>-->
								</div>
							</div>

							<?php
								if($prop["pr_cat"] != 3 && $prop["pr_cat"]!=5)
								{
							?>
									<div class="price-features-wrapper">
										<div class="list-fx-features">
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bed.svg" alt="" width="13"></div><?php echo $prop["pr_bhk"]?>
											</div>
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/bathtub.svg" alt="" width="13"></div><?php echo $prop["pr_bath"]?> Bath
											</div>
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php //echo $prop["pr_build"]?> <?php echo ($prop["pr_cat"] == 1)? $prop["pr_build"].' sq. ft' : $prop["pr_total_area"].' sq.yd'; ?>
											</div>
										</div>
									</div>
							<?php		
								} else if($prop["pr_cat"] == 3) {
									
							?>
									<div class="price-features-wrapper">
										<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php echo $prop["pr_plot_area"].' sq.yd'; ?>
									</div>
							<?php
								} else if($prop["pr_cat"] == 5) {
							?>
									<div class="price-features-wrapper">
										<div class="inc-fleat-icon"><img src="<?php echo ROOT?>assets/img/move.svg" alt="" width="13"></div><?php echo (($prop["pr_area_in_acre"]>0)? $prop["pr_area_in_acre"] : 0).' Acres '.(($prop["pr_area_in_guntha"]>0)? $prop["pr_area_in_guntha"] : 0).' Gunthas' ; ?>
									</div>
							<?php											
								}
							?>
							<div class="listing-detail-footer">
								<div class="footer-first">
									<div class="foot-location"><img src="<?php echo ROOT?>assets/img/pin.svg" alt="" width="18"><?php echo isset($LOCATNARR[$prop["pr_location"]])? $LOCATNARR[$prop["pr_location"]] : ''?></div>
								</div>
								<div class="footer-flex">
									<ul class="selio_style">
										<li>
										<div class="prt_saveed_12lk">
											<?php $clsdang=(isset($prop['wl_id']))?"text-danger":""?>
											<label class="toggler toggler-danger btnwish <?php echo $clsdang?>" data-id="<?php echo $prop['pr_id']?>" data-wlid="<?php echo isset($prop['wl_id'])? $prop['wl_id'] : ''; ?>" data-toggle="tooltip" data-placement="top" data-original-title="Save property"><input type="checkbox"><i class="ti-heart"></i></label>
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
				<?php }?>					
			</div>	
		</div>
	</section>
	<!-- ============================ Call To Action ================================== -->
	<?php include_once("call-to-action.php"); ?>
	<?php //footer();?>
	<?php include_once("footer.php"); ?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.inputselct').select2();
			$(document).on("change","#txtloc",function(){
				$("#txtLocality").html("<option value=''>All Locality</option>");
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:{"action":"getlocality","locid":$(this).val(),"pcat":$("#ptypes").val()} ,
					success:function(response){

					jsn=$.parseJSON(response);
					opwrp=$("#txtLocality");
					//$("<option value=''>Select</option>").appendTo(opwrp);
					$.each(jsn,function(key,elm){
					//console.log(elm);
					$("<option value='"+elm.lo_name+"'>"+elm.lo_name+"</option>").appendTo(opwrp);

					});

					}
				})
				.done(function() {
					//console.log("success");
				});
			})

		});
	</script>