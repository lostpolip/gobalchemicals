<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->update("UPDATE supplier SET StateSupplier='cancle' WHERE SupplierID='".$_REQUEST['SupplierID']."'");

	header( "location: /gobalchemicals/supplier.php" );

?>