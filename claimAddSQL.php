<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$product=$dbManagement->select("SELECT product.ProductAmount FROM product WHERE ProductID='".$_REQUEST['ddProduct']."'");
	 			$ddProduct = 0;
	 				if (mysqli_num_rows($product) > 0) {
	 		   			 while($row = mysqli_fetch_assoc($product)) {
	 				        $ProductAmount[$ddProduct] = $row["ProductAmount"];
	 				        $ddProduct++;
	 		    		}
	 				}

$dbManagement->insert("INSERT INTO claim(ClaimDate, OrderID, ClaimAmount, ProductID, State, CustomerID, ClaimDetail) VALUES ('".$_REQUEST['txtDateClaim']."','".$_REQUEST['txtOrderID']."','".$_REQUEST['txtClaimAmount']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtClaimState']."','".$_REQUEST['txtCustomerID']."','".$_REQUEST['txtClaimDetail']."')");

$totalProduct = $ProductAmount[0]-$_REQUEST['txtClaimAmount'];

$dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['ddProduct']."'");

header( "location: /gobalchemicals/indexCustomer.php" );
?>