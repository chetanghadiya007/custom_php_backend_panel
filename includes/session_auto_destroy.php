<?php
	$logout_redirect_url = "login"; // Set logout URL
	if(!isset($_SESSION['user_id'])) {
		header("location: $logout_redirect_url");
		exit();
	}
	
	$timeout = 2280; // Set timeout minutes
	if (isset($_SESSION['start_time'])) {
		$elapsed_time = time() - $_SESSION['start_time'];
		if ($elapsed_time >= $timeout) {
			session_destroy();
			header("Location: $logout_redirect_url");
		}
	}
	$_SESSION['start_time'] = time();
?>