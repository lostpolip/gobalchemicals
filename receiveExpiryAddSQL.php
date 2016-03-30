<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$productid = $_REQUEST['txtProduct'];
	$receiveid = $_REQUEST['idReceive'];
	
	$result = $dbManagement->select("SELECT * FROM product WHERE ProductID='".$productid."' ");

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $ProductID = $row["ProductID"];
		        $ProductAmount = $row["ProductAmount"];
		    }
		}

	
	$productAmount = $_REQUEST['txtProductAmount'];
	$temp = $ProductAmount-$productAmount;
	$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$productid."'");
	$dbManagement->delete("DELETE FROM productreceive WHERE ReceiveID='".$receiveid."'");

	header( "location: /gobalchemicals/indexEmployee.php" );

?>
