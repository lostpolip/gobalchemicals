<?php
	print_r($_REQUEST);
	// session_start();
	// require 'dbManagement.php';
	// date_default_timezone_set('Asia/Bangkok');

	// $orderID = $_REQUEST['order-id'];
	// $orderIDArray = explode(' ',$orderID);


	// if ($orderID != '') {
	// 	foreach ($orderIDArray as $orderID) {
	// 			$dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost,OrderID,TotalPrice) VALUES ('".$_REQUEST['hiddenproductID'.$orderID]."','".$_REQUEST['hiddenProductOrder'.$orderID]."','".$_REQUEST['hiddentotalUnitOrder'.$orderID]."','".$_REQUEST['hiddentotalCostOrder'.$orderID]."','OR' '".$newID."','".$_REQUEST['hiddentotalPriceOrder'.$orderID]."')");
	// 			$totalPrice = $totalPrice + $_REQUEST['hiddentotalPriceOrder'.$orderID];
	// 			$totalCost = $totalCost + $_REQUEST['hiddentotalCostOrder'.$orderID];
	// 			$totalAmount = $totalAmount + $_REQUEST['hiddenProductOrder'.$orderID];
	// 		}

	// 		$totalVat= ($totalPrice*7)/100;
	// 		$extendedPrice = $totalPrice + $totalVat + $totaltransport;

	// 		$dbManagement->insert("INSERT INTO orders(`OrderID`, `CustomerID`, `State`, `OrderDate`, `TotalPriceOrder`, `TotalVat`, `TotalTransport`, `ExtendedPrice`,`UnitProduct`,`TotalCostOrder`) VALUES ('OR' '".$newID."','".$_SESSION['CustomerID']."','no','".date("Y-m-d")."','".$totalPrice."','".$totalVat."','".$_REQUEST['totalTransaction']."','".$extendedPrice."','".$totalAmount."','".$totalCost."')");
	// }

	// header( "location: /gobalchemicals/orderBasket.php" );

?>