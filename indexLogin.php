<?php
session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT EmployeeID,EmployeeName,EmployeeUsername,EmployeePassword FROM employee");

	$i = 0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$EmployeeID[$i] = $row["EmployeeID"];
	    	$EmployeeName[$i] = $row["EmployeeName"];
	        $EmployeeUsername[$i] = $row["EmployeeUsername"];
	        $EmployeePassword[$i] = $row["EmployeePassword"];	

	        $i++;
	    }
	}

	for($j=0; $j<$i; $j++){
		if($EmployeeUsername[$j] ==  $_REQUEST['username'] && $EmployeePassword[$j] == $_REQUEST['password']){
			$_SESSION['EmployeeID'] = $EmployeeID[$j];
			$_SESSION['EmployeeName'] = $EmployeeName[$j];
			
		}
	}
	header( "location: /gobalchemicals/indexEmployee.php" );

?>