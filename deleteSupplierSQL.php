<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->delete("DELETE FROM supplier WHERE SupplierID='".$_REQUEST['SupplierID']."'");

	header( "location: /gobalchemicals/supplier.php" );

?>