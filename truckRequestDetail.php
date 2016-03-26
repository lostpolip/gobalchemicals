
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$timeaction=$_REQUEST['timeaction'];
	$truckdate=$_REQUEST['datetransport'];
	$Truck = $dbManagement->select("SELECT * FROM  transport
									 WHERE TimeAction = '".$timeaction."' AND TransportDate = '".$truckdate."'");

	$i=0;
	if (mysqli_num_rows($Truck) > 0) {
	    while($row = mysqli_fetch_assoc($Truck)) {
			        $TruckID[$i] = $row["TruckID"];
			        $i++;
	    }
	}

	// $Truck = [
	//     	'ID'	=> $TruckID,
	//     ];
	

	echo json_encode($TruckID);
?>
