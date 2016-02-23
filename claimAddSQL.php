<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
date_default_timezone_set('Asia/Bangkok');
// print_r($_REQUEST);exit;
$claim=$dbManagement->select("SELECT ClaimID FROM claim ");
$i = 0;
$maxID = 0;
if (mysqli_num_rows($claim) > 0) {
	while($row = mysqli_fetch_assoc($claim)) {
        $ClaimID[$i] = $row["ClaimID"];

        if ($maxID < str_replace('CL','',$ClaimID[$i])) {
        	$maxID = str_replace('CL','',$ClaimID[$i]);
        }
        $i++;
	}
}
$newID = $maxID + 1;
$claimID = $_REQUEST['claim-id'];
$claimIDArray = explode(',',$claimID);

// $claimIDArray = explode(' ',$ClaimID);
// $product=$dbManagement->select("SELECT product.ProductAmount FROM product WHERE ProductID='".$_REQUEST['ddProduct']."'");
// 	 			$ddProduct = 0;
// 	 				if (mysqli_num_rows($product) > 0) {
// 	 		   			 while($row = mysqli_fetch_assoc($product)) {
// 	 				        $ProductAmount[$ddProduct] = $row["ProductAmount"];
// 	 				        $ddProduct++;
// 	 		    		}
// 	 				}

foreach ($claimIDArray as $claimID) {
// if($_REQUEST['txtClaimAmount' . $claimID] != ''){
$dbManagement->insert("INSERT INTO claim(ClaimID,ClaimDate, OrderID, ClaimAmount, ProductID, StateClaim, CustomerID, ClaimDetail,ClaimSendDate) VALUES ('CL' '".$newID."','".date("Y-m-d")."','".$_REQUEST['txtOrderID']."','".$_REQUEST['txtClaimAmount' . $claimID]."','".$_REQUEST['productID'. $claimID]."','processing','".$_REQUEST['txtCustomerID']."','".$_REQUEST['txtClaimDetail'.$claimID]."','0000-00-00')");
	
}

// $totalProduct = $ProductAmount[0]-$_REQUEST['txtClaimAmount'];

// $dbManagement->update("UPDATE product SET ProductAmount='".$totalProduct."' WHERE ProductID='".$_REQUEST['ddProduct']."'");

// header( "location: /gobalchemicals/indexCustomer.php" );
?>