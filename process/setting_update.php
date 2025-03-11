<?php
	include "../config.php";
	include("../includes/session_auto_destroy.php");
	extract($_POST);

	$aUpdArr = array();
	if($vPassword != ''){
		$aUpdArr['vPassword'] = md5($vPassword);
	}
	$aUpdArr['vName'] = $vName;
	$aUpdArr['vEmail'] = $vEmail;
	$aUpdArr['vMobileno'] = $vMobileno;
	$aUpdArr['tAddress'] = $tAddress;

	$iIsUpdate = $gcr->gc_dbupdate("users",$aUpdArr," WHERE iUserId = '".$_SESSION['user_id']."'");
	if(!$iIsUpdate){
		echo $error = $gcr->get_error();
	}else{
		echo '1';
	}
?>