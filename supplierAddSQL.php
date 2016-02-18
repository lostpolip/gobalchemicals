
<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->insert("INSERT INTO supplier (SupplierName, SupplierAddress, SupplierDistrict, SupplierProvince, 
	SupplierZipcode, SupplierTel, SupplierEmail,SupplierAumphur) VALUES ('".$_REQUEST['txtSupplierName']."','".$_REQUEST['txtSupplierAddress']."',
	'".$_REQUEST['txtSupplierDistrict']."','".$_REQUEST['txtSupplierProvince']."','".$_REQUEST['txtSupplierZipcode']."',
	'".$_REQUEST['txtSupplierTel']."','".$_REQUEST['txtSupplierEmail']."','".$_REQUEST['txtSupplierAumphur']."')");

header( "location: /gobalchemicals/supplier.php" );
?>