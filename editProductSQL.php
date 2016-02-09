<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE product SET ProductName='".$_REQUEST['txtProduct']."', ProductTypeID='".$_REQUEST['drtypeProduct']."', 
			BrandID='".$_REQUEST['drBrandsProduct']."', SupplierID='".$_REQUEST['drSupplierProduct']."',ProductWeight='".$_REQUEST['txtProductWeight']."',Cost='".$_REQUEST['txtCost']."',Price='".$_REQUEST['txtPrice']."' WHERE ProductID='".$_REQUEST['txtProductID']."'");
	header( "location: /gobalchemicals/product.php" );
?>
