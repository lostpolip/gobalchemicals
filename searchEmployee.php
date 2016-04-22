
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  employee WHERE PositionID = 3 AND StateSick='มาทำงาน' ");
	$transport = $dbManagement->select("SELECT * FROM transport
									WHERE  TransportDate = '".$_REQUEST['datetransport']."'");

	// $transport = $dbManagement->select("SELECT * FROM transport
	// 								WHERE TimeAction = '".$_REQUEST['timeaction']."'
	// 								AND TransportDate = '".$_REQUEST['datetransport']."'");
	
	
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $EmployeeID[$i] = $row["EmployeeID"];
			        $EmployeeName[$i] = $row["EmployeeName"];
			        $available[$i] = '';
			        $i++;
	    }
	}



	$t=0;
	if (mysqli_num_rows($transport) > 0) {
	    while($row = mysqli_fetch_assoc($transport)) {
	        $EmployeeIDUnavailable[$t] = $row["EmployeeID"];
	        $t++;
		}
		for ($j = 0 ;$j < $t;$j++) {
			if (in_array($EmployeeIDUnavailable[$j],$EmployeeID)) {
				$available[array_search($EmployeeIDUnavailable[$j],$EmployeeID)] = 'disabled';
			}
		}
	}


	

	$Employee = [
		'ID'	=> $EmployeeID,
		'name'	=> $EmployeeName,
		'available'	=> $available,
	];
	
	echo json_encode($Employee);
?>
