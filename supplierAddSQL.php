
<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->insert("INSERT INTO supplier (SupplierName, SupplierAddress, SupplierDistrict, SupplierProvince, 
	SupplierZipcode, SupplierTel, SupplierEmail,SupplierAumphur,StateSupplier) VALUES ('".$_REQUEST['txtSupplierName']."','".$_REQUEST['txtSupplierAddress']."',
	'".$_REQUEST['txtSupplierDistrict']."','".$_REQUEST['txtSupplierProvince']."','".$_REQUEST['txtSupplierZipcode']."',
	'".$_REQUEST['txtSupplierTel']."','".$_REQUEST['txtSupplierEmail']."','".$_REQUEST['txtSupplierAumphur']."','confirm')");

header( "location: /gobalchemicals/supplier.php" );
?>