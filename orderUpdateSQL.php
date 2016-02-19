<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE orders SET State='complete' WHERE OrderID='".$_REQUEST['orderID']."'");
	print_r("UPDATE orders SET State='complete' WHERE OrderID='".$_REQUEST['orderID']."'");
	header( "location: /gobalchemicals/order.php" );
?>
