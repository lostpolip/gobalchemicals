<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$receiveid=$dbManagement->select("SELECT ReceiveID FROM productreceive ");
	$i = 0;
	$maxID = 0;
	if (mysqli_num_rows($receiveid) > 0) {
		while($row = mysqli_fetch_assoc($receiveid)) {
	        $ReceiveID[$i] = $row["ReceiveID"];

	        if ($maxID < str_replace('RE','',$ReceiveID[$i])) {
	        	$maxID = str_replace('RE','',$ReceiveID[$i]);
	        }
	        $i++;
		}
	}
	$newID = $maxID + 1;

	$product=$dbManagement->select("SELECT product.ProductAmount FROM product WHERE ProductID='".$_REQUEST['txtProductID']."'");
	if (mysqli_num_rows($product) > 0) {
	 	while($row = mysqli_fetch_assoc($product)) {
	        $ProductAmount = $row["ProductAmount"];
		}
	}

	$receive=$dbManagement->insert("INSERT INTO productreceive (ReceiveID,ReceiveDate, Lot, ExpiryDate, ReceiveAmount, StateReceive,PurchaseID)  VALUES ('RE' '".$newID."','".$_REQUEST['txtDateReceive']."','".$_REQUEST['txtLotReceive']."','".$_REQUEST['txtExpiryDate']."','".$_REQUEST['txtReceiveAmount']."','complete','".$_REQUEST['txtPurchasseID']."')");

	$totalProduct = $_REQUEST['txtReceiveAmount']+$ProductAmount;

	$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['txtProductID']."'");

	$dbManagement->update("UPDATE purchase SET StatePurchase='complete' WHERE PurchaseID ='".$_REQUEST['txtPurchasseID']."'");

	header( "location: /gobalchemicals/productReceive.php" );

?>
