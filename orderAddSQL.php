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

	$orderid = explode(',',$_REQUEST['hiddenProductId']);
	$totalunit = explode(',',$_REQUEST['hiddenEachUnit']);
	foreach ($orderid as $key => $value) {
		$temp = $ProductAmount[array_search($orderid[$key],$ProductID)] - $totalunit[$key];
		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$orderid[$key]."'");
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

			$dbManagement->insert("INSERT INTO orders(OrderID, CustomerID, State, OrderDate, TotalPriceOrder, TotalVat, TotalTransport, ExtendedPrice,UnitProduct,TotalCostOrder, OrderSendDate,latOrder, lonOrder, DistanceOrder, ProvinceID) VALUES ('".$_REQUEST['hiddenOrderID']."','".$_SESSION['CustomerID']."','no','".$_REQUEST['hiddenOrderDate']."','".$TotalPriceAll."','".$TotalVat."','".$_REQUEST['totalTransaction']."','".$ExtendedPrice."','".$_REQUEST['hiddenUnitProductAll']."','".$_REQUEST['hiddenTotalCostAll']."','0000-00-00','".$_REQUEST['lat_value']."','".$_REQUEST['lon_value']."','".$_REQUEST['txtDistance']."','".$_REQUEST['province']."')");
	}

	header( "location: /gobalchemicals/formOrder.php?OrderID=$orderId" );

?>