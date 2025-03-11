<?php
	include("config.php");
	include("includes/session_auto_destroy.php");
	
	$page = 'product_add';
	
	$iProductId = intval($_REQUEST['id']);
	if($iProductId > 0){
		$sql = $gcr->gc_query("SELECT * FROM products WHERE iProductId = '".$iProductId."'");
		$row = $gcr->gc_fetch_array($sql);
		extract($row);
		$vName = htmlentities($vName);
		$tDescription = htmlentities($tDescription);
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=($iProductId > 0)?'Edit':'Add New'?> Product</title>
	
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
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=($iProductId > 0)?'Edit Model':'Add New Model'?></span></h4>
					</div>
				</div>
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="index"><i class="icon-home2 position-left"></i> Dashboard</a></li>
						<li class="active"><i class="<?=($iProductId > 0)?'fa fa-pencil-square':'fa fa-plus-square'?> position-left"></i> <?=($iProductId > 0)?'Edit Product':'Add New Product'?></li>
					</ul>
				</div>
			</div>
			<!-- Page Content Start -->
			<div class="content">
				<div class="col-md-12">
					<form id="form-data">
						<input type="hidden" name="do_action" value="Add_Edit">
						<input type="hidden" name="iEditId" value="<?=$iProductId?>">
						<div class="panel panel-flat">
							<div class="panel-body">
								<fieldset>
									<div class="row">
										<div class="col-md-12">
											<div id="alert"></div>
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Category *</label>
														<select data-placeholder="Please Select" class="select2 required" name="iCategoryId" id="iCategoryId">
															<option value=""></option>
															<?php
																$sql = $gcr->gc_query("SELECT * FROM product_category ORDER BY vCategoryName ASC");
																while($row = $gcr->gc_fetch_array($sql)){
																	$selected = '';
																	if($row['iCategoryId'] == $iCategoryId){
																		$selected = 'selected';
																	}
																?>
																<option <?=$selected?> value="<?=$row['iCategoryId']?>"><?=$row['vCategoryName']?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Model Name *</label>
														<input type="text" class="form-control required" name="vName" value="<?=$vName?>" />
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-md-12 col-xs-12">
													<div class="form-group">
														<label>Description</label>
														<textarea class="form-control" name="tDescription" rows="4"><?=$tDescription?></textarea>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Product Image <small>(JPG - 540X540 in Pixel)</small></label>
														<input type="file" name="tImagePath" class="file-styled">
														<?php if($tImagePath != ''){ ?>
														<div class="pro_img_view">
															<img src="uploads/products/<?=$tImagePath?>" />
															<div class="btn btn-primary btn-sm" onclick="delete_pro_img(this,'<?=$iProductId?>','main','')"><i class="fa fa-trash"></i></div>
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Additional Image <small>(JPG - 540X540 in Pixel)</small></label>
														<input type="file" name="tAddiImagePath[]" class="file-styled" multiple>
														<?php
															if($tAddiImagePath != ''){
																foreach(explode(',',$tAddiImagePath) as $vImgName){
														?>
														<div class="pro_img_view">
															<img src="uploads/products/additional/<?=$vImgName?>" />
															<div class="btn btn-primary btn-sm" onclick="delete_pro_img(this,'<?=$iProductId?>','addi','<?=$vImgName?>')"><i class="fa fa-trash"></i></div>
														</div>
														<?php } } ?>
													</div>
												</div>
											
												<div class="clearfix"></div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Add in Latest Products</label>
														<br/>
														<label class="form-check-label">
															<input type="checkbox" name="eLatestProduct" class="form-check-input-styled" value="Yes" <?=($eLatestProduct == 'Yes')?'checked':''?>> Yes
														</label>
														
													</div>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label>Display Order</label>
														<input type="text" class="form-control number" name="iDisplayOrder" value="<?=$iDisplayOrder?>" />
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<fieldset>
											<legend class="text-semibold">Specifications</legend>
											<?php
												$i = 0;
												$sqlItems = $gcr->gc_query("SELECT * FROM product_specifications WHERE iProductId = ".$iProductId);
												$iItemTotal = $gcr->gc_affected_rows();
												while($rowItems = $gcr->gc_fetch_array($sqlItems)){ $i++;
											?>
											<input type="hidden" name="upd_<?=$i?>" value="<?=$rowItems['iId']?>" />
											<div class="itemPart">
												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-5 col-xs-12">
																<div class="form-group">
																	<?php if($i == 1){ ?><label>Name</label><?php } ?>
																	<input type="text" name="vName_<?=$i?>" value="<?=$rowItems['vName']?>" class="form-control" />
																</div>
															</div>
															<div class="col-md-6 col-xs-12">
																<div class="form-group">
																	<?php if($i == 1){?><label>Value</label><?php } ?>
																	<input type="text" name="vValue_<?=$i?>" value="<?=$rowItems['vValue']?>" class="form-control" />
																</div>
															</div>
															<div class="col-md-1 col-xs-1">
																<div class="form-group">
																	<?php if($i == 1){ ?><label>&nbsp;</label><?php } ?>
																	<button type="button" class="btn btn-primary btn-sm " onclick="removerow(this,<?=$rowItems['iId']?>)"><i class="fa fa-trash"></i> </button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php } ?>
											<span id="moreLineDiv"></span>
											</fieldset>
											<div class="col-md-6 col-xs-12">
												<div class="text-right"><button type="button" class="btn btn-primary btn-sm " onclick="get_specification()"><i class="fa fa-plus"></i> Add </button></div>
											</div>

											<input type="hidden" name="totalLines" id="totalLines" value="<?=$iItemTotal?>" />
											<div class="clearfix"></div>
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
			$('.form-check-input-styled').uniform();

		});
		
		function frmsubmit(){
			if($('#form-data').valid()){
				$('#btn_sub').attr('disabled',true);
				var formData = new FormData($("#form-data")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/product_action',
					data: formData,
					async: false,
					dataType: "json",
					success: function (data) {
						$('#btn_sub').attr('disabled',false);
						//$('html, body').animate({ scrollTop: 0 }, 'slow', );
						if(data.flg == 1){
							//$('#form-data')[0].reset();
							$('#alert').html('<div class="alert alert-success no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data.msg+'</a></div>');
							setTimeout(function(){
								window.location = 'product_manage';
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

		function get_specification(){
			var totalLines = $('#totalLines').val();
			lineNo = parseInt(totalLines) + 1;
			$('#totalLines').val(lineNo);
			$.ajax({
				type: 'POST',
				url: 'process/get_specification',
				data: {'lineNo':lineNo},
				async: false,
				success: function (data){
					$('#moreLineDiv').append(data);
					$('.select_'+lineNo).select2();
				},
			});
		}

		function removerow(th,iItemId){
			if(iItemId != ''){
				$.ajax({
					type: 'POST',
					url: 'process/product_action',
					data: {'do_action':'remove_specification','iId':iItemId},
					async: false,
					dataType: "json",
					success: function (data) {
						if(data.flg == 1){
							th.closest('.itemPart').remove();
						}
					},
					cache: false,
					//contentType: false,
					//processData: false
				});
			}else{
				th.closest('.itemPart').remove();
			}
		}

		function delete_pro_img(ths,iProductId,eType,vImageName){
			$.ajax({
				type: 'POST',
				url: 'process/product_action',
				data: {'do_action':'remove_image','iProductId':iProductId,'eType':eType,'vImageName':vImageName},
				async: false,
				dataType: "json",
				success: function (data) {
					ths.closest('.pro_img_view').remove();
				},
				cache: false,
				//contentType: false,
				//processData: false
			});
		}
	</script>
</body>
</html>