<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE supplier SET SupplierName='".$_REQUEST['txtSupplierName']."',SupplierAddress='".$_REQUEST['txtSupplierAddress']."',SupplierDistrict='".$_REQUEST['txtSupplierDistrict']."',SupplierProvince='".$_REQUEST['txtSupplierProvince']."',SupplierZipcode='".$_REQUEST['txtSupplierZipcode']."',SupplierTel='".$_REQUEST['txtSupplierTel']."',SupplierEmail='".$_REQUEST['txtSupplierEmail']."' WHERE SupplierID='".$_REQUEST['txtSupplierID']."'");
	 header( "location: /gobalchemicals/supplier.php" );

?>