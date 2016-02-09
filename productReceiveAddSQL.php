<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->insert("INSERT INTO productreceive (ReceiveDate, ProductID, Lot, ExpiryDate, ReceiveAmount, State)  VALUES ('".$_REQUEST['txtDateReceive']."','".$_REQUEST['productid']."','".$_REQUEST['txtLotReceive']."','".$_REQUEST['txtExpiryDate']."','".$_REQUEST['txtReceiveAmount']."','".$_REQUEST['txtReceiveState']."')");

	print_r($dbManagement);

	// header( "location: /gobalchemicals/productReceive.php" );
?>
