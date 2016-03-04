<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

    $employee = $dbManagement->select("SELECT * FROM employee");
    $i = 0;
    if (mysqli_num_rows($employee) > 0) {
        while($row = mysqli_fetch_assoc($employee)) {
            $EmployeeID[$i] = $row["EmployeeID"];
            $EmployeeName[$i] = $row["EmployeeName"];
            $EmployeeUsername[$i] = $row["EmployeeUsername"];
            $i++;
        }              
    }
    $username = $_REQUEST['txtUsername'];
	$x=0;
	for($j=0; $j<$i; $j++){

		if($username ==$EmployeeUsername[$j]){
			$x=$username;
			break;
		}
	}
		if (!$x== $username) {
	$dbManagement->insert("INSERT INTO employee(EmployeeName, EmployeeAddress, DistrictID, ProvinceID, ZipcodeID, EmployeeTel, PositionID, EmployeeUsername, EmployeePassword, AumphurID,StateEmployee) VALUES ('".$_REQUEST['txtEmployeeName']."','".$_REQUEST['txtEmployeeAddress']."','".$_REQUEST['txtSubDistrict']."','".$_REQUEST['province']."','".$_REQUEST['txtZipcode']."','".$_REQUEST['txtEmployeeTel']."','".$_REQUEST['positionEmployee']."','".$username."','".$_REQUEST['txtPassword']."','".$_REQUEST['txtDistrict']."','confirm')");
	}

	header( "location: /gobalchemicals/employee.php" );

?>