<?php 
	include("includes/config.php");
	/* include("includes/connection.php");
	include("includes/queries.php");
	include("includes/functions.php");
	include("includes/MysqliDb.php");
	include("includes/session.php"); */
	
	//ini_set("display_errors",1);
	$conn = getDBConnection();
	
?>
<?php include_once("header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url(assets/img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">Saved Properties</li>
</ol>
<h2 class="breadcrumb-title">Your All Saved Properties</h2>
</div>

</div>
</div>
</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ User Dashboard ================================== -->
<section class="gray pt-5 pb-5">
<div class="container-fluid">

<div class="row">


<div class="col-lg-3 col-md-4 col-sm-12 py-2">
<?php include_once("sidebar.php"); ?>
</div>

<div class="col-lg-9 col-md-8 col-sm-12 py-2">
<div class="dashboard-body">

<div class="dashboard-wraper">

<!-- Bookmark Property -->
<div class="frm_submit_block">	
<h4>Bookmark Property</h4>
</div>

<table class="property-table-wrap responsive-table bkmark">

<tbody>
<tr>
<th><i class="fa fa-file-text"></i> Property</th>
<th></th>
</tr>

<!-- Item #1 -->
<tr>
<td class="dashboard_propert_wrapper">
<img src="<?php echo ROOT; ?>assets/img/p-2.png" alt="">
<div class="title">
<h4><a href="#">Serene Uptown</a></h4>
<span>6 Bishop Ave. Perkasie, PA </span>
<span class="table-property-price">$900 / monthly</span>
</div>
</td>
<td class="action">
<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
</td>
</tr>

<!-- Item #2 -->
<tr>
<td class="dashboard_propert_wrapper">
<img src="<?php echo ROOT; ?>assets/img/p-3.png" alt="">
<div class="title">
<h4><a href="#">Oak Tree Villas</a></h4>
<span>71 Lower River Dr. Bronx, NY</span>
<span class="table-property-price">$535,000</span>
</div>
</td>
<td class="action">
<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
</td>
</tr>

<!-- Item #3 -->
<tr>
<td class="dashboard_propert_wrapper">
<img src="<?php echo ROOT; ?>assets/img/p-4.png" alt="">
<div class="title">
<h4><a href="#">Selway Villas</a></h4>
<span>33 William St. Northbrook, IL </span>
<span class="table-property-price">$420,000</span>
</div>
</td>
<td class="action">
<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
</td>
</tr>

<!-- Item #4 -->
<tr>
<td class="dashboard_propert_wrapper">
<img src="<?php echo ROOT; ?>assets/img/p-5.png" alt="">
<div class="title">
<h4><a href="#">Town Manchester</a></h4>
<span> 7843 Durham Avenue, MD  </span>
<span class="table-property-price">$420,000</span>
</div>
</td>
<td class="action">
<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
</td>
</tr>

</tbody>
</table>

</div>

<!-- row -->

</div>
</div>

</div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->
<?php include_once("call-to-action.php"); ?>
<?php include_once("footer.php"); ?>
