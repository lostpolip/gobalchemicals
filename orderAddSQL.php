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

		$receive = $dbManagement->select("SELECT AmountMinusOrder,ExpiryDate,ProductID 
										 FROM productreceive
										 ORDER BY ExpiryDate ASC
										");

		$r = 0;
		if (mysqli_num_rows($receive) > 0) {
		    while($row = mysqli_fetch_assoc($receive)) {
		        $ExpiryDate[$r] = $row["ExpiryDate"];
			    $ProductIDReceive[$r] = $row["ProductID"];
		        $AmountMinusOrder[$r] = $row["AmountMinusOrder"];	
		        $r++;
		    }
		}

	$orderid = explode(',',$_REQUEST['hiddenProductId']);
	$totalunit = explode(',',$_REQUEST['hiddenEachUnit']);

	$productID = [];
	foreach ($orderid as $key => $value) {
		$temp = $ProductAmount[array_search($orderid[$key],$ProductID)] - $totalunit[$key];

		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$orderid[$key]."'");

		$receive2 = $dbManagement->select("SELECT AmountMinusOrder,ExpiryDate,ProductID  
										 FROM productreceive 
										 WHERE ProductID='".$orderid[$key]."' AND AmountMinusOrder > 0
										 ORDER BY ExpiryDate ASC
										");
		$r2 = 0;
		if (mysqli_num_rows($receive2) > 0) {
		    while($row = mysqli_fetch_assoc($receive2)) {
		        $ExpiryDate2[$r2] = $row["ExpiryDate"];
		        $AmountMinusOrder2[$r2] = $row["AmountMinusOrder"];	
			    $ProductIDReceive2[$r2] = $row["ProductID"];
		        $r2++;
		    }
		}

		for ($i=0;$i<$r2;$i++) {
			$temp2 = $AmountMinusOrder2[$i] - $totalunit[$key];

			if ($AmountMinusOrder2[$i] >= $totalunit[$key]) {
				$dbManagement->update("UPDATE productreceive SET AmountMinusOrder='".$temp2."'
		 					   WHERE ProductID='".$orderid[$key]."'
		 					   AND ExpiryDate='". $ExpiryDate2[$i]."'");
				break;
			} else {
				$totalunit[$key] = $totalunit[$key] -  $AmountMinusOrder2[$i]; 
				$dbManagement->update("UPDATE productreceive SET AmountMinusOrder='0'
		 					   WHERE ProductID='".$orderid[$key]."'
		 					   AND ExpiryDate='". $ExpiryDate2[$i]."'");
			}

			
		}

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

			$dbManagement->insert("INSERT INTO orders(OrderID, CustomerID, State, OrderDate, TotalPriceOrder, TotalVat, TotalTransport, ExtendedPrice,UnitProduct,TotalCostOrder, latOrder, lonOrder, DistanceOrder, AumphurID, SendOrder,OrderSendDate) VALUES ('".$_REQUEST['hiddenOrderID']."','".$_SESSION['CustomerID']."','no','".$_REQUEST['hiddenOrderDate']."','".$TotalPriceAll."','".$TotalVat."','".$_REQUEST['totalTransaction']."','".$ExtendedPrice."','".$_REQUEST['hiddenUnitProductAll']."','".$_REQUEST['hiddenTotalCostAll']."','".$_REQUEST['lat_value']."','".$_REQUEST['lon_value']."','".$_REQUEST['txtDistance']."','".$_REQUEST['txtDistrict']."','0000-00-00','".$_REQUEST['hiddenOrderSendDate']."')");
	}

	header( "location: /gobalchemicals/formOrder.php?OrderID=$orderId" );

?>