<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$product=$dbManagement->select("SELECT product.ProductAmount FROM product WHERE ProductID='".$_REQUEST['ddProduct']."'");
	 			$ddProduct = 0;
	 				if (mysqli_num_rows($product) > 0) {
	 		   			 while($row = mysqli_fetch_assoc($product)) {
	 				        $ProductAmount[$ddProduct] = $row["ProductAmount"];
	 				        $ddProduct++;
	 		    		}
	 				}
	

	$dbManagement->update(" UPDATE productreceive SET ReceiveDate='".$_REQUEST['txtDateReceive']."',ProductID='".$_REQUEST['ddProduct']."',Lot='".$_REQUEST['txtLotReceive']."',ExpiryDate='".$_REQUEST['txtExpiryDate']."',ReceiveAmount='".$_REQUEST['txtReceiveAmount']."',State='".$_REQUEST['txtReceiveState']."' WHERE ReceiveID='".$_REQUEST['txtReceiveID']."'");

	$totalProduct = $_REQUEST['txtReceiveAmount']+$ProductAmount[0];

	$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['ddProduct']."'");
	
	header( "location: /gobalchemicals/productReceive.php" );
?>
