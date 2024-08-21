<?php

	$enquiryId = isset($_GET['eId']) && $_GET['eId']>0? $_GET['eId'] : 1;
	$activityType = (isset($_GET['type'])&&$_GET['type']=='property')? "property" : "contact";
	
 	$toDayDt = date("Y-m-d");
	$toDayTime = date("H:i");
	$userId = $session->getUserId();
	$leadId = $contactId = 0;
	$type = 'contact';
	
	if(isset($_POST['addConversion']) && $userId>0)
	{
		
		$result = $_POST['rating'];
		$remind_date = $_POST['remind_date'];
		$activityDone = (isset($_POST['activityDone'])&&$_POST['activityDone']=='1')? 1 : 0;
		
		$comment = $db->escString($_POST['comment']);
		$message = $db->escString($_POST['message']);
		
		$dateAdded = date("Y-m-d H:i:s");
		
		if($activityType=='property')
		{
			$contactData = $db->getSingleRowArray("SELECT * FROM `".TBL_ENQUIRIES."` WHERE `eq_id`='".$enquiryId."'");
			$contactId = (isset($contactData['eq_id']) && $contactData['eq_id']>0)? $contactData['eq_id'] : 0;
			$name = $contactData['eq_name'];
			$email = $contactData['eq_email'];
			$phone = $contactData['eq_mobile'];
			$ip = $contactData['ip'];
			$browser_info = $contactData['browser_info'];
			$type = 'property';
			$redirectUrl = ROOT.ADMIN_PROPERTY_ENQUIRIES.'1/';
			$updateSql = "UPDATE `".TBL_ENQUIRIES."` SET `rating`='".$result."' WHERE `eq_id`='".$enquiryId."'";
		}
		else
		{
			$contactData = $db->getSingleRowArray("SELECT * FROM `".TBL_CONTACTS."` WHERE `id`='".$enquiryId."'");
			$contactId = (isset($contactData['id']) && $contactData['id']>0)? $contactData['id'] : 0;
			$name = $contactData['name'];
			$email = $contactData['email'];
			$phone = $contactData['phone'];
			$ip = $contactData['ip'];
			$browser_info = $contactData['browser_info'];
			$type = 'enquiry';
			$redirectUrl = ROOT.ADMIN_ENQUIRIES.'1/';
			$updateSql = "UPDATE `".TBL_CONTACTS."` SET `rating`='".$result."' WHERE `id`='".$enquiryId."'";
		}
		
		/* echo $activityDone;
		die(); */
		if($contactId>0)
		{
			$leadRecords = $db->getSingleRowArray("SELECT * FROM `".TBL_LEADS."` WHERE `email`='".$email."' OR `phone`='".$phone."'");
			/* ============= Lead Creation =========== */
			//if(isset($_POST['isLeadCreate']) && $_POST['isLeadCreate']=='1' && count($leadRecords)==0) 
			/* if($result>0 && $result<4) 
			{
				$insertLeadSQL = "INSERT INTO `".TBL_LEADS."` (`emp_id`, `name`, `email`, `phone`, `result`, `activity_done`, `activity_count`, `last_activity`, `last_activity_date`, `ip`, `browser_info`, `added_by`, `date_added`) VALUES ('".$userId."', '".$name."', '".$email."', '".$phone."', '".$result."', '".$activityDone."', '1', '".$comment."', '".$dateAdded."', '".$ip."', '".$browser_info."', '".$userId."', '".$dateAdded."')";
				
				$leadId = $db->insertUpdateRecord($insertLeadSQL);
			}
			else if(count($leadRecords)>0)
			{
				$leadId = $leadRecords['id'];
				$db->insertUpdateRecord("UPDATE `".TBL_LEADS."` SET `activity_count`=`activity_count`+1 WHERE `id`='".$leadId."'");
			} */
			/* ============= Lead Creation =========== */
			$type = ($leadId>0)? 'lead' : $type;
			$insertActivitySQL = "INSERT INTO `".TBL_ACTIVITIES."` (`lead_id`, `contact_id`, `type`, `rating`, `comment`, `added_by`, `date_added`) VALUES ('".$leadId."', '".$contactId."', '".$type."', '".$result."', '".$comment."', '".$userId."', '".$dateAdded."')";
			$db->insertUpdateRecord($insertActivitySQL);
			$db->insertUpdateRecord($updateSql);
			
			if($activityDone) 
			{
				if($type=='lead' && $leadId>0)
				{
					$updateReminderSQL = "UPDATE `".TBL_REMINDERS."` SET `is_done`=1 WHERE `lead_id`='".$leadId."'";
				}
				else
				{
					$updateReminderSQL = "UPDATE `".TBL_REMINDERS."` SET `is_done`=1 WHERE `contact_id`='".$contactId."' AND `type`='".$type."'";
				}
				$db->insertUpdateRecord($updateReminderSQL);
			}
			else if(isset($_POST['isAddReminder']) && $_POST['isAddReminder']=='1') 
			{
				if($type=='lead' && $leadId>0)
				{
					$updateReminderSQL = "UPDATE `".TBL_REMINDERS."` SET `is_done`=1 WHERE `lead_id`='".$leadId."'";
				}
				else
				{
					$updateReminderSQL = "UPDATE `".TBL_REMINDERS."` SET `is_done`=1 WHERE `contact_id`='".$contactId."' AND `type`='".$type."'";
				}
				$db->insertUpdateRecord($updateReminderSQL);
				$insertReminderSQL = "INSERT INTO `".TBL_REMINDERS."` (`lead_id`, `contact_id`, `type`, `remind_to`, `remind_date`, `remind_message`, `added_by`, `date_added`) VALUES ('".$leadId."', '".$contactId."', '".$type."', '".$userId."', '".$remind_date."', '".$message."', '".$userId."', '".$dateAdded."')";
				$db->insertUpdateRecord($insertReminderSQL);
			}
			
			header("Location: ".$redirectUrl);
			die();
		}
	}
?>
<div class="dashboard-body">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header c-header">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-12">
							<h4 class="mb-0 text-white">Add Activity</h4>
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-right">
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-3"></div>
						<div class="col-6">
							<form name="addactivityform" class="p-10" method="POST" onsubmit="return validateActivityForm();" style="border: 1px solid #c4c4c4;border-radius: 10px;background:#f4f4f4;">
								<div class="frm_submit_block">	
									<div class="frm_submit_wrap">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Rating </label><span class="text-danger">* <span id="err_rating" class="err-msg"></span></span>
												<select class="form-control convrequired" id="rating" name="rating" onchange="checkValidate('rating', '', 'Invalid Rating');">
													<option value="">-- Rating --</option>
													<?php
														foreach($RATING_ARR as $key => $val)
														{
															echo '<option value="'.$key.'">'.$val.'</option>';
														}
													
													?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>Converstion Status</label>
												<div class="row">
													<div class="col-6">
														<input type="radio" class="form-control" id="done" name="activityDone" value="1" /> <label for="done">Done</label>
													</div>
													<div class="col-6">
														<input type="radio" class="form-control" id="notdone" name="activityDone" value="0" checked /> <label for="notdone">Not-Done</label>
													</div>
												</div>
											</div>
											<div class="form-group col-md-12">
												<label>Comment</label><span class="text-danger">* <span id="err_comment" class="err-msg"></span></span>
												<textarea class="form-control convrequired" name="comment" id="comment" onchange="checkValidate('comment', '', 'Invalid Convesation Message');"></textarea>
											</div>
										</div>
										<hr />
										<div class="form-row">
											<!--<div class="form-group col-md-6 text-center">
												Is Lead Create ?<input type="checkbox" name="isLeadCreate" value="1" class="m-4" />
											</div>-->
											<div class="form-group col-md-6 text-center">
												Is Add Reminder ?<input type="checkbox" id="enable_reminder" name="isAddReminder" value="1" class="m-4" />
											</div>
										</div>
										<hr />
										<div class="form-row rem-hide hide">
											<div class="form-group col-md-12">
												<label>Reminder Date</label><span class="text-danger">* <span id="err_possdate" class="err-msg"></span></span>
												<input type="date" name="remind_date" id="possdate" min="<?php echo $toDayDt."T".$toDayTime;?>" class="form-control rem-hide-req" value="" onchange="checkValidate('possdate', '', 'Invalid Date');">
												<!--<input type="datetime-local" name="remind_date" id="possdate" min="<?php echo $toDayDt."T".$toDayTime;?>" class="form-control rem-hide-req" value="" onchange="checkValidate('possdate', '', 'Invalid Date');">-->
											</div>
											<div class="form-group col-md-12">
												<label>Reminder Message</label><span class="text-danger">* <span id="err_message" class="err-msg"></span></span>
												<textarea class="form-control rem-hide-req" name="message" id="message" onchange="checkValidate('message', '', 'Invalid Convesation Message');"></textarea>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-12 text-right">
												<input type="submit" name="addConversion" class="btn btn-success" value="Add Conversion" />
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="col-3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>

<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 
		$(document).on('click', '#enable_reminder', function(event) 
		{
			var remVal = $('#enable_reminder').is(':checked');
			if(remVal)
			{
				$(".rem-hide").removeClass("hide");
				$(".rem-hide-req").addClass("convrequired");
			}
			else
			{
				$(".rem-hide-req").removeClass("convrequired");
				$(".rem-hide").addClass("hide");
			}
		})
	 });
	 function validateActivityForm()
	 {
		var valid = true;
		$(".convrequired").each(function(index, el) 
		{
			if(!$(el).val()){
				valid=false;
				$(this).addClass('has-error');
				$(this).parent().addClass('txt-error');
			}  
		});
		return ((valid)? true : false);
	 }
</script>
