<?php	
	session_start();
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$orderID = $_REQUEST['hiddenProductId'];
	$orderIDArray = explode(',',$orderID);

	$totalPriceAll=$_REQUEST['totalPriceAll'];
	$totalVat=$_REQUEST['totalVat'];
	$totalExtendPrice=$_REQUEST['totalExtendPrice'];
	$TotalPriceAll=str_replace(',', '', $totalPriceAll);
	$TotalVat=str_replace(',', '', $totalVat);
	$ExtendedPrice=str_replace(',', '', $totalExtendPrice);

	if ($orderID != '') {
		foreach ($orderIDArray as $orderID) {
				$dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost,OrderID,TotalPrice) VALUES ('".$orderID."','".$_REQUEST['hiddenOrderAmount'.$orderID]."','".$_REQUEST['hiddenTotalUnit'.$orderID]."','".$_REQUEST['hiddenTotalCost'.$orderID]."','".$_REQUEST['hiddenOrderID']."','".$_REQUEST['hiddenTotalPrice'.$orderID]."')");


			}

			$dbManagement->insert("INSERT INTO orders(OrderID, CustomerID, State, OrderDate, TotalPriceOrder, TotalVat, TotalTransport, ExtendedPrice,UnitProduct,TotalCostOrder) VALUES ('".$_REQUEST['hiddenOrderID']."','".$_SESSION['CustomerID']."','no','".$_REQUEST['hiddenOrderDate']."','".$TotalPriceAll."','".$TotalVat."','".$_REQUEST['totalTransaction']."','".$ExtendedPrice."','".$_REQUEST['hiddenUnitProductAll']."','".$_REQUEST['hiddenTotalCostAll']."')");
	}

	header( "location: /gobalchemicals/order.php" );

?>