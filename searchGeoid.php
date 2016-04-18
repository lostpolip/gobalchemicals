<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$weightCar = $_REQUEST['weightCar'];
	$date = $_REQUEST['date'];
	$geoId = substr($_REQUEST['geoId'], -1);

	$result = $dbManagement->select("SELECT * FROM  aumphur
									JOIN orders ON aumphur.AumphurID=orders.AumphurID
									WHERE  State ='processing' AND UnitProduct <= $weightCar 
									AND GeoID = $geoId AND OrderSendDate = '".$date."'
									ORDER BY OrderSendDate");

	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	        $OrderID[$i] = $row["OrderID"];
	        $OrderSendDate[$i] = $row["OrderSendDate"];
	        $UnitProduct[$i] = $row["UnitProduct"];
	        $GeoID[$i] = $row["GeoID"];
	        $GeoName[$i] = $row["GeoName"];
	        $latOrder[$i] = $row["latOrder"];
	        $lonOrder[$i] = $row["lonOrder"];
	        $i++;
	    }

	    $order[$_REQUEST['geoId']] = [
    		'OrderID'	=> $OrderID,
    		'OrderSendDate'	=> $OrderSendDate,
    		'UnitProduct'	=> $UnitProduct,
    		'GeoID'	=> $GeoID,
    		'GeoName'	=> $GeoName,
    		'latOrder'	=> $latOrder,
    		'lonOrder'	=> $lonOrder,
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
			$orderInQueue[$key]['latOrder'][$i] = $order[$key]['latOrder'][$i];
			$orderInQueue[$key]['lonOrder'][$i] = $order[$key]['lonOrder'][$i];
			$orderInQueue[$key]['UnitProduct'][$i] = $order[$key]['UnitProduct'][$i];
		}
	}

	// echo '<pre>';
	// print_r($orderInQueue);
	echo json_encode($orderInQueue);
