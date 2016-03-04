<?php

require 'dbManagement.php';
$dbManagement = new dbManagement();	

	$claim=$dbManagement->select("SELECT * FROM claimdetail 
								  JOIN product ON claimdetail.ProductID=product.ProductID
								  WHERE ClaimID='".$_REQUEST['ClaimID']."'");
	$i=0;
	if (mysqli_num_rows($claim) > 0) {
			 while($row = mysqli_fetch_assoc($claim)) {
	        $ClaimID[$i] = $row["ClaimID"];
	        $ClaimAmount[$i] = $row["ClaimAmount"];
	        $ProductID[$i] = $row["ProductID"];
	        $ProductAmount[$i] = $row["ProductAmount"];
	        $i++;
		}
	}
	print_r($ProductID);

	// $totalProduct = $ProductAmount[0]-$ClaimAmount[0];

	// $upProduct=$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['productId']."'");

	// $dbManagement->update("UPDATE claim SET StateClaim='confirm' WHERE ClaimID='".$_REQUEST['ClaimID']."'");

	// header( "location: /gobalchemicals/approveClaim.php" );
?>