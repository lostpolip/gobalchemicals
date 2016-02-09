<?php

	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->insert("INSERT INTO customer(CustomerID, CustomerName, CustomerAddress, AumphurID, ProvinceID, ZipcodeID, CustomerTel, CustomerFax, CustomerEmail, CustomerUsername, CustomerPassword, DistrictID, Latitude, Longitude)  VALUES ('".$_REQUEST['txtCustomerID']."',
		'".$_REQUEST['txtName']."','".$_REQUEST['txtAddress']."','".$_REQUEST['txtDistrict']."','".$_REQUEST['province']."',
		'".$_REQUEST['txtZipcode']."','".$_REQUEST['txtTel']."','".$_REQUEST['txtFax']."','".$_REQUEST['txtEmail']."','".$_REQUEST['txtUsername']."','".$_REQUEST['txtPassword']."','".$_REQUEST['txtSubDistrict']."','".$_REQUEST['txtLatitude']."','".$_REQUEST['txtLongitude']."')");

	header( "location: /gobalchemicals/index.html" );


?>
