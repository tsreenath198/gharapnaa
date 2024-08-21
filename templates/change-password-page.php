<?php
	/* $conn = getDBConnection();
	
	if(isset($_POST['changePassword']))
	{
		$oPwd = md5(mysqli_real_escape_string($conn, $_POST['oldPwd']));
		$nPwd = md5(mysqli_real_escape_string($conn, $_POST['newPwd']));
		$cPwd = md5(mysqli_real_escape_string($conn, $_POST['confirmPwd']));
		
		if($nPwd==$cPwd)
		{
			$userId = getUserId();
			if(isAdmin())
			{
				$userData = (array)getRecordsAssoc($conn, $selectQuery);
				$password = $userData['password'];
				$selectQuery = "SELECT * ".TBL_LOGIN." WHERE `id`='".$userId."'";
				$updateSQl = "UPDATE ".TBL_LOGIN." SET `password`='".$nPwd."' WHERE `id`='".$userId."'";
			}
			else
			{
				$userData = (array)getRecordsAssoc($conn, $selectQuery);
				$password = $userData['u_pwd'];
				$selectQuery = "SELECT * ".TBL_USER." WHERE `u_id`='".$userId."'";
				$updateSQl = "UPDATE ".TBL_USER." SET `u_pwd`='".$nPwd."' WHERE `u_id`='".$userId."'";
			}
			if($password==$oPwd)
			{
				insertUpdateRecord($conn, $updateSQl);
			}
			else
			{
				
			}
		}
		else
		{
			
		}
		
	} */
?>
<div class="dashboard-body">
	<div class="dashboard-wraper">
		<!-- Basic Information -->
		<div class="frm_submit_block">	
			<h4>Change Your Password</h4>
			<form name="chagepwdform" id="chage_pwd_form">
				<div class="frm_submit_wrap">
					<div class="form-row">
						<input type="hidden" name="action" value="changepwd" /> 
						<div class="form-group col-lg-12 col-md-6 pwd-fields">
							<label>Old Password</label><span class="text-danger"> *<span id="err_oldPwd" class="err-msg"></span></span>
							<input type="password" name="oldPwd" id="oldPwd" class="form-control required" onkeyup="checkValidate('oldPwd', '', '', ['Please Enter Password'])" />
						</div>
						<div class="form-group col-md-6 pwd-fields">
							<label>New Password</label><span class="text-danger"> *<span id="err_pwd" class="err-msg"></span></span>
							<input type="password" name="newPwd" id="pwd" class="form-control required" onkeyup="checkValidate('pwd', '', '', ['Please Enter Password'])"  onblur="matchPassword('reg');" />
						</div>
						<div class="form-group col-md-6 pwd-fields">
							<label>Confirm password</label><span class="text-danger"> *<span id="err_cpwd" class="err-msg"></span></span>
							<input type="password" name="confirmPwd" id="cpwd" class="form-control required" onkeyup="checkValidate('cpwd', '', '', ['Please Enter Password'])" onblur="matchPassword('reg');" />
						</div>
						<div class="form-group col-lg-12 col-md-12">
							<button class="btn btn-theme" type="button" id="change_password" name="changePassword">Save Changes</button>
						</div>
						<div class="notify"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).on('click', '#change_password', function(event)
	{
		event.preventDefault();
		valid=true;
		$(".pwd-fields>.required").each(function(index, el)
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
			frmdata=$("#chage_pwd_form").serialize();
			//frmdata = new FormData( $( 'form#contact_form' )[ 0 ] );
			
			$.ajax({
				url: '<?php echo ROOT?>ajax/prop-ajax.php',
				type: 'POST',
				data:frmdata ,
				success:function(response){
					//console.log(response)
					
					jsn=$.parseJSON(response);
					if(jsn.status=='success')
					{
						$("#chage_pwd_form")[0].reset();
					}
						
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
