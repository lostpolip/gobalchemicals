
<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
copy($_FILES["imageProduct"]["tmp_name"], '../gobalchemicals/images/' . $_FILES["imageProduct"]["name"]);

$dbManagement->insert("INSERT INTO product(ProductName, ProductTypeID, BrandID, SupplierID, ProductWeight, Cost, Price, ProductAmount, ImageProduct) VALUES ('".$_REQUEST['txtProductName']."','".$_REQUEST['drtypeProduct']."',
'".$_REQUEST['drBrandsProduct']."','".$_REQUEST['drSupplierProduct']."','".$_REQUEST['txtProductWeight']."',
'".$_REQUEST['txtCost']."','".$_REQUEST['txtPrice']."','".$_REQUEST['txtProductAmount']."','".$_FILES["imageProduct"]["name"]."')");

header( "location: /gobalchemicals/product.php" );

?>
