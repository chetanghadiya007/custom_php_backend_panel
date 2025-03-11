<?php
	include("../config.php");
	include("../includes/session_auto_destroy.php");
	
	$requestData= $_REQUEST;
	$columns = array( 
		0 => '',
		1 => '',
		2 => 'vCategoryName',
		3 => 'iDisplayOrder',
	);

	$sql = '';
	$SINGLESELECTED = "SELECT cm.iCategoryId ";
	$SELECTED = "
		SELECT
			cm.iCategoryId,cm.vCategoryName,cm.tImagePath,iDisplayOrder
	";
	
	$sql.="
		FROM
			product_category as cm
		WHERE
			eStatus = 'y'
	";
	
	if(!empty($requestData['search']['value'])){
		$searchStr = trim($requestData['search']['value']);
		$sql.=" AND (cm.vCategoryName LIKE '%".$searchStr."%')";
	}
	
	$sqlTot = $gcr->gc_query($SINGLESELECTED.$sql);
	$totalData = $gcr->gc_affected_rows();
			
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
	$sqlStr = $gcr->gc_query($SELECTED.$sql);
	//echo $SELECTED.$sql; exit;
	$data = array();
	$i = 0;
	while($row = $gcr->gc_fetch_array($sqlStr)){
		$iCategoryId = $row['iCategoryId'];
		
		$i++;
		$nestedData=array();
		$nestedData[] = $i;
		$nestedData[] = '<img src="uploads/category/'.$row['tImagePath'].'" style="height:100px" />';
		$nestedData[] = $row["vCategoryName"];
		$nestedData[] = $row["iDisplayOrder"];
		
		$editBtn = '<a href="category_add?id='.$iCategoryId.'" title="Edit"><span><i class="fa fa-pencil-square ol_body"></i></span></a>';
		$deleteBtn = ' &nbsp;<span class="delete" onclick="deleterow('.$iCategoryId.')"><i class="fa fa-trash ol_body"></i></span>';
		
		$nestedData[] = $editBtn.$deleteBtn;
		$data[] = $nestedData;
	} 

	$json_data = array(
		"draw"            => intval( $requestData['draw'] ),
		"recordsTotal"    => intval( $totalData ),
		"recordsFiltered" => intval( $totalData ),
		"data"            => $data
	);
	echo json_encode($json_data); 
?>
