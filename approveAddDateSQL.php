<?php

	require 'dbManagement.php';
	$dbManagement = new dbManagement();	
	$dbManagement->update("UPDATE claim SET ClaimSendDate='".$_REQUEST['claimDate']."' WHERE ClaimID='".$_REQUEST['claimid']."'");

	$product=$dbManagement->select("SELECT product.ProductAmount FROM product WHERE ProductID='".$_REQUEST['productId']."'");
		$i=0;
		if (mysqli_num_rows($product) > 0) {
				 while($row = mysqli_fetch_assoc($product)) {
		        $ProductAmount[$i] = $row["ProductAmount"];
		        $i++;
			}
		}
		

	$claim=$dbManagement->select("SELECT claim.ClaimAmount FROM claim WHERE ClaimID='".$_REQUEST['claimid']."'");
	$i=0;
	if (mysqli_num_rows($claim) > 0) {
			 while($row = mysqli_fetch_assoc($claim)) {
	        $ClaimAmount[$i] = $row["ClaimAmount"];
	        $i++;
		}
	}

	$totalProduct = $ProductAmount[0]-$ClaimAmount[0];

	$upProduct=$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['productId']."'");

	header( "location: /gobalchemicals/approveClaim.php" );
?>