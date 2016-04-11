
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  orders 
									ORDER BY OrderDate");
	
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $OrderID[$i] = $row["OrderID"];
			        $OrderID[$i] = $row["OrderID"];
			        $OrderDate[$i] = $row["OrderDate"];
			        $UnitProduct[$i] = $row["UnitProduct"];
			        $available[$i] = '';
			        $i++;
	    }
	}



	// $t=0;
	// if (mysqli_num_rows($transport) > 0) {
	//     while($row = mysqli_fetch_assoc($transport)) {
	//         $EmployeeIDUnavailable[$t] = $row["EmployeeID"];
	//         $t++;
	// 	}
	// 	for ($j = 0 ;$j < $t;$j++) {
	// 		if (in_array($EmployeeIDUnavailable[$j],$EmployeeID)) {
	// 			$available[array_search($EmployeeIDUnavailable[$j],$EmployeeID)] = 'disabled';
	// 		}
	// 	}
	// }


	

	$order = [
		'ID'	=> $OrderID,
		'date'	=> $OrderDate,
		'unit'	=> $UnitProduct,
		'available'	=> $available,
	];
	
	echo json_encode($order);
?>
