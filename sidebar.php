<?php
	$isAdmin = $session->isAdmin();
	$isMaster = $session->isMaster();
	$isEmployeeLoggedIn = $session->isEmployeeLoggedIn();
?>
<div class="p-0" style="border-radius: 0.4rem;border: 1px solid #e6eaf1;background: #ffffff;">
	<a class="filter_links" data-toggle="collapse" href="#mobSidebar" role="button" aria-expanded="false" aria-controls="mobSidebar">Sidebar<i class="fa fa-sliders-h ml-2"></i></a>
	<div class="mobile-flag" id="mobSidebar">
		<div class="property_dashboard_navbar">
			<div class="dash_user_avater">
				<?php
					$directory = $session->getUserDirectory();
					$picName = $session->getProfilePic();
					if($picName!='')
					{
						echo '<img src="'.ROOT.UPLOAD_PATH.$directory.'/'.$picName.'" class="img-fluid avater" style="width:100px; height:100px;" alt="">';
					}
					else
					{
						echo '<img src="'.ROOT.'assets/img/user-3.jpg" class="img-fluid avater" style="width:100px; height:100px;" alt="">';
					}
				?>
				<h4><?php echo ($session->getDisplayName()!='')? $session->getDisplayName() : $session->getUserName();?></h4>
				<!--<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Upload Profile Pic</button>-->
<div class="btn-group" role="group" aria-label="Basic example">
<a href="<?php echo ROOT.(($isEmployeeLoggedIn)? EMP_CHANGE_PWD : USER_CHANGE_PWD); ?>" class="btn btn-outline-info btn-xs px-2 py-1" data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
<a href="<?php echo ROOT.(($isEmployeeLoggedIn)? EMP_PROFILE : USER_PROFILE); ?>" class="btn btn-outline-info btn-xs px-2 py-1" data-toggle="tooltip" data-placement="top" title="Profile"><i class="fa fa-user"></i></a>
<a href="javascript:void(0);" class="btn btn-info btn-xs px-2 py-1" data-toggle="modal" data-target="#myModal">Upload Profile Pic</a>
</div>
				<div>India</div>
			</div>
			<div class="dash_user_menues">
				<ul>
					<?php
						$i=0;
						if($isEmployeeLoggedIn)
						{
							$sidebarItems = ($isAdmin)? $ADMIN_SIDEBAR_ITEMS : $EMP_SIDEBAR_ITEMS;
						}
						else
						{
							$sidebarItems = $SIDEBAR_ITEMS;
						}
						foreach($sidebarItems as $recs)
						{
							//foreach($recs as $nav)
							//{
								echo '<li class="'.(($recs['link']==$requestURI)? 'active' : '').'"><a href="'.ROOT.$recs['link'].'" class="'.$recs['class'].'">'.$recs['name'].'</a></li>';
							//}
							$i++;
						}
					
					?>
					<!--<li><a href="<?php echo ROOT."my-profile"?>"><i class="fa fa-user-tie"></i>My Profile</a></li>
					<li><a href="<?php echo ROOT."property"?>"><i class="fa fa-tasks"></i>My Properties</a></li>
					<li class=""><a href="<?php echo ROOT."wishlist"?>"><i class="fa fa-heart"></i>My Wishlist</a></li>
					<li><a href="<?php echo ROOT."submit-property"?>"><i class="fa fa-pen-nib"></i>Submit New Property</a></li>
					<li><a href="<?php echo ROOT."leads"?>"><i class="fa fa-envelope"></i>Leads</a></li>
					<li class="active"><a href="<?php echo ROOT."change-password"?>"><i class="fa fa-unlock-alt"></i>Change Password</a></li>-->
				</ul>
			</div>
			<div class="dash_user_footer">
				<a class="div-ul div-ul py-3 text-white" href="<?php echo ROOT.(($session->isAdmin())? ADMIN_LOGOUT : USER_LOGOUT); ?>">
					<div class="div-li" style="margin: auto;"><i class="fa fa-power-off"></i></div>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data" onsubmit="" name="fileinfo" id="profileform">
				<div class="modal-header">
					<h4 class="modal-title">Profile Pic</h4>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="file" name="profile_pic" id="profile_file" onchange="preview_profile_image();" />
							<br />
							<br />
							<div id="profile_preview">
								<?php
									/* if(count($galleriesArr)>0)
									{
										foreach($galleriesArr as $val)
										{
											echo '<div class="img-preview-div"><div class="rem-img remove-img  remove-img-action" data-id="'.$val["pg_id"].'" data-pid="'.$val["pr_id"].'"><i class="fa fa-times"></i></div><a href="'.ROOT.'images/'.$val["pr_img"].'"><img src="'.ROOT.'images/'.$val["pr_img"].'" class="img-fluid img-thumbnail mx-auto" alt="" style="min-height:190px;" ></a></div>';
										}		
									} */
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="notify-profile" style="font-style:italic;font-size:12px;font-weight:bold;"></div>
				<div class="modal-footer">
					<button type="button" id="upload_profile" class="btn btn-success btn-sm">Upload</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function preview_profile_image() 
	{
		$('#profile_preview').html("");
		var total_file=document.getElementById("profile_file").files.length;
		$('#profile_preview').append("<img src='"+URL.createObjectURL(event.target.files[0])+"' class='img-thumbnail' width='75%'>&nbsp;");
	}
	
	$(document).ready(function(){
		//var form = document.forms.namedItem("fileinfo");
		
		$(document).on('click', '#upload_profile', function(event) 
		{
			event.preventDefault();
			
			var rootUrl = "<?php echo ROOT; ?>";
			var formData = new FormData();   
			var file = profile_file.files[0];			
			formData.append("file", file);
			formData.append('action', 'insertProfileImg');
	
			// Open
			//console.log(file.name)
			var xhr = new XMLHttpRequest();
			xhr.open('POST', rootUrl+'ajax/prop-ajax.php', true);
			
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					//$("#img-dummy").remove();
					var resp = JSON.parse(xhr.response);
					if(resp.status=="error")
					{
					//console.log(resp)
						$(".notify-profile").addClass(resp.type).html(resp.message).fadeOut(10000);
					}
					else
					{
						location.reload();
					}
					//location.reload();
					/* display.append('<div class="img-preview-div"><div class="rem-img remove-img  remove-img-action" data-id="'+resp.id+'" data-pid="'+propertyId+'"><i class="fa fa-times"></i></div><a href="'+rootUrl+'images/'+resp.file_name+'"><img src="'+rootUrl+'images/'+resp.file_name+'" class="img-fluid img-thumbnail mx-auto" alt="" style="min-height:190px;" ></a></div>');
					/* image_preview.append('<div class="img-preview-div"><a href="'+rootUrl+'images/'+resp.file_name+'"><img src="'+rootUrl+'images/'+resp.file_name+'" class="img-fluid mx-auto" alt="" style="min-height:190px;" ></a></div>'); *
					image_preview.append('<div id="img-dummy"><a href="'+rootUrl+'images/'+resp.file_name+'"><img src="'+rootUrl+'images/'+resp.file_name+'" class="img-fluid mx-auto" alt=""></a></div>');
					
					if(resp.message=="Invalid User.")
					{
						window.location.href=rootUrl;
					} */
					
					//$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
				}
			}
  
			/* xhr.setRequestHeader("Cache-Control", "no-cache");
			xhr.setRequestHeader("Content-Type", "multipart/form-data");
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); */
		/* xhr.open('POST', this.options.action);

		// Set headers
		xhr.setRequestHeader("Cache-Control", "no-cache");
		xhr.setRequestHeader("X-File-Name", file.fileName);
		xhr.setRequestHeader("X-File-Size", file.fileSize);
		xhr.setRequestHeader("X-File-Type", file.type); */
		

		// Send
		xhr.send(formData);
					
		});
		
		
	});
</script>