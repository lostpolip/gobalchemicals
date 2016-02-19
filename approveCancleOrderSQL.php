<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE orders SET State='cancle' WHERE OrderID='".$_REQUEST['OrderID']."'");
	header( "location: /gobalchemicals/approveOrder.php" );
?>
