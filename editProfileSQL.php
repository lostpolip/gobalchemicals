<?php
session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE customer SET CustomerName='".$_REQUEST['txtCustomerName']."',CustomerAddress='".$_REQUEST['txtCustomerAddress']."',DistrictID='".$_REQUEST['txtSubDistrict']."',ProvinceID='".$_REQUEST['province']."',
	ZipcodeID='".$_REQUEST['txtZipcode']."',CustomerTel='".$_REQUEST['txtCustomerTel']."',CustomerFax='".$_REQUEST['txtCustomerFax']."',CustomerEmail='".$_REQUEST['txtCustomerEmail']."',AumphurID='".$_REQUEST['txtDistrict']."' WHERE CustomerID='" .$_SESSION['CustomerID']."'");
	
	header( "location: /gobalchemicals/profileDetail.php" );
?>
