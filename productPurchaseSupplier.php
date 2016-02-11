<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	
	$result= $dbManagement->select("SELECT * FROM supplier WHERE SupplierID = '".$_REQUEST['supplierID']."'");

	$ddSubDistrict=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$SupplierID[$ddSubDistrict] = $row["SupplierID"];
	    	$SupplierName[$ddSubDistrict] = $row["SupplierName"];
	    	$SupplierEmail[$ddSubDistrict] = $row["SupplierEmail"];
	        $ddSubDistrict++;
	    }
	}
	$Supplier = [
		'ID'	=> $SupplierID,
		'name'	=> $SupplierName,
		'email'	=> $SupplierEmail,
	];
	echo json_encode($Supplier);



?>
