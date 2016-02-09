<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  aumphur WHERE ProvinceID = '".$_REQUEST['provinceID']."'");
	$ddProvince=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$AumphurID[$ddProvince] = $row["AumphurID"];
	    	$AumphurName[$ddProvince] = $row["AumphurName"];
	        $ddProvince++;
	    }
	}
	
	$Aumphur = [
		'ID'	=> $AumphurID,
		'name'	=> $AumphurName,
	];
	echo json_encode($Aumphur);

?>