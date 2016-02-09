<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  aumphur WHERE ProvinceID = '".$_REQUEST['provinceID']."'");
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$AumphurID[$i] = $row["AumphurID"];
	    	$AumphurName[$i] = $row["AumphurName"];
	        $i++;
	    }
	}

	echo json_encode($AumphurName);

?>