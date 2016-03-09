<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  employee WHERE EmployeeID = '".$_REQUEST['employeeID']."'");
	$i=0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
			        $EmployeeID[$i] = $row["EmployeeID"];
			        $EmployeeName[$i] = $row["EmployeeName"];
			        $EmployeeTel[$i] = $row["EmployeeTel"];
			        $i++;
	    }
	}
	
	$Employee = [
		'ID'	=> $EmployeeID,
		'name'	=> $EmployeeName,
		'tel'	=> $EmployeeTel,
	];
	echo json_encode($Employee);
	
?>