<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	
	$result= $dbManagement->select("SELECT * FROM district WHERE AumphurID = '".$_REQUEST['districtID']."'");

	$ddSubDistrict=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$DistrictID[$ddSubDistrict] = $row["DistrictID"];
	    	$DistrictName[$ddSubDistrict] = $row["DistrictName"];
	        $ddSubDistrict++;
	    }
	}
	$District = [
		'ID'	=> $DistrictID,
		'name'	=> $DistrictName,
	];
	echo json_encode($District);



?>
