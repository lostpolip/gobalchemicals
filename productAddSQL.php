
<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->insert("INSERT INTO product (ProductName, ProductTypeID, BrandID, SupplierID, ProductWeight, 
	Cost, Price,ProductAmount) VALUES ('".$_REQUEST['txtProductName']."','".$_REQUEST['drtypeProduct']."',
	'".$_REQUEST['drBrandsProduct']."','".$_REQUEST['drSupplierProduct']."','".$_REQUEST['txtProductWeight']."',
	'".$_REQUEST['txtCost']."','".$_REQUEST['txtPrice']."','".$_REQUEST['txtProductAmount']."')");

header( "location: /gobalchemicals/product.php" );

?>
