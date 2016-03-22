<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE customer SET StateCredit='lock' WHERE CustomerID='".$_REQUEST['CustomerID']."'");

	header( "location: /gobalchemicals/paymentCustomer.php" );
?>
