<?php
	include("config.php");
	include("includes/session_auto_destroy.php");
	$page = 'category_add';
	
	
	$iCategoryId = intval($_REQUEST['id']);
	if($iCategoryId > 0){
		$sql = $gcr->gc_query("SELECT * FROM product_category WHERE iCategoryId = '".$iCategoryId."'");
		$row = $gcr->gc_fetch_array($sql);
		$vCategoryName = htmlentities($row['vCategoryName']);
		$tImagePath = $row['tImagePath'];
		$iDisplayOrder = $row['iDisplayOrder'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=($iCategoryId > 0)?'Edit Product Category':'Add New Product Category'?></title>
	
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
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->

	<script src="assets/js/jquery.validate.min.js"></script>
	
	<script type="text/javascript" src="assets/js/plugins/forms/tags/tagsinput.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/tags/tokenfield.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/prism.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>

	
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
</head>
<body class=" pace-done">
	<?php include("includes/topbar.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include("includes/siderbar.php"); ?>
			<div class="page-header">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=($iCategoryId > 0)?'Edit Model Category':'Add New Product Category'?></span></h4>
					</div>
				</div>
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="index"><i class="icon-home2 position-left"></i> Dashboard</a></li>
						<li class="active"><i class="<?=($iCategoryId > 0)?'fa fa-pencil-square':'fa fa-plus-square'?> position-left"></i> <?=($iCategoryId > 0)?'Edit Model Category':'Add New Product Category'?></li>
					</ul>
				</div>
			</div>
			<!-- Page Content Start -->
			<div class="content">
				<div class="col-md-12">
					<form id="form-data">
						<input type="hidden" name="do_action" value="Add_Edit">
						<input type="hidden" name="iEditId" value="<?=$iCategoryId?>">
						<div class="panel panel-flat">
							<div class="panel-body">
								<fieldset>
									<div class="row">
										<div class="col-md-12">
											<div id="alert"></div>
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Category Name *</label>
														<input type="text" class="form-control required" name="vCategoryName" value="<?=$vCategoryName?>" />
													</div>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Display Order</label>
														<input type="text" class="form-control number" name="iDisplayOrder" value="<?=$iDisplayOrder?>" />
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Category Image <small>(JPG - 270X270 in Pixel)</small></label>
														<input type="file" name="tImagePath" class="file-styled">
														<?php if($tImagePath != ''){ ?>
														<div class="pro_img_view">
															<img src="uploads/category/<?=$tImagePath?>" />
														</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<button type="button" id="btn_sub" class="btn btn-primary" onclick="frmsubmit()">Submit <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</div>
								</fieldset>	
								<div class="text-right"></div></div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- End Content -->
			<!-- Page Content End -->
			<?php include("includes/footer.php"); ?>
		</div>
	</div>
	<script>
		$( document ).ready(function() {
			$('.number').keypress(function(event) {
				if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
					event.preventDefault();
				}
			});
			
			// Single file uploader
			$("#form-data").validate({
			   ignore: ":hidden"
			});
			
			$('.select2').select2();
			
			$(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });
			$('.file-styled').uniform({
				fileButtonHtml: '<i class="icon-googleplus5"></i>',
				//wrapperClass: 'bg-file-icon'
			});
		});
		
		function frmsubmit(){
			if($('#form-data').valid()){
				$('#btn_sub').attr('disabled',true);
				var formData = new FormData($("#form-data")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/product_category_action',
					data: formData,
					async: false,
					dataType: "json",
					success: function (data) {
						$('#btn_sub').attr('disabled',false);
						if(data.flg == 1){
							$('#alert').html('<div class="alert alert-success no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data.msg+'</a></div>');
							setTimeout(function(){
								window.location = 'category_manage';
							}, 2000);
						}else{
							$('#alert').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data.msg+'</a></div>');
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
		}
		
		$(function() {
			// Data
			var substringMatcher = function(strs) {
				return function findMatches(q, cb) {
					var matches, substringRegex;

					// an array that will be populated with substring matches
					matches = [];

					// regex used to determine if a string contains the substring `q`
					substrRegex = new RegExp(q, 'i');

					// iterate through the pool of strings and for any string that
					// contains the substring `q`, add it to the `matches` array
					$.each(strs, function(i, str) {
						if (substrRegex.test(str)) {

							// the typeahead jQuery plugin expects suggestions to a
							// JavaScript object, refer to typeahead docs for more info
							matches.push({ value: str });
						}
					});
					cb(matches);
				};
			};
		});

		$(document).keypress(
		function(event){
			if (event.which == '13') {
				event.preventDefault();
				frmsubmit();
			}
		});
	</script>
</body>
</html>