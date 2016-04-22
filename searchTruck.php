
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  truck  order by WeightCapacity");
	$transport = $dbManagement->select("SELECT * FROM transport
									WHERE TimeAction = '".$_REQUEST['timeaction']."'
									AND TransportDate = '".$_REQUEST['datetransport']."'");
	
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $TruckID[$i] = $row["TruckID"];
			        $TruckName[$i] = $row["TruckName"];
			        $TruckTypeID[$i] = $row["TruckTypeID"];
			        $FuelID[$i] = $row["FuelID"];
			        $TruckWeight[$i] = $row["TruckWeight"];
			        $WeightQuantity[$i] = $row["WeightQuantity"];
			        $WeightCapacity[$i] = $row["WeightCapacity"];
			        $StateTruck[$i] = $row["StateTruck"];
			        $StateRepair[$i] = $row["StateRepair"];
			        $MinWeight[$i] = $row["MinWeight"];
			        $available[$i] = '';
			        $i++;
	    }
	}



	$t=0;
	if (mysqli_num_rows($transport) > 0) {
	    while($row = mysqli_fetch_assoc($transport)) {
	        $TruckIDUnavailable[$t] = $row["TruckID"];
	        $t++;
		}
		for ($j = 0 ;$j < $t;$j++) {
			if (in_array($TruckIDUnavailable[$j],$TruckID)) {
				$available[array_search($TruckIDUnavailable[$j],$TruckID)] = 'disabled';
			}
		}
	}


	

	$Truck = [
		'ID'	=> $TruckID,
		'name'	=> $TruckName,
		'trucktype'	=> $TruckTypeID,
		'fuel'	=> $FuelID,
		'truckweight'	=> $TruckWeight,
		'weightcapacity'	=> $WeightCapacity,
		'staterepair'	=> $StateRepair,
		'minweight'	=> $MinWeight,
		'available'	=> $available,
	];
	
	echo json_encode($Truck);
?>
