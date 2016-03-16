<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE orders SET State='processing' WHERE OrderID='".$_REQUEST['OrderID']."'");
	header( "location: /gobalchemicals/approveOrder.php" );
?>
