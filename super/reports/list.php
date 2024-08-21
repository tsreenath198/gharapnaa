<?php 
	/* include("../template.php");head();if(!$_SESSION['LOGGED']){header("location:".ROOT."super/");} */	
	include("../includes/config.php");	
	/* include("../includes/connection.php");	
	include("../includes/queries.php");	
	include("../includes/functions.php");	
	include("../includes/MysqliDb.php");	
	include("../includes/session.php");	 */	
		
	if(!$session->isEmployeeLoggedin()){	
		$session->clearSession();
		header("location:".ROOT."super/");
		die();
	}
	
?>
<?php include_once("../header.php"); ?>
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<!--<div class="page-title" style="background:#f4f4f4 url(<?php echo ROOT?>assets/img/slider-5.jpg);" data-overlay="5">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="breadcrumbs-wrap">
<ol class="breadcrumb">
<li class="breadcrumb-item active" aria-current="page">  

 Users


</li>
</ol>
<h2 class="breadcrumb-title">


Welcome Admin
</h2>
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
	<div class="dashboard-body">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card mt-1">
					<div class="card-body p-0">
						Enquires Activity Report
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




</div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->




<!-- ============================ Call To Action ================================== -->

<?php include_once("../footer.php"); ?>

<div class="modal fade font-12" id="view_conv_modal" tabindex="-1" role="dialog" aria-labelledby="authomessage" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered login-pop-form modal-lg" role="document">
		<div class="modal-content" id="authomessage">
			<span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
			<div class="modal-body">
				<h4 class="modal-header-title">Conversation List</h4>
				<div class="login-form">
					<table class="table table-bordered table-responsive font-12">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Rating</th>
								<th style="width:60%">Comment</th>
								<th>Added By</th>
								<th>Date Added</th>
							</tr>
						</thead>
						<tbody id="conv_records_list">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
		 
<script>

function sendAjax(convId = 0, type = '')
{
	$("#view_conv_modal").modal("show");
	var ratingsArr = <?php echo json_encode($RATING_ARR); ?>;
	$.ajax({
		url: '<?php echo ROOT?>ajax/prop-ajax.php',
		type: 'POST',
		data: 'action=viewconv&id='+convId+'&type='+type,
		success:function(response){	
			jsn=$.parseJSON(response);
			if(jsn.status=='success')
			{
				var convList = jsn.data;
				
				var tableData = '';
				if(convList.length>0)
				{
					for(var i=0; i<convList.length; i++)
					{
						tableData += '<tr><td>'+(i+1)+'</td><td>'+ratingsArr[convList[i]['rating']]+'</td><td>'+convList[i]['comment']+'</td><td>'+convList[i]['addedBy']+'</td><td>'+getDateFormat(convList[i]['date_added'], 'dd-MM-yyyy')+'</td></tr>';
					}
				}
				else
				{
					tableData += '<tr><td colspan="5" class="text-center">No records found.</td></tr>';
				}
				$("#conv_records_list").html(tableData);
			}
			if(jsn.status=='error')
			{
				//$(".notify-otp").addClass(jsn.type).html(jsn.message).fadeOut(10000);
			}
			/* setTimeout(function(){
				$('#mailOTP').removeClass('disabled');
			},60000); */
		}
	})
	.done(function() {
		//console.log("success");
		//setTimeout(function(){$(".noty").html(""); }, 3000);

	});
}
$(document).on('click', '#eq_conv_view', function(event) {
	event.preventDefault();
	var convId = $(this).data('id');
	
	if(convId!='')
	{
		sendAjax(convId, 'enquiry');
	}
});
$(document).on('click', '#pr_conv_view', function(event) {
	event.preventDefault();
	var convId = $(this).data('id');
	if(convId!='')
	{
		sendAjax(convId, 'property');
	}
});
</script>