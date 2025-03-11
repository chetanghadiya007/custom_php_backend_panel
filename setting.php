<?php
	include("config.php");
	include("includes/session_auto_destroy.php");
	
	$page = "setting";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Profile</title>
	
	<!-- Global stylesheets -->
	<link href="assets/fonts/google/Roboto.css" rel="stylesheet" type="text/css">
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
</head>
<body class=" pace-done">
	<?php include("includes/topbar.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include("includes/siderbar.php"); ?>
			<div class="page-header">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">My Profile</span></h4>
					</div>
				</div>
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="index.php"><i class="icon-home2 position-left"></i> Dashboard</a></li>
						<li class="active"><i class="fa fa-cog position-left"></i> My Profile</li>
					</ul>
				</div>
			</div>
			<script>
				function frmsubmit(){
					var isvalid_all = "";
					$('.frm_required').each(
						function(index){  
							var input = $(this);
							if(input.val() == 0 || input.val() == null || input.val() == ""){
								input.css({"border":"1px solid #FFB9BD"});
								input.focus();
								isvalid_all = 0;
								return false;
							}else{
								input.css({"border":"1px solid #f7f7f7"});
							}
						}
					);
					if(isvalid_all !== 0){
						$('#btn_sub').attr('disabled',true);
						var formData = new FormData($("#form-setting")[0]);
						$.ajax({
							type: 'POST',
							url: 'process/setting_update.php',
							data: formData,
							async: false,
							success: function (data) {
								$('#btn_sub').attr('disabled',false);
								$('html, body').animate({ scrollTop: 0 }, 'slow', );
								if(data == "1"){
									$('#form-setting')[0].reset();
									$('#alert').html('<div class="alert alert-success no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">Setting updated successfully !</a></div>');
								}else{
									$('#alert').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data+'</a></div>');
								}
							},
							cache: false,
							contentType: false,
							processData: false
						});
					}
				}
			</script>
			<!-- Page Content Start -->
			<div class="content">
				<div class="col-md-12">
					<form id="form-setting">
						<div class="panel panel-flat">
							<div class="panel-body">
								<?php
									$sql = $gcr->gc_query("SELECT * FROM users WHERE iUserId = '".$_SESSION['user_id']."'");
									$row = $gcr->gc_fetch_array($sql);
								?>
								<div class="row">
									<fieldset>
										<legend class="text-semibold">My Profile</legend>
										<div id="alert" class="col-xs-12"></div>
										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label>User Name</label>
												<input type="text" name="vUserName" value="<?=$row['vUserName']?>" placeholder="" class="form-control" disabled="disable" />
											</div>
										</div>
										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="vPassword" class="form-control required" placeholder="Re-Enter password or make it clear" />
											</div>
										</div>
										<div class="col-md-4 col-xs-12">
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="vName" value="<?=$row['vName']?>" placeholder="" class="form-control" />
											</div>
										</div>
										<div class="col-md-4 col-xs-12">
											<div class="form-group">
												<label>Email</label>
												<input type="text" name="vEmail"  value="<?=$row['vEmail']?>" placeholder="" class="form-control" />
											</div>
										</div>
										<div class="col-md-4 col-xs-12">
											<div class="form-group">
												<label>Mobile No.</label>
												<input type="text" name="vMobileno" value="<?=$row['vMobileno']?>" placeholder="" class="form-control" />
											</div>
										</div>
										<div class="col-md-8 col-xs-12">
											<div class="form-group">
												<label>Address </label>
												<textarea type="text" placeholder="Address" name="tAddress" class="form-control" ><?=$row['tAddress']?></textarea>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6 col-xs-12">
											<button type="button" id="btn_sub" class="btn btn-primary" onclick="frmsubmit()">Save <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</fieldset>
									
									
									<?php /*
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold">Details</legend>
											<div class="form-group">
												<label class="text-bold">Last Login Time :</label>
												<?=date("d-M-Y g:i A",strtotime($row['dLastLoginDate']))?>
											</div>
											<div class="form-group">
												<label class="text-bold">Last Login IP Address :</label>
												<?=$row['vLastIp']?>
											</div>
										</fieldset>
									</div>
									<?php */ ?>
								</div>
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
		$('#form-settings').keypress(function(e){
			if (e.which == 13 ){
				frmsubmit();
			}
		});
	</script>
</body>
</html>