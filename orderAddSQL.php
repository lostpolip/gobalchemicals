<?php
	session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$order=$dbManagement->select("SELECT `OrderID` FROM `order` ");
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

	$dbManagement->insert("INSERT INTO `order`(`OrderID`, `CustomerID`, `State`, `OrderDate`) VALUES ('OR' '".$newID."','".$_SESSION['CustomerID']."','no','".date("Y-m-d")."')");
	

	// // $orderID = $_REQUEST['order-id'];
	// // $orderIDArray = explode(' ',$orderID);
	// foreach ($orderIDArray as $orderID) {
	// $dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost) VALUES ('".$_REQUEST['hiddenproductID'.$orderID]."','".$_REQUEST['hiddenProductOrder'.$orderID]."','".$_REQUEST['hiddentotalUnitOrder'.$orderID]."','".$_REQUEST['hiddentotalPriceOrder'.$orderID]."')");
	// }

	// header( "location: /gobalchemicals/orderBasket.php" );

?>