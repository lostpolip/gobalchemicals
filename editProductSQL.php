<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	copy($_FILES["imageProduct"]["tmp_name"], '../gobalchemicals/images/' . $_FILES["imageProduct"]["name"]);
	
	$dbManagement->update("UPDATE product SET ProductName='".$_REQUEST['txtProduct']."', ProductTypeID='".$_REQUEST['drtypeProduct']."', 
			BrandID='".$_REQUEST['drBrandsProduct']."', SupplierID='".$_REQUEST['drSupplierProduct']."',ProductWeight='".$_REQUEST['txtProductWeight']."',Cost='".$_REQUEST['txtCost']."',Price='".$_REQUEST['txtPrice']."',ImageProduct='".$_FILES["imageProduct"]["name"]."' WHERE ProductID='".$_REQUEST['txtProductID']."'");
	
	header( "location: /gobalchemicals/product.php" );
?>
