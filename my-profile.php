<?php 
/* include("template.php");
head(); */

	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	$notlog = false;
	
	if(!$session->getIsLoggedIn()){
		$notlog = true;
	}
	$userId = $session->getUserId();
	$name = $email = $phone = $degi = $addr = $city = $state = $pin = '';
	
	/* $conn = getDBConnection(); */
	//echo $userId;
	if($userId>0)
	{
	
		/* $prfobj=new Mysqlidb(HOST,USER,PWD,DB);
		$prfobj->where("u_id",$userId);
		$user=$prfobj->getOne("user","*"); */
		
		if(isset($_POST['updateProfile']))
		{
			$name = $db->escString($_POST['name']);
			$email = $db->escString($_POST['email']);
			$phone = $db->escString($_POST['phone']);
			$degi = $db->escString($_POST['degi']);
			$addr = $db->escString($_POST['addr']);
			$city = $db->escString($_POST['city']);
			$state = $db->escString($_POST['state']);
			$pin = $db->escString($_POST['pin']);
			
			if($userId>0)
			{
				$updateSql = "UPDATE `".TBL_USER."` SET `u_name`='".$name."',`u_email`='".$email."',`u_phone`='".$phone."',`u_desig`='".$degi."',`u_city`='".$city."',`u_addr`='".$addr."',`u_pin`='".$pin."',`u_state`='".$state."' WHERE `u_id`='".$userId."'";
				$db->insertUpdateRecord($updateSql);
			}
		}
		
		$user = $db->getSingleRowArray("SELECT * FROM `".TBL_USER."` WHERE `u_id`='".$userId."'");
		if(count($user)>0)
		{
			$name = $user["u_name"];
			$email = $user["u_email"];
			$phone = $user["u_phone"];
			$degi = $user["u_desig"];
			$addr = $user["u_addr"];
			$city = $user["u_city"];
			$state = $user["u_state"];
			$pin = $user["u_pin"];
		}
	}
	else
	{
		
	}
	
	
?>
<?php include_once("header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets//img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">My Profile</li>
</ol>
<h2 class="breadcrumb-title">My Account & Profile</h2>
</div>

</div>
</div>
</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ User Dashboard ================================== -->
<section class="gray pt-3 pb-5">
<div class="container-fluid">

<div class="row">

<div class="col-lg-3 col-md-4 col-sm-12 py-2">
<?php include_once("sidebar.php"); ?>
</div>

<div class="col-lg-9 col-md-8 col-sm-12 py-2">
<?php include_once("templates/profile.php"); ?>
<!-- <div class="dashboard-body">

<div class="dashboard-wraper">

Basic Information ->
<div class="frm_submit_block">	
<h4>My Account</h4>
<div class="frm_submit_wrap">
<div class="form-row">

<!--<style>
.editField {
	display: none;
}
</style>
<div class="col-md-12 form-group text-right">
	<button class="btn btn-sm btn-success" id="editBtn">Edit</button>
	<button class="btn btn-sm btn-success" id="viewBtn">View</button>
</div>
<div class="form-group col-md-6">
<label>Your Name</label>
<div class="viewField"><?php echo $user["u_name"]?></div>
<div class="editField"><input type="text" class="form-control" value="<?php echo $user["u_name"]?>"></div>
</div>

<div class="form-group col-md-6">
<label>Email</label>
<input type="email" class="form-control" value="<?php echo $user["u_email"]?>">
</div>

<div class="form-group col-md-6">
<label>Your Designation</label>
<input type="text" class="form-control" value="<?php echo $user["u_desig"]?>">
</div>

<div class="form-group col-md-6">
<label>Phone</label>
<input type="text" class="form-control" value="<?php echo $user["u_phone"]?>">
</div>

<div class="form-group col-md-6">
<label>Address</label>
<input type="text" class="form-control" value="<?php echo $user["u_addr"]?>">
</div>

<div class="form-group col-md-6">
<label>City</label>
<input type="text" class="form-control" value="<?php echo $user["u_city"]?>">
</div>

<div class="form-group col-md-6">
<label>State</label>
<input type="text" class="form-control" value="<?php echo $user["u_state"]?>">
</div>

<div class="form-group col-md-6">
<label>PIN</label>
<input type="text" class="form-control" value="<?php echo $user["u_pin"]?>">
</div>


</div>
</div>
</div>


</div>

</div>-->
</div>

</div>
</div>
</section>
<!--<script type="text/javascript">
$(document).on('click', '#editBtn', function(event) {
	event.preventDefault();
	$(".viewField, #editBtn").hide();
	$(".editField, #viewBtn").show();
});
$(document).on('click', '#viewBtn', function(event) {
	event.preventDefault();
	$(".editField, #viewBtn").hide();
	$(".viewField, #editBtn").show();
});
</script>-->
<!-- ============================ User Dashboard End ================================== -->



<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<?php include_once("footer.php"); ?>