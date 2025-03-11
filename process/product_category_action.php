<?php
	include "../config.php";
	include("includes/session_auto_destroy.php");

	extract($_POST);
	foreach($_POST as $key=>$val){
		$val = $gcr->add_security($val);
		$_POST[$key] = $val;
	}
	
	$vCategoryName = $_POST['vCategoryName'];
	include("../includes/session_auto_destroy.php");
	
	$returnArr = array();
	if($do_action == 'Add_Edit'){
		$vWhere = "";
		if($iEditId > 0){
			$vWhere = " AND iCategoryId <> '".$iEditId."'";
		}
		$gcr->gc_query("SELECT iCategoryId FROM product_category WHERE vCategoryName = '".$vCategoryName."'".$vWhere);
		if($gcr->gc_affected_rows() > 0){
			$returnArr['flg'] = 0;
			$returnArr['msg'] = 'Category name already exist.';
			echo json_encode($returnArr);
			exit;
		}
		
		$aInsArr = array();
		$aInsArr['vCategoryName'] = $vCategoryName;
		$aInsArr['iDisplayOrder'] = $iDisplayOrder;

		$fileName = 'tImagePath'; $destination = '../uploads/category/';
		if($_FILES[$fileName]["name"] != ''){
			$vFileName = $gcr->gc_upload_image($fileName,$destination,array('jpg','jpeg'));
			$aInsArr['tImagePath'] = $vFileName;
		}

		if($iEditId > 0){
			$iCategoryId = $iEditId;
			$gcr->gc_dbupdate("product_category",$aInsArr," WHERE iCategoryId = '".$iCategoryId."'");
			$returnArr['flg'] = 1;
			$returnArr['msg'] = 'Category has been updated successfully.';
		}else{
			$iCategoryId = $gcr->gc_dbinsert("product_category",$aInsArr);
			$returnArr['flg'] = 1;
			$returnArr['msg'] = 'Category has been added successfully.';
		}
		
		
		if(!$iCategoryId){
			$error = get_error();
			$returnArr['flg'] = 0;
			$returnArr['msg'] = $error;
		}
		echo json_encode($returnArr);
	}else if($do_action == 'Delete'){
		$aUpdArr = array();
		$aUpdArr['eStatus'] = 'd';
		$gcr->gc_dbupdate("product_category",$aUpdArr," WHERE iCategoryId = '".$id."'");
	}
?>