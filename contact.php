<?php 
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php");
	$conn = getDBConnection(); */
	//ini_set("display_errors",1);
	
?>
<?php include_once("header.php"); ?>
<!-- ============================ Page Title Start================================== -->
	<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT; ?>assets/img/slider-3.jpg);" data-overlay="5">
		<div class="ht-80"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="_page_tetio">
						<div class="pledtio_wrap"><span>Get In Touch</span></div>
						<h2 class="text-light mb-0">Get Helps & Friendly Support</h2>
						<p>Looking for help or any support? We's available 24 hour a day.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="ht-120"></div>
	</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
	<section class="pt-0">
		<div class="container">
			<div class="row align-items-center pretio_top">
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="contact-box" style="padding: 22px;">
						<!--<i class="ti-user theme-cl"></i>-->
						<h4>Address</h4>
						<p>
							RAJAVATAR CONSTRUCTIONS,<br />
							ATS Marvel complex, <br />
							H.No: 3-10-459, 2nd FLOOR, Opp: Hanuman Temple, <br />
							Chandra Nagar main road, Nizamabad, Telangana-503001. <br />
							Contact : 7013107291 & 9003227387
						</p>
					</div>
				</div>
				<!--<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="contact-box">
						<i class="ti-user theme-cl"></i>
						<h4>Contact Number</h4>
						<span>+91 7013107291</span>
						<span>+91 9003227387</span>
					</div>
				</div>-->
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="contact-box">
						<i class="ti-comment-alt theme-cl"></i>
						<h4>Start Live Chat</h4>
						<span>+91 7013107291</span>
						<span>+91 9003227387</span>
					</div>
				</div>
			</div>

			<!-- row Start -->
			<div class="row">
				<div class="col-lg-8 col-md-7">
					<div class="property_block_wrap">
						<div class="property_block_wrap_header">
							<h4 class="property_block_title">Fillup The Form</h4>
						</div>
						<div class="block-body">
							<form id="contact_form">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="form-group contact-fields">
											<label>Name</label><span class="text-danger"> *<span id="err_c_name" class="err-msg"></span></span>
											<input type="text" class="form-control simple required" name="name" id="c_name" placeholder="Name" onkeyup="checkValidate('c_name', /^[A-Za-z ]+$/, '', ['Please Enter Name', 'Characters Only.'])" />
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="form-group contact-fields">
											<label>Email</label><span class="text-danger"> *<span id="err_c_email" class="err-msg"></span></span>
											<input type="email" class="form-control simple required" name="email" id="c_email" placeholder="Email" onkeyup="checkValidate('c_email', /^([\w-\.]+@([\w-]+\.)+[\w-]{2,15})?$/, '', ['Please Enter Email', 'Invalid Mail.'])" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="form-group contact-fields">
											<label>Phone</label><span class="text-danger"> *<span id="err_c_phone" class="err-msg"></span></span>
											<input type="text" class="form-control simple required" name="phone" id="c_phone" placeholder="phone" onkeyup="checkValidate('c_phone', /^[0-9+ ]{0,15}$/, '', ['Please Enter Phone', 'Enter Digits only.'])" />
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="form-group contact-fields">
											<label>Subject</label><span class="text-danger"> *<span id="err_c_subject" class="err-msg"></span></span>
											<input type="text" class="form-control simple required" name="subject" id="c_subject" placeholder="Subject" onkeyup="checkValidate('c_subject', '', 'Please Enter Subject', [])"  />
										</div>
									</div>
									<!--<label>Subject</label><span class="text-danger"> *<span id="err_subject" class="err-msg"></span></span>
									<input type="text" class="form-control simple required" name="subject" id="subject" placeholder="Subject" onkeyup="checkValidate('subject', '', '', ['Please Enter Subject', 'Invalid Subject.'])"  />-->
								</div>
								<div class="form-group">
									<label>Message</label>
									<textarea class="form-control simple" name="message" id="message" rows="3" placeholder="Message"></textarea>
								</div>
								<input type="hidden" name="action" value="contactform" /> 
								<div class="form-group">
									<button class="btn btn-theme" type="button" id="contact_submit">Submit Request</button>
								</div>
								<div class="notify"></div>
							</form>
							
							<script>
								$(document).on('click', '#contact_submit', function(event)
								{
									event.preventDefault();
									valid=true;
									$(".contact-fields>.required").each(function(index, el)
									{
										if($(el).val()=='')
										{
											valid=false;
											$(this).addClass('has-error');
											$(this).parent().addClass('txt-error');
										}
									});
									if(valid)
									{
										$(".notify").css('display', 'inherit').removeClass('text-success').removeClass('text-danger');
										$(".has-error").removeClass('has-error');
										$(".txt-error").removeClass('txt-error');
										frmdata=$("#contact_form").serialize();
										//frmdata = new FormData( $( 'form#contact_form' )[ 0 ] );
										
										$.ajax({
											url: '<?php echo ROOT?>ajax/prop-ajax.php',
											type: 'POST',
											data:frmdata ,
											success:function(response){
												//console.log(response)
												$("#contact_form")[0].reset();
												jsn=$.parseJSON(response);
												$(".notify").addClass(jsn.type).html(jsn.message).fadeOut(10000);
											}
										})
										.done(function() {
										//console.log("success");
										//setTimeout(function(){$(".noty").html(""); }, 3000);

										});
									}
								});
							</script>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-5">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3780.0343635007684!2d78.09651126235902!3d18.662453896329456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcddb6b5b5cde03%3A0xf4cab48f2c1ecc52!2sRAJAVATAR%20CONSTRUCTIONS!5e0!3m2!1sen!2sin!4v1639376097649!5m2!1sen!2sin" width="100%" height="470" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
			<!-- /row -->		
		</div>	
	</section>
<!-- ============================ Agency List End ================================== -->

	<div class="clearfix"></div>
<!-- ============================ article End ================================== -->

<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<!-- ============================ Call To Action End ================================== -->
<?php include_once("footer.php"); ?>
