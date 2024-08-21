<?php

//head();
	/* $prpobj=new Mysqlidb(HOST,USER,PWD,DB);
	$locarr=$prpobj->get("locations",null,"*");
	$locltyarr=$prpobj->get("locality",null,"*");
	foreach($locarr AS $loc){
		$LOCATNARR[$loc['loc_id']]=$loc['loc_name'];   
	} */
	
	$isEmployeeLoggedIn = $session->isEmployeeLoggedin();
	$employeeView = $session->getLoadView();
	
	$locarr = $db->getRecordsArray("SELECT * FROM `".TBL_LOCATIONS."`");
	$locltyarr = $db->getRecordsArray("SELECT * FROM `".TBL_LOCALITY."`");
	foreach($locarr AS $loc){
		$LOCATNARR[$loc['loc_id']]=$loc['loc_name'];   
	}
	
	$sLocations = $db->getRecordsArray("SELECT `pr_location` FROM `".TBL_PROPERTY."` WHERE `pr_is_publish`=1 AND `pr_status`=1 GROUP BY `pr_location`");
	$locationArr = $locationMap = array();
	foreach($locarr AS $loc)
	{
		$locationMap[$loc['loc_id']] = isset($locationMap[$loc['loc_id']])? $locationMap[$loc['loc_id']] : array();
		$locationMap[$loc['loc_id']] = $loc;
	}
	
	foreach($sLocations as $key => $val)
	{
		$locationArr[] = array('loc_id' => $val['pr_location'], 'loc_name' => (isset($locationMap[$val['pr_location']]['loc_name'])? $locationMap[$val['pr_location']]['loc_name'] : ''));
	}
	
	/* print_r($locationArr);
	die(); */
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="author" content="Themezhub" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Gharapnaa</title>
      <!-- Custom CSS -->
      <link href="<?php echo ROOT?>assets/css/styles.css?ver=1.4" rel="stylesheet">
      <!-- ============================================================== -->
      <!-- All Jquery -->
      <!-- ============================================================== -->
      <script src="<?php echo ROOT?>assets/js/jquery.min.js"></script>
      <script src="<?php echo ROOT?>assets/js/popper.min.js"></script>
      <script src="<?php echo ROOT?>assets/js/bootstrap.min.js"></script>
      <script src="<?php echo ROOT?>assets/js/ion.rangeSlider.min.js"></script>
      <!-- <script src="<?php echo ROOT?>assets/js/select2.min.js"></script>
         --><script src="<?php echo ROOT?>assets/js/jquery.magnific-popup.min.js"></script>
      <script src="<?php echo ROOT?>assets/js/slick.js"></script>
      <script src="<?php echo ROOT?>assets/js/slider-bg.js"></script>
      <script src="<?php echo ROOT?>assets/js/lightbox.js"></script> 
      <script src="<?php echo ROOT?>assets/js/imagesloaded.js"></script>
      <script src="<?php echo ROOT?>assets/js/daterangepicker.js"></script>
      <script src="<?php echo ROOT?>assets/js/custom.js"></script>
      <!-- ============================================================== -->
      <!-- This page plugins -->
      <!-- ============================================================== -->		
      <script type="text/javascript">
         jQuery(document).ready(function($) {
         
			$(document).on('click', '#btnregister', function(event) 
			{
				event.preventDefault();
				$(".has-error").removeClass("has-error");
				valid=true;
				frmdata=$("#frmregister").serialize();
				$(".requiredre").each(function(index, el) 
				{
					if(!$(el).val()){
						valid=false;
						$(this).addClass('has-error');
					}  
				});
				
				if(valid && matchPassword('reg')){
					$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					$.ajax({
						url: '<?php echo ROOT?>ajax/prop-ajax.php',
						type: 'POST',
						data:frmdata ,
						success:function(response){
							//console.log(response);	

							
							jsn=$.parseJSON(response);
							if(jsn.status=='success')
							{
								$("#frmregister")[0].reset();
								location.reload();
							}
							$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
												
							/* if(jsn.sts=="01"){
							location.reload();

							}
							else if(jsn.sts=="02"){

								$(".noty").html("Email/Mobile Already Registered");
							}
							else{
								$(".noty").html("Check Credentials");
							} */
						}
					})
					.done(function() {
						//console.log("success");
						//setTimeout(function(){$(".noty").html(""); }, 3000);

					});
				}		
			});
			
			/* ====== OTP Send to Client ======== */
			function commonOTPSend(email='', phone=0, id='', isValid=1)
			{
				if(id!='' && (email!='' || phone>0))
				{
					$("#"+id).addClass('disabled');
					var isValid = (isValid==1 || isValid=='1')? 'register' : 'login';
					$(".notify-otp").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					$.ajax({
						url: '<?php echo ROOT?>ajax/prop-ajax.php',
						type: 'POST',
						data: 'action=sendotp&email='+email+'&phone='+phone+'&valid='+isValid,
						success:function(response){
							//console.log(response);	
							jsn=$.parseJSON(response);
							if(jsn.status=='success')
							{
								//$("#frmregister")[0].reset();
								//location.reload();
								$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
							if(jsn.status=='error')
							{
								$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
							setTimeout(function(){
								$('#'+id).removeClass('disabled');
							},60000);
						}
					})
					.done(function() {
						//console.log("success");
						//setTimeout(function(){$(".noty").html(""); }, 3000);

					});
				}
			}
			
			/* ========== Register OTP to mail ===== */
			$(document).on('click', '#regMailOTP', function(event){
				event.preventDefault();
				var email = $("#emailid").val();
				phone=0;
				commonOTPSend(email, phone, "emailid", 1);
			});
			/* ========== Register OTP to mail ===== */
			
			
			/* ========== OTP to mail ===== */
			$(document).on('click', '#mailOTP', function(event){
				event.preventDefault();
				var email = $("#forgot_email").val();
				phone=0;
				commonOTPSend(email, phone, "forgot_email", 0);
				/* if(email!='')
				{
					$("#mailOTP").addClass('disabled');
					$(".notify-otp").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					$.ajax({
						url: '<?php echo ROOT?>ajax/prop-ajax.php',
						type: 'POST',
						data: 'action=sendotp&email='+email+'&phone='+phone,
						success:function(response){
							//console.log(response);	
							jsn=$.parseJSON(response);
							if(jsn.status=='success')
							{
								//$("#frmregister")[0].reset();
								//location.reload();
								$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
							if(jsn.status=='error')
							{
								$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
							setTimeout(function(){
								$('#mailOTP').removeClass('disabled');
							},60000);
						}
					})
					.done(function() {
						//console.log("success");
						//setTimeout(function(){$(".noty").html(""); }, 3000);

					});
				} */
			});
			/* ====== OTP Send to Client ======== */
			
			
			/* ====== OTP Verify to Client ======== */
			function commonOTPVerify(otp='',btnId='', hideTab='')
			{
				if(btnId!='' && otp!='')
				{
					$(".notify-verifyotp").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					$.ajax({
						url: '<?php echo ROOT?>ajax/prop-ajax.php',
						type: 'POST',
						data: 'action=verifyotp&otp='+otp,
						success:function(response){
							//console.log(response);	
							jsn=$.parseJSON(response);
							if(jsn.status=='success')
							{
								if(btnId=='btnreset')
								{
									var codeHtml = '<div class="form-group">'+
										'<label>Password</label><span class="text-danger"> * <span id="err_pwd1" class="err-msg"></span></span>'+
										'<div class="input-with-icon">'+
											'<input type="password" class="form-control requiredpwd mand-err" name="pwd" id="pwd1" onblur="matchPassword(\'reset\');" style="padding-left: 26px !important;">'+
											'<i class="ti-unlock"></i>'+
										'</div>'+
									'</div>'+
									'<div class="form-group">'+
										'<label>Confirm Password</label><span class="text-danger"> * <span id="err_cpwd1" class="err-msg"></span></span>'+
										'<div class="input-with-icon">'+
											'<input type="password" class="form-control requiredpwd mand-err" name="cpwd" id="cpwd1" onblur="matchPassword(\'reset\');" style="padding-left: 26px !important;">'+
											'<i class="ti-unlock"></i>'+
										'</div>'+
									'</div>';
									$("#enable-pwd").html(codeHtml);
								}
								
								if(hideTab=='enableReg')
								{
									$("#hideReg").hide();
									$("#enableReg").show();
								}
								$(".notify-verifyotp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
								$("#"+btnId).removeClass("disabled");
							}
							if(jsn.status=='error')
							{
								$("#"+btnId).addClass("disabled");
								$(".notify-verifyotp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
						}
					})
					.done(function() {
						//console.log("success");
						//setTimeout(function(){$(".noty").html(""); }, 3000);

					});
				}
			}
			
			$(document).on('click', '#regVerifyOTP', function(event){
				event.preventDefault();
				var otp = $("#reg_verify_otp").val();
				commonOTPVerify(otp, "btnregister", "enableReg");
				//commonOTPVerify(otp, "btnreset");
			});
			
			$(document).on('click', '#verifyOTP', function(event){
				event.preventDefault();
				var otp = $("#verify_otp").val();
				commonOTPVerify(otp, "btnreset");
				/* if(otp!='')
				{
					$(".notify-verifyotp").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					$.ajax({
						url: '<?php echo ROOT?>ajax/prop-ajax.php',
						type: 'POST',
						data: 'action=verifyotp&otp='+otp,
						success:function(response){
							//console.log(response);	
							jsn=$.parseJSON(response);
							if(jsn.status=='success')
							{
								var codeHtml = '<div class="form-group">'+
										'<label>Password</label><span class="text-danger"> * <span id="err_pwd1" class="err-msg"></span></span>'+
										'<div class="input-with-icon">'+
											'<input type="password" class="form-control requiredpwd mand-err" name="pwd" id="pwd1" onblur="matchPassword(\'reset\');" style="padding-left: 26px !important;">'+
											'<i class="ti-unlock"></i>'+
										'</div>'+
									'</div>'+
									'<div class="form-group">'+
										'<label>Confirm Password</label><span class="text-danger"> * <span id="err_cpwd1" class="err-msg"></span></span>'+
										'<div class="input-with-icon">'+
											'<input type="password" class="form-control requiredpwd mand-err" name="cpwd" id="cpwd1" onblur="matchPassword(\'reset\');" style="padding-left: 26px !important;">'+
											'<i class="ti-unlock"></i>'+
										'</div>'+
									'</div>';
								$("#enable-pwd").html(codeHtml);
								$(".notify-verifyotp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
								$("#btnreset").removeClass("disabled");
							}
							if(jsn.status=='error')
							{
								$("#btnreset").addClass("disabled");
								$(".notify-verifyotp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							}
						}
					})
					.done(function() {
						//console.log("success");
						//setTimeout(function(){$(".noty").html(""); }, 3000);

					});
				} */
			});
			/* ========== OTP to mail ===== */
			
			/* ====== OTP Verify to Client ======== */
			/* ========= Reset Password ============ */
			$(document).on("click","#btnreset",function(event)
			{
				event.preventDefault();
				pvalid=true;
				$(".has-error").removeClass("has-error");
				$(".txt-error").removeClass("txt-error");
				
				$(".requiredpwd").each(function(index, el){
					if(!$(el).val())
					{
						pvalid=false;
						$(this).addClass("has-error");
					}
				});
			
				if(pvalid && matchPassword('reset')){
					$(".notify-reset").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
					frmdata=$("#frmreset").serialize();
					
					$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data: frmdata ,
					success:function(response){
						//console.log(response);	
						
						jsn=$.parseJSON(response);
						if(jsn.status=='success')
						{
							$(".notify-reset").addClass(jsn.type).html(jsn.message).fadeOut(10000);
							location.reload();
						}
						if(jsn.status=='error')
						{
							$(".notify-reset").addClass(jsn.type).html(jsn.message).fadeOut(10000);
						}
							
						/* jsn=$.parseJSON(response);
						if(jsn.sts=="01"){
						$(".notyre").html("Successfully Reset Password");
						$("#pills-reset,#pills-signup").addClass("fade"); 
						$("#pills-reset,#pills-signup").removeClass("active show"); 
						$("#pills-login").addClass("active show"); 
						}
						else{$(".notyre").html("User Name not exist")} */
					}
					})
					.done(function() {
					//console.log("success");
					//setTimeout(function(){$(".notyre").html(""); }, 3000);

					}); 
				}
			});	   
		 /* ========= Reset Password ============ */
         
         $(document).on('click', '#btnlogin', function(event) 
		 {
			event.preventDefault();
			lvalid=true;
			$(".has-error").removeClass("has-error");
			$(".lrequired").each(function(index, el) {
				if(!$(el).val()){
					lvalid=false;
					$(this).addClass('has-error');
				}  
			});	
			//alert(lvalid)
			if(lvalid)
			{
				frmdata=$("#frmlogin").serialize();
				$.ajax({
					url: '<?php echo ROOT?>ajax/prop-ajax.php',
					type: 'POST',
					data:frmdata ,
					success:function(response){
						//console.log(response);	

						jsn=$.parseJSON(response);
						if(jsn.sts=="01"){
						location.reload();

						}
						else{
						$(".noty").html("Check Credentials");
						}
					}
				})
				.done(function() {
					console.log("success");
					setTimeout(function(){$(".noty").html(""); }, 3000);
				});
			}
         		
         	});
         	    
         	    
         	   $(document).on('click', '.btnwish', function(event) {
         	   	event.preventDefault();
         	   	btn=$(this);
         	   	 prid=$(this).data("id");
                 wlid=$(this).data("wlid");
                 uid="<?php echo (isset($_SESSION['UID'])? $_SESSION['UID'] : ''); ?>";
                 if(!uid){
         	$("#login").modal();
         }else{
           $.ajax({
         url: '<?php echo ROOT?>ajax/prop-ajax.php',
         type: 'POST',
         data:{"action":"addwishlist","prid":prid,"wlid":wlid} ,
         success:function(response){
         	console.log(response);	
         
         	jsn=$.parseJSON(response);
         	if(jsn.sts=="01"){
          btn.toggleClass("text-danger");
         	}
         
         }
         })
         .done(function() {
         console.log("success");
         setTimeout(function(){$(".noty").html(""); }, 3000);
         
         });  
         }	
         	   });
         	   
         	   
         $(document).on("click","#pills-reset-tab",function(){
          $("#pills-login,#pills-signup").addClass("fade");  
         });
         $(document).on("click","#pills-login-tab",function(){
          $("#pills-reset,#pills-signup").addClass("fade"); 
           $("#pills-reset,#pills-signup").removeClass("active show"); 
         });	
         $(document).on("click","#pills-signup-tab",function(){
          $("#pills-reset,#pills-login").addClass("fade");  
           $("#pills-reset,#pills-login").removeClass("active show");
         });	
         });
      </script>
   </head>
   <body class="yellow-skin">
      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->
      <div class="preloader"></div>
      <!-- ============================================================== -->
      <!-- Main wrapper - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <div id="main-wrapper">
         <!-- ============================================================== -->
         <!-- Top header  -->
         <!-- ============================================================== -->
         <!-- Start Navigation -->
         <div class="header header-light">
            <div class="container">
               <nav id="navigation" class="navigation navigation-landscape">
                  <div class="nav-header">
                     <a class="nav-brand" href="<?php echo(($session->isAdmin())? $adminUrl : $siteUrl ); ?>">
						<img src="<?php echo ROOT?>assets/img/logo.png" class="logo" alt="" />
                     </a>
                     <div class="nav-toggle"></div>
                     <div class="mobile_nav">
                        <ul>
                           
							<?php
								if(!$session->getIsLoggedIn())
								{
									echo '<li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-user-circle fa-lg"></i></a></li>';
								}
								else
								{
									echo '<li class="c-list"><a href="'.ROOT.(($session->isAdmin())? ADMIN_PROFILE : USER_PROFILE ).'"><i class="fas fa-user "></i> Hi, '.$session->getUserName().'</a></li>';
								}
						   ?>
                        </ul>
                     </div>
                  </div>
                  <div class="nav-menus-wrapper " style="transition-property: none;">
                     <ul class="nav-menu  align-to-right">
						<?php
							$i=0;
							if($isEmployeeLoggedIn)
							{
								$navItems = $ADMIN_NAV_ITEMS;
								$navItems[0]['link'] = $employeeView;
							}
							else
							{
								$navItems = $NAV_ITEMS;
							}
							foreach($navItems as $recs)
							{
								//foreach($recs as $nav)
								//{
									echo '<li class="'.(($recs['link']==$requestURI)? 'active' : '').' c-list"><a href="'.ROOT.$recs['link'].'" class="'.$recs['class'].'">'.$recs['name'].'</a></li>';
								//}
								$i++;
							}
							echo '<li class="c-list"><a href="tel:916281354044"><i class="fas fa-phone mr-1"></i>+91 6281354044</a></li>';
							if(!$session->getIsLoggedIn())
							{
								echo '<li class="c-list"><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt mr-1"></i>Sign In</a></li>';
							}
							else
							{
								echo '<li class="c-list"><a href="'.ROOT.(($session->isAdmin())? ADMIN_PROFILE : USER_PROFILE ).'"><i class="fas fa-user "></i> Hi, '.$session->getUserName().'</a></li>';
							}
						?>
                        <!--<li class="active"><a href="<?php echo ROOT?>">Home</a>
                        </li>
                        <li><a href="<?php echo ROOT?>property-list">Buy</a></li>
                        <li><a href="<?php echo ROOT?>add-property">Sell</a></li>
                        <li><a href="<?php echo ROOT?>contact">Contact Us</a>
                        </li>
                        <li class="add-listing" >
                           <a href="<?php echo ROOT?>add-property" style="border-radius: 5px;
                              top: 16px;
                              padding: 12px;
                              margin-left: 10px;
                              background: #56afff;
                              color: white !important;"  class="theme-cl">
                           <i class="fas fa-plus-circle mr-1"></i>Add Free listing
                           </a>
                        </li>
                        <?php if(!isset($_SESSION['UID'])){?>
                        <li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt mr-1"></i>Sign In</a></li>
                        <?php }else{?>
                        <li><a href="<?php echo ROOT?>my-profile"><i class="fas fa-user "></i> Hi <?php echo (isset($_SESSION['UNAME'])? $_SESSION['UNAME'] : ''); ?></a></li>
                        <!-- <li><a href="<?php echo ROOT?>logout">Logout</a></li>
                           --<?php }?> -->
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <!-- End Navigation -->
         <div class="clearfix"></div>
         <!-- ============================================================== -->
         <!-- Top header  -->
         <!-- ============================================================== -->
			<?php
				$alertMsgArr = $session->getSessionAlertMsg();
				if(isset($alertMsgArr) && count($alertMsgArr)>0)
				{
					
					echo '<div class="alert alert-'.$alertMsgArr['type'].' alert-dismissible fade show" role="alert">';
						echo $alertMsgArr['message'];
						echo '<button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">';
							echo '<span aria-hidden="true">&times;</span>';
						echo '</button>';
					echo '</div>';
					$session->clearSessionAlertMsg();
				}
			
			?>
         