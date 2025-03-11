<?php
	include("config.php");
	include("includes/session_auto_destroy.php");
	
	$page = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	
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
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Dashboard</span></h4>
					</div>
				</div>
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li class="active"><i class="icon-home2 position-left"></i> Dashboard</li>
					</ul>
				</div>
			</div>
			<!-- Page Content Start -->
			<div class="content">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-body">
							<div class="container-fluid">
								<?php /* ?>
								<div class="col-md-3">
									<?php
										$sql = mysqli_query($con,"select count(id) as total from project");
										$row = mysqli_fetch_array($sql);
										$total = $row['total'];
									?>
									<a href="project.php">
									<div class="content-group">
										<h5 class="text-semibold no-margin"><i class="fa fa-suitcase position-left"></i> <?=$total?></h5>
										<span class="text-muted text-size-small">Projects</span>
									</div>
									</a>
								</div>
								
								<div class="col-md-3">
									<?php
										$sql = mysqli_query($con,"select count(id) as total from activity");
										$row = mysqli_fetch_array($sql);
										$total = $row['total'];
									?>
									<a href="activity.php">
									<div class="content-group">
										<h5 class="text-semibold no-margin"><i class="fa fa-tags position-left"></i> <?=$total?></h5>
										<span class="text-muted text-size-small">Activity</span>
									</div>
									</a>
								</div>
								
								<div class="col-md-3">
									<?php
										$sql = mysqli_query($con,"select count(id) as total from comments");
										$row = mysqli_fetch_array($sql);
										$total = $row['total'];
									?>
									<a href="comments.php">
									<div class="content-group">
										<h5 class="text-semibold no-margin"><i class="fa fa-comments position-left"></i> <?=$total?></h5>
										<span class="text-muted text-size-small">Comments</span>
									</div>
									</a>
								</div>
								
								<div class="col-md-3">
									<?php
										$sql = mysqli_query($con,"select count(id) as total from subscription");
										$row = mysqli_fetch_array($sql);
										$total = $row['total'];
									?>
									<a href="subscription.php">
									<div class="content-group">
										<h5 class="text-semibold no-margin"><i class="fa fa-envelope position-left"></i> <?=$total?></h5>
										<span class="text-muted text-size-small">Subscriptions</span>
									</div>
									</a>
								</div>
								<?php */ ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Content -->
			<!-- Page Content End -->
			<?php include("includes/footer.php"); ?>
		</div>
	</div>
</body>
</html>