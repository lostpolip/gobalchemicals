<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$orderSendDate = $_REQUEST['orderDate'];
	$dbManagement->update("UPDATE orders SET State='processing', OrderSendDate='".$orderSendDate."' WHERE OrderID='".$_REQUEST['Orderid']."'");
	
	header( "location: /gobalchemicals/approveOrder.php" );
?>
