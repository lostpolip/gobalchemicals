<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
$dbManagement->insert("INSERT INTO `purchase`(`PurchaseID`, `PurchaseDate`, `SupplierID`, `ProductID`, `PurchaseAmount`, `State`, `ProductTypeID`, `BrandID`, `PurchaseDetail`) VALUES ('".$_REQUEST['txtPurchaseID']."','".$_REQUEST['txtDatePurchase']."','".$_REQUEST['ddSupplier']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtProductAmount']."','".$_REQUEST['txtPurchaseState']."','".$_REQUEST['ddProductType']."','".$_REQUEST['ddBrandName']."','".$_REQUEST['txtPurchaseDetail']."')");

header( "location: /gobalchemicals/productPurchase.php" );

?>
