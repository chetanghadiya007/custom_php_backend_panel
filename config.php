<?php
	session_start();
	error_reporting(E_ERROR);
	
	$con = mysqli_connect("localhost","root","root","git_backend");
	//emerald
	//emerald
	//h&8cVqpi5cPsrfL8
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_query ($con,"set character_set_results='utf8'");
	mysqli_query($con,"SET NAMES utf8");
	date_default_timezone_set('Asia/Kolkata');
	// define('SITE_URL','');
	
	include("includes/class.php");
	$gcr = new gcr();

	define("SITE_MODE","LIVE");
?>