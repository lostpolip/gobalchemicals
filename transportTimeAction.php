<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$employee = $dbManagement->select("SELECT * FROM employee "); 
	$transport = $dbManagement->select("SELECT * FROM transport 
									WHERE TimeAction = '".$_REQUEST['timeaction']."'
									AND TransportDate = '".$_REQUEST['datetransport']."'");
	$e=0;
	if (mysqli_num_rows($employee) > 0) {
	    while($row = mysqli_fetch_assoc($employee)) {
			        $EmployeeIDAll[$e] = $row["EmployeeID"];
			        $EmployeeNameAll[$e] = $row["EmployeeName"];
			        $e++;
	    }
	}

	$i=0;
	if (mysqli_num_rows($transport) > 0) {
	    while($row = mysqli_fetch_assoc($transport)) {
			        $EmployeeID[$i] = $row["EmployeeID"];
			        $i++;
	    }	
	    // print_r($EmployeeID);
	    foreach ($EmployeeID as $key) {
	    	if (in_array($key, $EmployeeIDAll)) {
	    		$EmployeeIDAll[array_search($key, $EmployeeIDAll)] = null;
	    		$EmployeeNameAll[array_search($key, $EmployeeIDAll)] = null;
	    		// echo array_search($key, $EmployeeIDAll);
	    	}
		}
	}

	
	echo json_encode($EmployeeNameAll);

?>