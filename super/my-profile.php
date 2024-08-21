<?php 
/* include("template.php");
head(); */

	include("../includes/config.php");
	/* include("../includes/connection.php");
	include("../includes/queries.php");
	include("../includes/functions.php");
	include("../includes/MysqliDb.php");
	include("../includes/session.php"); */
	
	if(!$session->getIsLoggedIn() || !$session->isAdmin()){
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
	$userId = $session->getUserId();
	$name = $email = $phone = $degi = $addr = $city = $state = $pin = '';
	
	/* $conn = getDBConnection(); */
	
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
				$updateSql = "UPDATE `".TBL_EMPLOYEES."` SET `first_name`='".$name."',`email`='".$email."',`phone`='".$phone."',`city`='".$city."',`address`='".$addr."',`zip`='".$pin."',`state`='".$state."',`designation`='".$degi."' WHERE `id`='".$userId."'";
				$db->insertUpdateRecord($updateSql);
			}
		}
		
		$user = $db->getSingleRowArray("SELECT * FROM `".TBL_EMPLOYEES."` WHERE `id`='".$userId."'");
		if(count($user)>0)
		{
			$name = $user["first_name"];
			$email = $user["email"];
			$phone = $user["phone"];
			$degi = $user["designation"];
			$addr = $user["address"];
			$city = $user["city"];
			$state = $user["state"];
			$pin = $user["zip"];
		}
	}
	else
	{
		
	}
?>
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<!--<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets//img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">My Profile</li>
</ol>
<h2 class="breadcrumb-title">My Account & Profilee</h2>
</div>

</div>
</div>
</div>
</div>-->
<!-- ============================ Page Title End ================================== -->

<!-- ============================ User Dashboard ================================== -->
<section class="gray pt-3 pb-5">
<div class="container-fluid">

<div class="row">

<div class="col-lg-3 col-md-4 col-sm-12 py-2">
<?php include_once("../sidebar.php"); ?>
</div>

<div class="col-lg-9 col-md-8 col-sm-12 py-2">
	<?php include_once("../templates/profile.php"); ?>
</div>

</div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->




<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="call_action_wrap">
<div class="call_action_wrap-head">
<h3>Do You Have Questions ?</h3>
<span>We'll help you to grow your career and growth.</span>
</div>
<a href="#" class="btn btn-call_action_wrap">Contact Us Today</a>
</div>

</div>
</div>
</div>
</section>
<?php include_once("../footer.php"); ?>