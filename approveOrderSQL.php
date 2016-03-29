<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();	
	$orderid = $_REQUEST['Orderid'];
	$dbManagement->update("UPDATE orders SET State='processing' WHERE OrderID='".$orderid."'");
	header( "location: /gobalchemicals/approveOrder.php" );
?>
