<?php
	require 'dbManagement.php';
	date_default_timezone_set('Asia/Bangkok');
	$dbManagement = new dbManagement();

	$purchase=$dbManagement->select("SELECT PurchaseID FROM purchase ");
	$i = 0;
	$maxID = 0;
	if (mysqli_num_rows($purchase) > 0) {
		while($row = mysqli_fetch_assoc($purchase)) {
	        $PurchaseID[$i] = $row["PurchaseID"];

	        if ($maxID < str_replace('PO','',$PurchaseID[$i])) {
	        	$maxID = str_replace('PO','',$PurchaseID[$i]);
	        }
	        $i++;
		}
	}
	$newID = $maxID + 1;

	$dbManagement->insert("INSERT INTO purchase(PurchaseID, PurchaseDate, SupplierID, ProductID, PurchaseAmount, StatePurchase,PurchaseDetail) VALUES ('PO' '".$newID."','".date("Y-m-d")."','".$_REQUEST['supplierId']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtProductAmount']."','processing','".$_REQUEST['txtPurchaseDetail']."')");

	header( "location: /gobalchemicals/productPurchase.php" );

?>
