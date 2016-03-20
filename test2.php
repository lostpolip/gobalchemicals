<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$payment=$_REQUEST['paymentType'];
	$customerid=$_REQUEST['paymentCustomerID'];
	$orderid=$_REQUEST['orderID'];
	print_r($payment); exit;

	// $dbManagement->update("UPDATE customer SET StateCredit='".$cradit."' WHERE CustomerID='".$_REQUEST['customerid']."'");
	// $dbManagement->update("UPDATE orders SET StatePayment='".$payment."' WHERE OrderID='".$_REQUEST['orderid']."'");

	header( "location: /gobalchemicals/paymentCustomer.php" );
?>
