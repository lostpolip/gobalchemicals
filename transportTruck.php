<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  truck WHERE WeightCapacity = ".$_REQUEST['truckWeight']."");
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $TruckID[$i] = $row["TruckID"];
			        $TruckName[$i] = $row["TruckName"];
			        $WeightCapacity[$i] = $row["WeightCapacity"];
			       

			        $i++;
	    }

	    $Truck = [
	    	'ID'	=> $TruckID,
	    	'name'	=> $TruckName,
	    	'weightcapacity' => $WeightCapacity,
	    ];
	} else {
		$Truck = null;
	}
	
	

	echo json_encode($Truck);

?>