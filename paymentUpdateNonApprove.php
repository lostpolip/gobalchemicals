<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE customer SET StateCredit='unlock' WHERE CustomerID='".$_REQUEST['CustomerID']."'");

	header( "location: /gobalchemicals/paymentCustomer.php" );
?>
