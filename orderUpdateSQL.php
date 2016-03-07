<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$totalPrice=$_REQUEST['totalOther'];
	$extendedPrice=str_replace(',', '', $totalPrice);
	
	$dbManagement->update("UPDATE orders SET State='processing',ExtendedPrice='".$extendedPrice."',TotalTransport ='".$_REQUEST['totalTransaction']."' WHERE OrderID='".$_REQUEST['orderID']."'");

	header( "location: /gobalchemicals/order.php" );
?>
