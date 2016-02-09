
<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->insert("INSERT INTO supplier (SupplierName, SupplierAddress, SupplierDistrict, SupplierProvince, 
	SupplierZipcode, SupplierTel, SupplierEmail) VALUES ('".$_REQUEST['txtSupplierName']."','".$_REQUEST['txtSupplierAddress']."',
	'".$_REQUEST['txtSupplierDistrict']."','".$_REQUEST['txtSupplierProvince']."','".$_REQUEST['txtSupplierZipcode']."',
	'".$_REQUEST['txtSupplierTel']."','".$_REQUEST['txtSupplierEmail']."')");

header( "location: /gobalchemicals/supplier.php" );
?>