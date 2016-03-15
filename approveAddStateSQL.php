<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM product ");
		$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $i++;
			    }
			}
	$claimid = explode(',',$_REQUEST['claimIdAll']);
	$totalunit = explode(',',$_REQUEST['totalUnit']);
	foreach ($claimid as $key => $value) {
		$temp = $ProductAmount[array_search($claimid[$key],$ProductID)] - $totalunit[$key];

		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$claimid[$key]."'");

	}	

	$dbManagement->update("UPDATE claim SET StateClaim='confirm' WHERE ClaimID='".$_REQUEST['claimId']."'");

		header( "location: /gobalchemicals/approveClaim.php" );
?>