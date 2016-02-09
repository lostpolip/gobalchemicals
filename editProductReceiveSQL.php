<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE productreceive SET ReceiveDate='".$_REQUEST['txtDateReceive']."',ProductID='".$_REQUEST['ddProduct']."',Lot='".$_REQUEST['txtLotReceive']."',ExpiryDate='".$_REQUEST['txtExpiryDate']."',ReceiveAmount='".$_REQUEST['txtReceiveAmount']."',State='".$_REQUEST['']."',ProductTypeID='".$_REQUEST['ddProductType']."',SupplierID='".$_REQUEST['ddSupplier']."',BrandID='".$_REQUEST['ddBrandName']."' WHERE ReceiveID='".$_REQUEST['txtReceiveID']."'");
	header( "location: /gobalchemicals/product.php" );
?>
