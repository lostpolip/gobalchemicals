<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->update("UPDATE orders SET State='processing',ExtendedPrice='".$_REQUEST['totalOther']."',TotalTransport ='".$_REQUEST['totalTransaction']."' WHERE OrderID='".$_REQUEST['orderID']."'");
	
	header( "location: /gobalchemicals/order.php" );
?>
