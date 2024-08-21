<div class="dashboard-body">
	<div class="dashboard-wraper">
		<!-- Bookmark Property -->
		<div class="frm_submit_block"><h4>Bookmark Property</h4></div>
		<table class="property-table-wrap responsive-table bkmark">
			<tbody>
				<tr>
					<th><i class="fa fa-file-text"></i> Property</th>
					<th>Property Id</th>
					<th></th>
				</tr>
				<?php 
					//ini_set("display_errors",1);
					/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
					$prpobj->orderBy('pr.pr_id',"DESC");
					$prpobj->groupBy("pr.pr_id");
					$prpobj->where("pr.pr_status",1);
					$prpobj->join("property_gallery pg","pg.pr_id=pr.pr_id","INNER");
					$prpobj->join("wishlist wl","pr.pr_id=wl.pr_id AND wl.u_id=$_SESSION[UID]","INNER");
					$proarr=$prpobj->get("property pr",NULL,"pr.pr_id,pr.u_id,pr.pr_title,pr.pr_decri,pr.pr_type,pr.pr_cat,pr.pr_age,pr.pr_bhk,pr.pr_room,pr.pr_bath,pr.pr_balcony,pr.pr_parking,pr.pr_opnpark,pr.pr_location,pr.pr_locality,pr.pr_cost,pr.pr_maintarea,pr.pr_furnish,pr.pr_build,pr.pr_buildproj,pr.pr_carpt,pr.pr_offer,pr.pr_constru,pr.pr_flatno,pr.pr_floor,pr.pr_addr,pr.pr_city,pr.pr_dist,pr.pr_state,pr.pr_ttlfllor,pr.pr_contactname,pr.pr_amnenitis,pr.pr_soamnenitis,pr.pr_posdt,pr.pr_agepro,pr.pr_mobile,pr.pr_email,pr.pr_link,pr.pr_posts,pr.pr_lenth,pr.pr_width,pr.pr_status,pr.pr_plot_cost,pr.pr_reg_code,wl.wl_id,pr_img"); */
					//echo $prpobj->getLastQuery();
					
					$userId = $session->getUserId();
					$getQuery = "SELECT `pr`.*, `wl`.`wl_id`, `pg`.`pr_img` FROM `".TBL_PROPERTY."` `pr` INNER JOIN `".TBL_WISHLIST."` `wl` ON `pr`.`pr_id`=`wl`.`pr_id` AND `wl`.`u_id`='".$userId."'  INNER JOIN `".TBL_GALLERY."` `pg` ON `pg`.`pr_id`=`pr`.`pr_id` AND `wl`.`u_id`='".$userId."' WHERE `pr_is_publish`=1 AND `pr`.`pr_status`=1 GROUP BY `pr`.`pr_id` ORDER BY `pr`.`pr_id` DESC";
					
					$proarr = $db->getRecordsArray($getQuery);
					
					foreach ($proarr as $key => $prop) {
				?>
					<!-- Item #1 -->
					<tr>
						<td class="dashboard_propert_wrapper">
							<img src="<?php echo ROOT.PR_UPLOAD_PATH."/".$prop["pr_img"]?>" alt="" onerror="this.src='<?php echo ROOT.PR_UPLOAD_PATH; ?>/1.jpg';">
							<div class="title">
								<h4><a href="<?php echo ROOT.(isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>">
								<?php echo $CATARR[$prop["pr_cat"]]?></a></h4>
								<span><?php echo $LOCATNARR[$prop["pr_location"]]?></span>
								<span class="table-property-price">₹ <?php echo (isset($prop['pr_cat']) && ($prop['pr_cat']==3 || $prop['pr_cat']==5))? (isset($prop['pr_plot_cost'])? $prop['pr_plot_cost'] : '') : (isset($prop['pr_cost'])? $prop['pr_cost'] : ''); ?></span>
							</div>
						</td>
						<td>
							<a href="<?php echo ROOT.(isAdmin()? ADMIN_PR_DETAILS : USER_PR_DETAILS).$prop['pr_id']."/"; ?>" ><?php echo $prop["pr_reg_code"]; ?></a>
						</td>
						<td class="action">
							<a href="#" class="delete btndelete" data-wlid="<?php echo $prop["wl_id"]?>"><i class="ti-close"></i> Delete</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<!-- row -->
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on("click",".btndelete",function(e){
			e.preventDefault();
			btndel= $(this);
			$.ajax({
				url: '<?php echo ROOT?>ajax/prop-ajax.php',
				type: 'POST',
				data:{"action":"delwishlist","wlid":$(this).data("wlid")} ,
				success:function(response){
					//console.log(response);	
					jsn=$.parseJSON(response);
					if(jsn.sts=="01"){
						btndel.closest("tr").remove();
					}
				}
			})
			.done(function() {
				console.log("success");
			});

		});
	});
</script>