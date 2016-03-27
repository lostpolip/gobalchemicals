<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	
	$orderSenddate = $_REQUEST['ordersenddate'];
	$orderid = $_REQUEST['Orderid'];

	$dbManagement->update("UPDATE orders SET State='processing',OrderSendDate='".$orderSenddate."' WHERE OrderID='".$orderid."'");

	header( "location: /gobalchemicals/approveOrder.php" );
?>
