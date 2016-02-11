<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->insert("INSERT INTO productreceive (ReceiveDate, ProductID, Lot, ExpiryDate, ReceiveAmount, State)  VALUES ('".$_REQUEST['txtDateReceive']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtLotReceive']."','".$_REQUEST['txtExpiryDate']."','".$_REQUEST['txtReceiveAmount']."','".$_REQUEST['txtReceiveState']."')");

	header( "location: /gobalchemicals/productReceive.php" );
?>
