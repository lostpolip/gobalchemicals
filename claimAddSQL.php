<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
$dbManagement->insert("INSERT INTO claim(ClaimID, ClaimDate, OrderID, ClaimAmount, ProductTypeID, ProductID, State,CustomerID) VALUES ('".$_REQUEST['txtClaimID']."','".$_REQUEST['txtDateClaim']."','".$_REQUEST['txtOrderID']."','".$_REQUEST['txtClaimAmount']."','".$_REQUEST['ddTypeProduct']."','".$_REQUEST['ddProductName']."','".$_REQUEST['txtClaimState']."','".$_REQUEST['txtCustomerID']."')");

header( "location: /gobalchemicals/indexCustomer.php" );
?>