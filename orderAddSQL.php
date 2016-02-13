<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$orderID = $_REQUEST['order-id'];
	$orderIDArray = explode(' ',$orderID);
	foreach ($orderIDArray as $orderID) {
	$dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost) VALUES ('".$_REQUEST['hiddenproductID'.$orderID]."','".$_REQUEST['hiddenProductOrder'.$orderID]."','".$_REQUEST['hiddentotalUnitOrder'.$orderID]."','".$_REQUEST['hiddentotalPriceOrder'.$orderID]."')");
	}

	header( "location: /gobalchemicals/orderBasket.php" );

?>