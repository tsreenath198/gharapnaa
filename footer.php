<?php 
	if(!$session->isAdmin())
	{
?>
         <!-- ============================ Call To Action End ================================== -->
         <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-4 col-md-4">
                        <div class="footer_widget">
                           <img src="<?php echo ROOT?>assets/img/logo-light.png" class="img-footer small mb-2" alt="">
                           <p class=" mt-3">Query for Residential properties for lease, purchase, sell in India 100 percent Genuine Owners. India's first Real Estate Property Website. Get Rent Agreement, Property Management and Registration Service in India. Proprietors and NRI can List/Post Property Ad for Free.</p>
                           <div class="foot-news-last">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-8 col-md-8 ml-auto">
                        <div class="row">
                           <div class="col-lg-4 col-md-4">
                              <div class="footer_widget">
                                 <h4 class="widget_title">Important Links</h4>
                                 <ul class="footer-menu">
                                    <!--<li><a href="<?php echo ROOT?>">Home Page</a></li>-->
                                    <li><a href="<?php echo ROOT."about-us/"?>">About</a></li>
                                    <li><a href="<?php echo ROOT."contact/"?>">Contact</a></li>
                                    <li><a href="<?php echo ROOT."property-list/"?>">Buy</a></li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-lg-8 col-md-8">
                              <div class="footer_widget">
                                <h4 class="widget_title">Contact Us</h4>
								<div>
									RAJAVATAR CONSTRUCTIONS,<br />
									ATS Marvel complex, <br />
									H.No: 3-10-459, 2nd FLOOR, Opp: Hanuman Temple, <br />
									Chandra Nagar main road, Nizamabad, Telangana-503001. <br />
									Contact : 7013107291 & 9003227387
								</div>
                                 <!--<ul class="footer-menu">
                                    <li><a href="mailto:<?php echo COMPANY_MAIL; ?>"><?php echo COMPANY_MAIL; ?></a></li>
                                    <li><a href="tel:<?php echo COMPANY_PHONE;?>"><?php echo COMPANY_PHONE;?> </a></li>
                                 </ul>-->
                              </div>
                           </div>
                           <!--<div class="col-lg-4 col-md-4">
                              <div class="footer_widget">
                                 <h4 class="widget_title">All Sections</h4>
                                 <ul class="footer-menu">
                                    <li><a href="#">Sell</a></li>
                                    <li><a href="#">Independent Home</a></li>
                                    <li><a href="#">Plot</a></li>
                                 </ul>
                              </div>
                           </div>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-bottom">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-lg-12 col-md-12 text-center">
                        <p class="mb-0">© 2021 Gharapnaa. Designd By <a target="_blank" href="http://redesigns.in/">redesigns.in</a>.</p>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- ============================ Footer End ================================== -->
         <!-- Log In Modal -->
         <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
            <div class="modal-dialog modal-xl login-pop-form" role="document">
               <div class="modal-content overli" id="registermodal">
                  <div class="modal-body p-0">
                     <div class="resp_log_wrap">
                        <div class="resp_log_thumb" style="background:url(<?php echo ROOT?>assets/img/log.jpg)no-repeat;"></div>
                        <div class="resp_log_caption form_err_text">
                           <div class="edlio_152">	
								<div class="log-close" onclick="goToLog();"><i class="fa fa-times"></i></div>
                              <ul class="nav nav-pills tabs_system center" id="pills-tab" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="false"><i class="fas fa-user-plus mr-2"></i>Register</a>
                                 </li>
                              </ul>
                           </div>
                           <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                 <div class="login-form">
                                    <form class="frmlogin" id="frmlogin">
                                       <input type="hidden" name="action" value="loginuser">
                                       <div class="form-group">
                                          <label>User Name</label>
                                          <div class="input-with-icon">
                                             <input type="text" class="form-control lrequired" name="uname" style="padding-left: 26px !important;">
                                             <i class="ti-user"></i>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label>Password</label>
                                          <div class="input-with-icon">
                                             <input type="password" class="form-control lrequired" name="pwd" style="padding-left: 26px !important;">
                                             <i class="ti-unlock"></i>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="eltio_ol9">
                                             <div class="eltio_k2">
                                                <a id="pills-reset-tab" data-toggle="pill" href="#pills-reset" role="tab" aria-controls="pills-reset" aria-selected="false">Lost Your Password?</a>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <button type="button" class="btn btn-md full-width pop-login" id="btnlogin">Login</button>
                                       </div>
                                       <div class="noty text-danger"></div>
                                    </form>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                                 <div class="login-form">
                                    <form class="frmregister" id="frmregister">
                                       <input type="hidden" name="action" value="registeruser">
									   <div id="hideReg">
										   <div class="form-group">
											  <label>Full Name</label><span class="text-danger"> * <span id="err_uname" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="text" class="form-control requiredre mand-err" name="uname" style="padding-left: 26px !important;" id="uname" onkeyup="checkValidate('uname', /^[A-Za-z ]+$/, '(Enter characters only.)');">
												 <i class="ti-user"></i>
											  </div>
										   </div>
										   <!--<div class="form-group">
											  <label>Email ID</label><span class="text-danger"> * <span id="err_emailid" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="email" class="form-control requiredre mand-err" name="emailid" style="padding-left: 26px !important;" id="emailid" onblur="setUserId('emailid', 'user_id');" onkeyup="checkValidate('emailid', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.']);">
												 <i class="ti-user"></i>
											  </div>
										   </div>-->
										   
										   <div class="form-group">
											  <label>Email ID</label><span class="text-danger"> * <span id="err_emailid" class="notify-otp err-msg"></span></span>
												<div class="input-group mb-3">
													<input type="text" class="form-control requiredre mand-err" name="emailid" id="emailid" placeholder="Email Id" aria-label="Recipient's username" aria-describedby="basic-addon2">
													<!-- <div class="input-group-append">
													<button class="btn btn-danger p-5px" type="button" id="regMailOTP" onclick="checkValidate('emailid', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])" >Send OTP</button>
													</div> -->
												</div>
										   </div>
										   <div class="form-group">
											  <label>Mobile</label><span class="text-danger"> * <span id="err_mobile" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="text" class="form-control requiredre mand-err" name="mobile" style="padding-left: 26px !important;" id="mobile">
												 <i class="ti-user"></i>
											  </div>
										   </div>
										   <!-- <div class="form-group">
												<label>OTP</label><span class="text-danger"> * <span class="notify-verifyotp"></span></span>
												<div class="input-group mb-3">
													<input type="text" class="form-control requiredre" name="reg_verify_otp" id="reg_verify_otp" placeholder="OTP" aria-label="otp" aria-describedby="otp" maxlength="6" />
													<div class="input-group-append">
													<button class="btn btn-danger p-5px" type="button" id="regVerifyOTP" onclick="checkValidate('reg_verify_otp', /^[0-9]{0,6}$/, '', ['', 'Digits Only.'])" >Verify</button>
													</div>
												</div>
										   </div> -->
										</div>
									   <div id="enableReg" class="hide">
										   <div class="form-group">
											  <label>User Id</label><span class="text-danger"> * <span id="err_mobile" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="text" class="form-control requiredre mand-err" name="user_id" style="padding-left: 26px !important;" id="user_id" onkeyup="checkValidate('user_id', '', '(Enter user id.)');" />
												 <i class="ti-user"></i>
											  </div>
										   </div>
										   <div class="form-group">
											  <label>Password</label><span class="text-danger"> * <span id="err_pwd" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="password" class="form-control requiredre mand-err" name="pwd" id="pwd" onblur="matchPassword('reg');" style="padding-left: 26px !important;">
												 <i class="ti-unlock"></i>
											  </div>
										   </div>
										   <div class="form-group">
											  <label>Confirm Password</label><span class="text-danger"> * <span id="err_cpwd" class="err-msg"></span></span>
											  <div class="input-with-icon">
												 <input type="password" class="form-control requiredre mand-err" name="cpwd" id="cpwd" onblur="matchPassword('reg');" style="padding-left: 26px !important;">
												 <i class="ti-unlock"></i>
											  </div>
										   </div>
										   <div class="form-group">
											  <div class="eltio_ol9">
												 <div class="eltio_k1">
													<!-- <input id="dds" class="checkbox-custom" name="dds" type="checkbox">
													   <label for="dds" class="checkbox-custom-label">By using the website, you accept the terms and conditions</label> -->
												 </div>
											  </div>
										   </div>
										</div>
									   <div class="form-group">
										  <button type="button" class="btn btn-md full-width pop-login disabled" id="btnregister">Register</button>
									   </div>
                                       <!--<div class="noty text-danger"></div>-->
									   <div class="notify"></div>
                                    </form>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="pills-reset" role="tabpanel" aria-labelledby="pills-reset-tab">
                                 <div class="login-form">
                                    <form class="frmreset" id="frmreset">
                                       <input type="hidden" name="action" value="resetpwd">
                                       <div class="form-group">
                                          <label>Email ID</label><span class="text-danger"> * <span class="notify-otp"></span></span>
											<div class="input-group mb-3">
												<input type="text" class="form-control requiredpwd" name="txtuser" id="forgot_email" placeholder="Email Id" aria-label="Recipient's username" aria-describedby="basic-addon2">
												<div class="input-group-append">
												<button class="btn btn-danger p-5px" type="button" id="mailOTP" onclick="checkValidate('forgot_email', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])" >Send OTP</button>
												</div>
											</div>
                                       </div>
									   <div class="form-group">
											<label>OTP</label><span class="text-danger"> * <span class="notify-verifyotp"></span></span>
											<div class="input-group mb-3">
												<input type="text" class="form-control requiredpwd" name="verify_otp" id="verify_otp" placeholder="OTP" aria-label="otp" aria-describedby="otp" maxlength="6" />
												<div class="input-group-append">
												<button class="btn btn-danger p-5px" type="button" id="verifyOTP" onclick="checkValidate('verify_otp', /^[0-9]{0,6}$/, '', ['Please Enter Phone', 'Digits Only.'])" >Verify</button>
												</div>
											</div>
                                       </div>
									   <div id="enable-pwd"></div>
                                   
                                       <div class="form-group">
                                          <button type="button" class="btn btn-md full-width pop-login disabled" id="btnreset">Reset</button>
                                       </div>
                                       <div class="notify"></div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- End Modal -->
         <!-- Send Message -->
         <div class="modal fade" id="autho-message" tabindex="-1" role="dialog" aria-labelledby="authomessage" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
               <div class="modal-content" id="authomessage">
                  <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                  <div class="modal-body">
                     <h4 class="modal-header-title">Drop Message</h4>
                     <div class="login-form">
                        <form>
                           <div class="form-group">
                              <label>Subject</label>
                              <div class="input-with-icons">
                                 <input type="text" class="form-control" placeholder="Message Title">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Messages</label>
                              <div class="input-with-icons">
                                 <textarea class="form-control ht-80"></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <button type="submit" class="btn btn-md full-width pop-login">Send Message</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- End Modal -->
         <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
      </div>
<?php } ?>
      <!-- ============================================================== -->
      <!-- End Wrapper -->
      <!-- ============================================================== -->
      <script>
		function getDateFormat (date, format)
		{
			var gDate = new Date(date);
			var returnDate = '';
			var mDate		= {
				'S': gDate.getSeconds(),
				'M': gDate.getMinutes(),
				'H': gDate.getHours(),
				'd': gDate.getDate(),
				'm': gDate.getMonth() + 1,
				'y': gDate.getFullYear(),
			}
			switch(format)
			{
				case 'dd-MM-yyyy' :
					returnDate = mDate.d+'-'+mDate.m+'-'+mDate.y;
					break;
				
				default :
					returnDate = mDate.d+'-'+mDate.m+'-'+mDate.y;
					break;
			}
			return returnDate;
		}
		function goToLog()
		{
			var siteUrl = "<?php echo $siteUrl; ?>";
			window.location.href = siteUrl;
		}
         /* ================= Check Validation ============== */
/* function onChangeFunction(id, value, min, max)
{
	if(min>=0 && max>0)
	{
		if(parseInt(value)<min || parseInt(value)>max)
		{
			var msg = "value should be "+min+" to "+max+".";
		}
		$("#err_"+id).text(msg);
	}
}	 */	 
function throwError(id, that, hasClass)
{
	$("."+id).addClass('has-error');
	$(that).addClass('has-error');
	$(that).parent().addClass('txt-error');
	if($(that).hasClass(hasClass))
	{
		$(that).parent().parent().addClass('txt-error');
	}
}

         function checkValidate(id, regExp, errMsg, errArr=[], min=0, max=0)
         	{
         		var valid=true;
				var isZero = true;
         	
         		var value = $("#"+id).val();
				//$(".has-error").removeClass("has-error");
				//$(".txt-error").removeClass("txt-error");
				/* 
					txtbuildarea
					txtcost
					plot_price

				*/
         		if(value=='')
         		{
         			var msg = (errArr.length>0 && typeof(errArr[0])!='undefined')? errArr[0] : errMsg;
         			$("#err_"+id).text(msg);
         			$("#"+id).addClass("has-error");
         			$(this).parent().addClass('txt-error');
         			if($(this).hasClass("mand-err"))
         			{
         				$(this).parent().parent().addClass('txt-error');
         			}
         			return;
         		}
				else
				{
					$("#err_"+id).text('');
         				$("#"+id).removeClass("has-error");
         				$("#"+id).parent().removeClass('txt-error');
         				if($("#"+id).hasClass("mand-err"))
         				{
         					$("#"+id).parent().parent().removeClass('txt-error');
         				}
				}
				
				if(id=='txtbuildarea' || id=='txtcost' || id=='plot_price')
				{
					if(value=='0' || value==0)
					{
						var msg = "value must not be 0.";
						$("#err_"+id).text(msg);
						$("#"+id).addClass("has-error");
						$(this).parent().addClass('txt-error');
						if($(this).hasClass("mand-err"))
						{
							$(this).parent().parent().addClass('txt-error');
						}
						return;
					}
				}
				
				if(min>=0 && max>0)
				{
					if(parseInt(value)<min || parseInt(value)>max)
					{
						var msg = "value should be "+min+" to "+max+".";
					}
					throwError(id, $(this), "mand-err");
					setTimeout(function(){$("#err_"+id).text(msg); }, 500);
				}
				
         		if(regExp!='')
         		{
         			var regExp = new RegExp(regExp);
         			if(!regExp.test(value))
         			{
         				var msg = (errArr.length>0 && typeof(errArr[1])!='undefined')? errArr[1] : errMsg;
         				$("#err_"+id).text(msg);
         				$("#"+id).addClass("has-error");
         				$("#"+id).parent().addClass('txt-error');
         				if($("#"+id).hasClass("mand-err"))
         				{
         					$("#"+id).parent().parent().addClass('txt-error');
         				}
         			}
         			else
         			{
         				$("#err_"+id).text('');
         				$("#"+id).removeClass("has-error");
         				$("#"+id).parent().removeClass('txt-error');
         				if($("#"+id).hasClass("mand-err"))
         				{
         					$("#"+id).parent().parent().removeClass('txt-error');
         				}
         			}
         			
         	//console.log(!regExp.test(value))
         			return;
         		}
         	}
         /* ================= Check Validation ============== */
		 
		 /* ============== Password Match ============ */
			function matchPassword(type = 'reg')
			{
				var type = (type=='reg')? '' : 1;
				var pwd = $("#pwd"+type).val();
				var cpwd = $("#cpwd"+type).val();
				
				if(pwd!='' && cpwd!='' && (pwd!=cpwd))
				{
					$("#pwd"+type+", #cpwd"+type).addClass('has-error');
					$("#pwd"+type+", #cpwd"+type).parent().parent().addClass('txt-error');
					$("#err_pwd"+type+", #err_cpwd"+type).text('Both passwords should be match.');
					return false;
				}
				else
				{
					$("#pwd"+type+", #cpwd"+type).removeClass('has-error');
					$("#pwd"+type+", #cpwd"+type).parent().parent().removeClass('txt-error');
					$("#err_pwd"+type+", #err_cpwd"+type).text('');
					return true;
				}
			}
		 /* ============== Password Match ============ */
			 function setUserId(fromId, toId)
			 {
				var fromVal = $("#"+fromId).val();
				var toVal = $("#"+toId).val();
				$("#"+toId).val(((toVal=='')? fromVal : toVal));
				
			 }
		 
		 /* ========== Show Password ======= */
		 /* function showPassword()
		 {
			 
		 } */
		 /* ========== Show Password ======= */
		 $('.headtab').click(function(){
			//$('a[href="#whatsNew"]').click();
			$("html, body").animate({ scrollTop: 200 }, 600); 
		 });
		 setTimeout(function(){$(".close-alert").click(); }, 5000);
		 $(".page-sidebar").css('max-height', ($(window).height()-75));
		 $(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
		
		$(document).ready(function(){
			var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
			if (isMobile) {
				//MessageService.setError("Invalid Access.");
				//return;
				$(".mobile-flag").addClass('collapse');
				console.log("mobile")
			 }
		})
		function submitAction(pageId)
		{
			var baseUrl = $("#baseUrl").val();
			$('#pagination_form').attr('action', baseUrl+pageId+'/');
			$('#pagination_form').submit();
		}
      </script>
   </body>
</html>
