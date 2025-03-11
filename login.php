<?php
	//include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Administrator </title>
	
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
	<script type="text/javascript" src="assets/js/plugins/forms/editable/editable.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->
</head>
<body class="login-container">
	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
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
									input.css({"border":"1px solid #dddddd"});
								}
							}
						);
						
						if(isvalid_all !== 0){
							var formData = new FormData($("#form-signin")[0]);
							$.ajax({
								type: 'POST',
								url: 'process/login',
								type: 'POST',
								data: formData,
								async: false,
								success: function (data) {
									if(data == "1"){
										window.location = "index";
									}else{
										$('#alert_login').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data+'</a>.</div>');
									}
								},
								cache: false,
								contentType: false,
								processData: false
							});
						}
					}
				</script>
				<!-- Simple login form -->
				<form id="form-signin">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
						</div>
						<div id="alert_login"></div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control frm_required" name="name" id="name" placeholder="User Name">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control frm_required" name="password" id="password" placeholder="Password">
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary btn-block" onclick="frmsubmit()">Sign in <i class="icon-circle-right2 position-right"></i></button>
						</div>
						<!--
						<div class="text-center">
							<a href="forgotpassword.php">Forgot password?</a>
						</div>
						-->
					</div>
				</form>
				<!-- /simple login form -->
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<?php include("includes/footer.php"); ?>
	
	<script>
		$('#form-signin').keypress(function(e){
			if (e.which == 13 ){
				frmsubmit();
			}
		});
		$(function() {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
			});
		});
	</script>
</body>
</html>