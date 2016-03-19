
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$timeaction=$_REQUEST['timeaction'];
	$truckdate=$_REQUEST['datetransport'];
	$result = $dbManagement->select("SELECT * FROM  transport WHERE TimeAction = '".$timeaction."' AND TransportDate = '".$truckdate."'");

	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $TruckID[$i] = $row["TruckID"];
			        $i++;
	    }
	}
	

	echo json_encode($TruckID);
?>
