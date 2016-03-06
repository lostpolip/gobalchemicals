<?php
	session_start();
	require 'dbManagement.php';
	date_default_timezone_set('Asia/Bangkok');
	$dbManagement = new dbManagement();
	$order=$dbManagement->select("SELECT OrderID FROM orders ");
	$i = 0;
	$maxID = 0;
	if (mysqli_num_rows($order) > 0) {
		while($row = mysqli_fetch_assoc($order)) {
	        $OrderID[$i] = $row["OrderID"];

	        if ($maxID < str_replace('OR','',$OrderID[$i])) {
	        	$maxID = str_replace('OR','',$OrderID[$i]);
	        }
	        $i++;
		}
	}

	$newID = $maxID + 1;
	$orderID = $_REQUEST['order-id'];
	$orderIDArray = explode(' ',$orderID);
	$totalPrice = 0;
	$totalAmount = 0;
	$totalVat=0;
	$totaltransport=$_REQUEST['totalTransaction'];
	$extendedPrice=0;

	if ($orderID != '') {
		foreach ($orderIDArray as $orderID) {
				$dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost,OrderID,TotalPrice) VALUES ('".$_REQUEST['hiddenproductID'.$orderID]."','".$_REQUEST['hiddenProductOrder'.$orderID]."','".$_REQUEST['hiddentotalUnitOrder'.$orderID]."','".$_REQUEST['hiddentotalCostOrder'.$orderID]."','OR' '".$newID."','".$_REQUEST['hiddentotalPriceOrder'.$orderID]."')");
				$totalPrice = $totalPrice + $_REQUEST['hiddentotalPriceOrder'.$orderID];
				$totalAmount = $totalAmount + $_REQUEST['hiddenProductOrder'.$orderID];
			}

			$totalVat= ($totalPrice*7)/100;
			$extendedPrice = $totalPrice + $totalVat + $totaltransport;

			$dbManagement->insert("INSERT INTO orders(`OrderID`, `CustomerID`, `State`, `OrderDate`, `TotalPriceOrder`, `TotalVat`, `TotalTransport`, `ExtendedPrice`,`UnitProduct`) VALUES ('OR' '".$newID."','".$_SESSION['CustomerID']."','no','".date("Y-m-d")."','".$totalPrice."','".$totalVat."','".$_REQUEST['totalTransaction']."','".$extendedPrice."','".$totalAmount."')");
	}

	header( "location: /gobalchemicals/orderBasket.php" );

?>