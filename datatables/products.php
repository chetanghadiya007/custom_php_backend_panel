<?php
	include("../config.php");
	include("../includes/functions.php");
	include("../includes/session_auto_destroy.php");

	$requestData= $_REQUEST;
	$columns = array( 
		0 => '', 
		1 => '',
		2 => 'vCategoryName',
		3 => 'vName',
		4 => 'iDisplayOrder',
	);

	$sql = '';
	$SINGLESELECTED = "SELECT pro.iProductId ";
	$SELECTED = "
		SELECT
			pro.iProductId,pro.tImagePath,cat.vCategoryName,pro.vName,pro.iDisplayOrder
	";
	
	$sql.="
		FROM
			products as pro
			LEFT JOIN product_category as cat ON cat.iCategoryId = pro.iCategoryId
		WHERE
			1=1
	";
	
	if(!empty($requestData['search']['value'])){
		$searchStr = trim($requestData['search']['value']);
		$sql.=" AND (
			cat.vCategoryName LIKE '%".$searchStr."%' OR
			pro.vName LIKE '%".$searchStr."%'
		)";
	}
	
	$sqlTot = $gcr->gc_query($SINGLESELECTED.$sql);
	$totalData = $gcr->gc_affected_rows($sqlTot);
			
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
	$sqlStr = $gcr->gc_query($SELECTED.$sql);
	// echo $SELECTED.$sql; exit;
	$data = array();
	$i = 0;
	while($row = $gcr->gc_fetch_array($sqlStr)){
		$iProductId = $row['iProductId'];
		
		$i++;
		$nestedData=array();
		$nestedData[] = $i;
		$nestedData[] = '<img src="uploads/products/'.$row['tImagePath'].'" style="height:100px" />';
		$nestedData[] = $row["vCategoryName"];
		$nestedData[] = $row["vName"];
		$nestedData[] = $row["iDisplayOrder"];
		
		$editBtn = '<a href="product_add?id='.$iProductId.'" title="Edit"><span><i class="fa fa-pencil-square ol_body"></i></span></a>';
		$deleteBtn = ' &nbsp;<span class="delete" onclick="deleterow('.$iProductId.')"><i class="fa fa-trash ol_body"></i></span>';
		
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
