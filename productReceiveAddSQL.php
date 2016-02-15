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
	
	$receive=$dbManagement->insert("INSERT INTO productreceive (ReceiveDate, ProductID, Lot, ExpiryDate, ReceiveAmount, State)  VALUES ('".$_REQUEST['txtDateReceive']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtLotReceive']."','".$_REQUEST['txtExpiryDate']."','".$_REQUEST['txtReceiveAmount']."','".$_REQUEST['txtReceiveState']."')");

	$totalProduct = $_REQUEST['txtReceiveAmount']+$ProductAmount[0];

	$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['ddProduct']."'");

	header( "location: /gobalchemicals/productReceive.php" );

?>
