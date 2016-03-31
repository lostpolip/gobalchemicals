<?php	
	session_start();
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
		$result = $dbManagement->select("SELECT * FROM product ");
		$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $i++;
			    }
		}

		// $receive = $dbManagement->select("SELECT AmountMinusOrder,ReceiveDate,ProductID 
		// 								 FROM productreceive
		// 								 ORDER BY ReceiveDate ASC
		// 								");

		// $r = 0;
		// if (mysqli_num_rows($receive) > 0) {
		//     while($row = mysqli_fetch_assoc($receive)) {
		//         $ReceiveDate[$r] = $row["ReceiveDate"];
		// 	    $ProductIDReceive[$r] = $row["ProductID"];
		//         $AmountMinusOrder[$r] = $row["AmountMinusOrder"];	
		//         $r++;
		//     }
		// }

	$orderid = explode(',',$_REQUEST['hiddenProductId']);
	$totalunit = explode(',',$_REQUEST['hiddenEachUnit']);

	foreach ($orderid as $key => $value) {
		$temp = $ProductAmount[array_search($orderid[$key],$ProductID)] - $totalunit[$key];
		// $temp2 = $AmountMinusOrder[array_search($orderid[$key],$ProductIDReceive)] - $totalunit[$key];

		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$orderid[$key]."'");

		// $dbManagement->update("UPDATE productreceive SET AmountMinusOrder='".$temp2."'
		// 						   WHERE ProductID='".$orderid[$key]."' ORDER BY ReceiveDate ASC");
		}
	

	$orderID = $_REQUEST['hiddenProductId'];
	$orderId = $_REQUEST['hiddenOrderID'];
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

			$dbManagement->insert("INSERT INTO orders(OrderID, CustomerID, State, OrderDate, TotalPriceOrder, TotalVat, TotalTransport, ExtendedPrice,UnitProduct,TotalCostOrder, latOrder, lonOrder, DistanceOrder, ProvinceID, SendOrder,OrderSendDate) VALUES ('".$_REQUEST['hiddenOrderID']."','".$_SESSION['CustomerID']."','no','".$_REQUEST['hiddenOrderDate']."','".$TotalPriceAll."','".$TotalVat."','".$_REQUEST['totalTransaction']."','".$ExtendedPrice."','".$_REQUEST['hiddenUnitProductAll']."','".$_REQUEST['hiddenTotalCostAll']."','".$_REQUEST['lat_value']."','".$_REQUEST['lon_value']."','".$_REQUEST['txtDistance']."','".$_REQUEST['province']."','0000-00-00','".$_REQUEST['hiddenOrderSendDate']."')");
	}

	header( "location: /gobalchemicals/formOrder.php?OrderID=$orderId" );

?>