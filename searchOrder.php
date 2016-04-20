<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$weightCar = $_REQUEST['weightCar'];
	$datetransport = $_REQUEST['datetransport'];

	$Geo1 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 1 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");

	$Geo2 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 2 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");

	$Geo3 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 3 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");

	$Geo4 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 4 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");

	$Geo5 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 5 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");

	$Geo6 = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = 6 AND OrderSendDate = '".$datetransport."'
									ORDER BY OrderSendDate");
	
	$i1=0;
	if (mysqli_num_rows($Geo1) > 0) {
	    while($row = mysqli_fetch_assoc($Geo1)) {
	        $OrderID1[$i1] = $row["OrderID"];
	        $OrderSendDate1[$i1] = $row["OrderSendDate"];
	        $UnitProduct1[$i1] = $row["UnitProduct"];
	        $GeoID1[$i1] = $row["GeoID"];
	        $GeoName1[$i1] = $row["GeoName"];
	        $latOrder1[$i1] = $row["latOrder"];
	        $lonOrder1[$i1] = $row["lonOrder"];
	        $i1++;
	    }

	    $order['geoID1'] = [
    		'OrderID'	=> $OrderID1,
    		'OrderSendDate'	=> $OrderSendDate1,
    		'UnitProduct'	=> $UnitProduct1,
    		'GeoID'	=> $GeoID1,
    		'GeoName'	=> $GeoName1,
    		'latOrder'	=> $latOrder1,
    		'lonOrder'	=> $lonOrder1,
	    ];
	}

	$i2=0;
	if (mysqli_num_rows($Geo2) > 0) {
	    while($row = mysqli_fetch_assoc($Geo2)) {
	        $OrderID2[$i2] = $row["OrderID"];
	        $OrderSendDate2[$i2] = $row["OrderSendDate"];
	        $UnitProduct2[$i2] = $row["UnitProduct"];
	        $GeoID2[$i2] = $row["GeoID"];
	        $GeoName2[$i2] = $row["GeoName"];
	        $latOrder2[$i2] = $row["latOrder"];
	        $lonOrder2[$i2] = $row["lonOrder"];
	        $i2++;
	    }

	    $order['geoID2'] = [
    		'OrderID'	=> $OrderID2,
    		'OrderSendDate'	=> $OrderSendDate2,
    		'UnitProduct'	=> $UnitProduct2,
    		'GeoID'	=> $GeoID2,
    		'GeoName'	=> $GeoName2,
    		'latOrder'	=> $latOrder2,
    		'lonOrder'	=> $lonOrder2,
	    ];
	}

	$i3=0;
	if (mysqli_num_rows($Geo3) > 0) {
	    while($row = mysqli_fetch_assoc($Geo3)) {
	        $OrderID3[$i3] = $row["OrderID"];
	        $OrderSendDate3[$i3] = $row["OrderSendDate"];
	        $UnitProduct3[$i3] = $row["UnitProduct"];
	        $GeoID3[$i3] = $row["GeoID"];
	        $GeoName3[$i3] = $row["GeoName"];
	        $latOrder3[$i3] = $row["latOrder"];
	        $lonOrder3[$i3] = $row["lonOrder"];
	        $i3++;
	    }

	    $order['geoID3'] = [
    		'OrderID'	=> $OrderID3,
    		'OrderSendDate'	=> $OrderSendDate3,
    		'UnitProduct'	=> $UnitProduct3,
    		'GeoID'	=> $GeoID3,
    		'GeoName'	=> $GeoName3,
    		'latOrder'	=> $latOrder3,
    		'lonOrder'	=> $lonOrder3,
	    ];
	}

	$i4=0;
	if (mysqli_num_rows($Geo4) > 0) {
	    while($row = mysqli_fetch_assoc($Geo4)) {
	        $OrderID4[$i4] = $row["OrderID"];
	        $OrderSendDate4[$i4] = $row["OrderSendDate"];
	        $UnitProduct4[$i4] = $row["UnitProduct"];
	        $GeoID4[$i4] = $row["GeoID"];
	        $GeoName4[$i4] = $row["GeoName"];
	        $latOrder4[$i4] = $row["latOrder"];
	        $lonOrder4[$i4] = $row["lonOrder"];
	        $i4++;
	    }

	    $order['geoID4'] = [
    		'OrderID'	=> $OrderID4,
    		'OrderSendDate'	=> $OrderSendDate4,
    		'UnitProduct'	=> $UnitProduct4,
    		'GeoID'	=> $GeoID4,
    		'GeoName'	=> $GeoName4,
    		'latOrder'	=> $latOrder4,
    		'lonOrder'	=> $lonOrder4,
	    ];
	}

	$i5=0;
	if (mysqli_num_rows($Geo5) > 0) {
	    while($row = mysqli_fetch_assoc($Geo5)) {
	        $OrderID5[$i5] = $row["OrderID"];
	        $OrderSendDate5[$i5] = $row["OrderSendDate"];
	        $UnitProduct5[$i5] = $row["UnitProduct"];
	        $GeoID5[$i5] = $row["GeoID"];
	        $GeoName5[$i5] = $row["GeoName"];
	        $latOrder5[$i5] = $row["latOrder"];
	        $lonOrder5[$i5] = $row["lonOrder"];
	        $i5++;
	    }

	    $order['geoID5'] = [
    		'OrderID'	=> $OrderID5,
    		'OrderSendDate'	=> $OrderSendDate5,
    		'UnitProduct'	=> $UnitProduct5,
    		'GeoID'	=> $GeoID5,
    		'GeoName'	=> $GeoName5,
    		'latOrder'	=> $latOrder5,
    		'lonOrder'	=> $lonOrder5,
	    ];
	}

	$i6=0;
	if (mysqli_num_rows($Geo6) > 0) {
	    while($row = mysqli_fetch_assoc($Geo6)) {
	        $OrderID6[$i6] = $row["OrderID"];
	        $OrderSendDate6[$i6] = $row["OrderSendDate"];
	        $UnitProduct6[$i6] = $row["UnitProduct"];
	        $GeoID6[$i6] = $row["GeoID"];
	        $GeoName6[$i6] = $row["GeoName"];
	        $latOrder6[$i6] = $row["latOrder"];
	        $lonOrder6[$i6] = $row["lonOrder"];
	        $i6++;
	    }

	    $order['geoID6'] = [
    		'OrderID'	=> $OrderID6,
    		'OrderSendDate'	=> $OrderSendDate6,
    		'UnitProduct'	=> $UnitProduct6,
    		'GeoID'	=> $GeoID6,
    		'GeoName'	=> $GeoName6,
    		'latOrder'	=> $latOrder6,
    		'lonOrder'	=> $lonOrder6,
	    ];
	}

	foreach ($order as $key => $value) {
		$countWeight = 0;
		$i=0;
		foreach ($value['UnitProduct'] as $key2 => $value2) {
			$countWeight = $countWeight + $value2;
			if ($countWeight <= $weightCar) {
				$arrayInQueue[$key] = $i;
			}
			$i++;
		}
	}

	// print_r($order);
	foreach ($arrayInQueue as $key => $value) {
		for ($i=0; $i < $value + 1; $i++) {
			$orderInQueue[$key]['OrderID'][$i] = $order[$key]['OrderID'][$i];
			$orderInQueue[$key]['OrderSendDate'][$i] = $order[$key]['OrderSendDate'][$i];
			$orderInQueue[$key]['UnitProduct'][$i] = $order[$key]['UnitProduct'][$i];
			$orderInQueue[$key]['GeoID'][$i] = $order[$key]['GeoID'][$i];
			$orderInQueue[$key]['GeoName'][$i] = $order[$key]['GeoName'][$i];
			$orderInQueue[$key]['latOrder'][$i] = $order[$key]['latOrder'][$i];
			$orderInQueue[$key]['lonOrder'][$i] = $order[$key]['lonOrder'][$i];
		}
	}
	echo '<pre>';
	print_r($orderInQueue);
	// echo json_encode($orderInQueue);

?>
