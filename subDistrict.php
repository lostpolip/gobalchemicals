<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	
	$result= $dbManagement->select("SELECT * FROM zipcode WHERE DistrictID = '".$_REQUEST['subDistrictID']."'");

	$ddZipcode=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$ZipcodeID[$ddZipcode] = $row["ZipcodeID"];
	    	$Zipcode[$ddZipcode] = $row["Zipcode"];
	        $ddZipcode++;
	    }
	}
	$zipcode = [
		'ID'	=> $ZipcodeID,
		'name'	=> $Zipcode,
	];
	echo json_encode($zipcode);
?>
