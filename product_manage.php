<?php
	include("config.php");
	include("includes/session_auto_destroy.php");
	$page = 'product_manage';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product List</title>
	
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	
	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	
	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->
	<script src="assets/js/jquery.validate.min.js"></script>
	<style>
		.dataTables_wrapper .table-bordered{
			border-top:1;
		}
		.table > tbody > tr > td{
			padding:8px 15px;
		}
		.table-bordered > thead > tr > th{
			border-bottom-width: 1px;
			padding:8px 15px;
		}
	</style>
	
</head>
<body class=" pace-done">
	<?php include("includes/topbar.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include("includes/siderbar.php"); ?>
			<div class="page-header">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Product List</span></h4>
					</div>
				</div>
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="index"><i class="icon-home2 position-left"></i> Dashboard</a></li>
						<li class="active"><i class="fa fa-list-ul position-left"></i> Product List</li>
					</ul>
					<!-- <ul class="breadcrumb-elements">
						<li><a href="project_add.php"><i class="fa fa-plus-square position-left"></i> Add New Project</a></li>
					</ul> -->
				</div>
			</div>
			<!-- Page Content Start -->
			<div class="content">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<!--
						<div class="panel-heading">
							<h5 class="panel-title">Items</h5>
						</div>
						-->
						<div class="panel-body">
							<fieldset>
								<table id="example" class="table table-bordered table-hover datatable-highlight col-md-3 col-xs-12">
									<thead>
										<tr>
											<th class="col-md-1">#</th>
											<th width="100">Image</th>
											<th>Category</th>
											<th>Product Name</th>
											<th>Display Order</th>
											<th class="col-md-1 ">Action</th>
										</tr>
									</thead>
								</table>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
			<!-- End Content -->
			<!-- Page Content End -->
			<?php include("includes/footer.php"); ?>
		</div>
	</div>
	
	
	
	<script>
		// Setting datatable defaults
		$.extend( $.fn.dataTable.defaults, {
			language: {
				search: '<span>Filter:</span> _INPUT_',
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: { 'first': '<i class="fa fa-step-backward"></i>', 'last': '<i class="fa fa-step-forward"></i>', 'next': '<i class="fa fa-forward"></i>', 'previous': '<i class="fa fa-backward"></i>'}
			},
		});
		
		var table = '';
		$(document).ready(function() {
			$(function() {
				$('.select').select2({
					//minimumResultsForSearch: Infinity,
				});
			});

				table = $('#example').DataTable({
				processing: true,
                serverSide: true,
				ajax: {
					url:"datatables/products.php",
					type:'post'
				},
				order: [[3, 'asc']],
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [0,1,5] }],
				/*"createdRow": function (row, data, index){
					//console.log(data.isExpired);
					if (data.isExpired == 1) {
		                //$(row).addClass( 'lightRed' );
		            }
		        }*/
			});
		});

		function deleterow(id){
			try{
				BootstrapDialog.confirm('Are you sure want to delete?', function(result){
					if(result){
						$.ajax({
							type: 'POST',
							url: 'process/product_action',
							data: {'do_action':'Delete','id':id},
							//dataType: "json",
							async: false,
							success: function (data) {
								table.ajax.reload( null, false )
							}
						});
					}
				});
			}catch(e){
				alert(e);
			}
		 }
	</script>
	<script src="assets/js/plugins/bootstrap-dialog/bootstrap-dialog.min.js"></script>
</body>
</html>