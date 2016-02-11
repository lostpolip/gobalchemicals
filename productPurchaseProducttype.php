<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	
	$result= $dbManagement->select("SELECT * FROM product 
												JOIN producttype ON product.ProductTypeID=producttype.ProductTypeID
												JOIN brand ON product.BrandID=brand.BrandID
												JOIN supplier ON product.SupplierID=supplier.SupplierID
												WHERE ProductID = '".$_REQUEST['productID']."'");

	$ddProduct=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$ProductID[$ddProduct] = $row["ProductID"];
			$ProductName[$ddProduct] = $row["ProductName"];
			$ProductTypeID[$ddProduct] = $row["ProductTypeID"];
			$ProductTypeName[$ddProduct] = $row["ProductTypeName"];
			$BrandID[$ddProduct] = $row["BrandID"];
			$BrandName[$ddProduct] = $row["BrandName"];
	    	$SupplierID[$ddProduct] = $row["SupplierID"];
	    	$SupplierName[$ddProduct] = $row["SupplierName"];
	    	$SupplierEmail[$ddProduct] = $row["SupplierEmail"];
	        $ddProduct++;
	    }
	}
	$Product = [
		'ID'	=> $ProductID,
		'nameProductType'	=> $ProductTypeName,
		'nameBrand'	=> $BrandName,
		'nameSupplier'	=> $SupplierName,
		'email'	=> $SupplierEmail,
	];
	echo json_encode($Product);



?>
