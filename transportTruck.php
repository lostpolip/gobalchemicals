<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  truck WHERE TruckID = '".$_REQUEST['truckID']."'");
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
			        $i++;
	    }
	}
	
	$Truck = [
		'ID'	=> $TruckID,
		'name'	=> $TruckName,
		'trucktype'	=> $TruckTypeID,
		'fuel'	=> $FuelID,
		'truckweight'	=> $TruckWeight,
		'weightcapacity'	=> $WeightCapacity,
	];
	echo json_encode($Truck);

?>