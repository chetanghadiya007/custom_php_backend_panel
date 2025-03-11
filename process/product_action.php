<?php
	include "../config.php";
	include("../includes/session_auto_destroy.php");
	
	extract($_POST);
	$returnArr = array();
	if($do_action == 'Add_Edit'){
		$vWhere = "";
		if(intval($iEditId) > 0){
			$vWhere = " AND iProductId <> '".$iEditId."'";
		}
		
		$gcr->gc_query("SELECT iProductId FROM products WHERE vName = '".$vName."'".$vWhere);
		if($gcr->gc_affected_rows() > 0){
			$returnArr['flg'] = 0;
			$returnArr['msg'] = 'Product name already exist.';
			echo json_encode($returnArr);
			exit;
		}

		$aInsArr = array();
		$aInsArr['iCategoryId'] = $iCategoryId;
		$aInsArr['vName'] = $vName;
		$aInsArr['tDescription'] = $tDescription;
		$aInsArr['eLatestProduct'] = $eLatestProduct;
		$aInsArr['iDisplayOrder'] = $iDisplayOrder;
		if(intval($iEditId) > 0){
			$iProductId = $iEditId;
			$gcr->gc_dbupdate("products",$aInsArr," WHERE iProductId = '".$iProductId."'");
			$returnArr['flg'] = 1;
			$returnArr['msg'] = 'Product has been updated successfully.';
		}else{
			$gcr->gc_dbinsert("products",$aInsArr);
			$iProductId = $gcr->gc_dbinsert_id();
			$returnArr['flg'] = 1;
			$returnArr['msg'] = 'Product has been added successfully.';
		}
		
		if($iProductId > 0){
			$fileName = 'tImagePath'; $destination = '../uploads/products/';
			if($_FILES[$fileName]["name"] != ''){
				$vFileName = $gcr->gc_upload_image($fileName,$destination,array('jpg','jpeg'));
				$gcr->gc_query("UPDATE products SET tImagePath = '".$vFileName."' WHERE iProductId = '".$iProductId."'");
			}

			$aAdditionalFiles = array();
			$fileName = 'tAddiImagePath';
			foreach($_FILES[$fileName]['tmp_name'] as $key=>$tmp_name) {
				$destination = '../uploads/products/additional/';
				$file_name=$_FILES[$fileName]["name"][$key];
				$file_tmp=$_FILES[$fileName]["tmp_name"][$key];
				$ext=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
				$newName = time().$key.".".$ext;
				$destination = $destination.$newName;
				if(in_array($ext,array('jpg','jpeg'))){
					move_uploaded_file($file_tmp, $destination);
					$aAdditionalFiles[] = $newName;
				}
			}

			if(!empty($aAdditionalFiles)){
				$gcr->gc_query("UPDATE products SET tAddiImagePath = '".implode(',',$aAdditionalFiles)."' WHERE iProductId = '".$iProductId."'");
			}
		}else{
			$error = get_error();
			$returnArr['flg'] = 0;
			$returnArr['msg'] = $error;
		}
		echo json_encode($returnArr);
	}else if($do_action == 'Delete'){
		$gcr->gc_query("DELETE FROM products WHERE iProductId='".$id."'");
	}else if($do_action == 'remove_specification'){
		$gcr->gc_query("DELETE FROM product_specifications WHERE iId='".$iId."'");
		echo json_encode(array("flg"=>1));
	}else if($do_action == 'remove_image'){
		if($eType == 'main'){
			$tImagePath = $gcr->gc_get_value("products","tImagePath"," WHERE iProductId = '".$iProductId."'");
			if($tImagePath != ''){
				$gcr->gc_query("UPDATE products SET tImagePath = '' WHERE iProductId = '".$iProductId."'");
				@unlink("../uploads/products/".$tImagePath);
			}
		}else if($eType == 'addi'){
			$tAddiImagePath = $gcr->gc_get_value("products","tAddiImagePath"," WHERE iProductId = '".$iProductId."'");
			if($tAddiImagePath != ''){
				$aImgArr = explode(',',$tAddiImagePath);
				$key = array_search($vImageName,$aImgArr);
				unset($aImgArr[$key]);
				$gcr->gc_query("UPDATE products SET tAddiImagePath = '".implode(',',$aImgArr)."' WHERE iProductId = '".$iProductId."'");
				@unlink("../uploads/products/additional/".$vImageName);
			}
		}
		echo json_encode(array("status"=>200));
	}
	if($do_action == 'Add_Edit'){
		$totalLines = intval($_POST['totalLines']);
		if($iProductId > 0 && $totalLines > 0){
			for($i=1;$i<=$totalLines;$i++){
				$iEditSpecId = intval($_POST["upd_".$i]);
				$vName = $_POST["vName_".$i];
				$vValue = $_POST["vValue_".$i];
				if($vName != ''){
					$aInsArr = array();
					$aInsArr['vName'] = $vName;
					$aInsArr['vValue'] = $vValue;
					if($iEditSpecId > 0){
						$gcr->gc_dbupdate("product_specifications",$aInsArr," WHERE iId='".$iEditSpecId."'");
					}else{
						$aInsArr['iProductId'] = $iProductId;
						$gcr->gc_dbinsert("product_specifications",$aInsArr);
					}
				}
			}
		}
	}
?>