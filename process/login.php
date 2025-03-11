<?php
	include "../config.php";
	
	$name = $_REQUEST['name'];
	$password = md5($_REQUEST['password']);
	$date =  $gcr->getdatetime();
	$ip =  $gcr->get_client_ip();
	// $gcr->gc_query("UPDATE users SET vPassword = '".$password."'");
	$sql = $gcr->gc_query("
		SELECT
			usr.iUserId,usr.vName
		FROM
			users as usr
		WHERE
			usr.vUserName = '".$name."' AND
			BINARY usr.vPassword = '".$password."'
	");
	$num = $gcr->gc_affected_rows();
	if($num > 0){
		$row = $gcr->gc_fetch_array($sql);
		
		$aUpdArr = array();
		$aUpdArr['dLastLoginDate'] = $date;
		$aUpdArr['vLastIp'] = $ip;
		$gcr->gc_dbupdate("users",$aUpdArr," WHERE iUserId = '".$row['iUserId']."'");

		$_SESSION['user_id'] = $row['iUserId'];
		$_SESSION['user_name'] = $row['vName'];
		$_SESSION['start_time'] = time();

		echo $num;
	}else{
		echo "invalid username or passwor.";
	}
	
?>