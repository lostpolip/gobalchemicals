<?php
require 'dbManagement.php';
date_default_timezone_set('Asia/Bangkok');
$dbManagement = new dbManagement();
$dbManagement->insert("INSERT INTO `purchase`(`PurchaseID`, `PurchaseDate`, `SupplierID`, `ProductID`, `PurchaseAmount`, `State`,`PurchaseDetail`) VALUES ('".$_REQUEST['txtPurchaseID']."','".date("Y-m-d")."','".$_REQUEST['ddSupplier']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtProductAmount']."','".$_REQUEST['txtPurchaseState']."','".$_REQUEST['txtPurchaseDetail']."')");

header( "location: /gobalchemicals/productPurchase.php" );

?>
