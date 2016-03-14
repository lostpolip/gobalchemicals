<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
date_default_timezone_set('Asia/Bangkok');
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
$claimIDArray = array_filter($claimIDArray);

	if ($claimID != '') {
	foreach ($claimIDArray as $claimID) {
		if ($_REQUEST['txtClaimAmount' . $claimID] != 0) {
			$dbManagement->insert("INSERT INTO claimDetail(OrderID, ClaimAmount, ProductID, ClaimProductDetail, ClaimID) VALUES ('".$_REQUEST['txtOrderID']."','".$_REQUEST['txtClaimAmount' . $claimID]."','".$_REQUEST['productID'.$claimID]."','".$_REQUEST['txtClaimDetail'.$claimID]."','CL' '".$newID."')");
			}
		}
		$dbManagement->insert("INSERT INTO claim(ClaimID, CustomerID ,StateClaim,ClaimDate, ClaimSendDate) VALUES ('CL' '".$newID."','".$_REQUEST['txtCustomerID']."','processing','".date("Y-m-d")."','0000-00-00')");	
	}
header( "location: /gobalchemicals/indexCustomer.php" );
?>