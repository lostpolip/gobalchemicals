<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$aumphur = $dbManagement->select("SELECT * FROM  aumphur WHERE ProvinceID = '".$_REQUEST['provinceID']."'");
	// $district = $dbManagement->select("SELECT * FROM  district WHERE AumphurID = '".$_REQUEST['districtID']."'");
	$ddProvince=0;
	if (mysqli_num_rows($aumphur) > 0) {
	    while($row = mysqli_fetch_assoc($aumphur)) {
	    	$AumphurID[$ddProvince] = $row["AumphurID"];
	    	$AumphurName[$ddProvince] = $row["AumphurName"];
	        $ddProvince++;
	    }
	}

	$ddAumphur=0;
	if (mysqli_num_rows($district) > 0) {
	    while($row = mysqli_fetch_assoc($district)) {
	    	$DistrictID[$ddAumphur] = $row["DistrictID"];
	    	$DistrictName[$ddAumphur] = $row["DistrictName"];
	        $ddAumphur++;
	    }
	}	

	echo json_encode($AumphurName);
	echo json_encode($DistrictName);

?>