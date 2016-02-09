<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE employee SET EmployeeName='".$_REQUEST['txtEmployeeName']."', EmployeeAddress='".$_REQUEST['txtEmployeeAddress']."', 
			DistrictID='".$_REQUEST['txtSubDistrict']."', ProvinceID='".$_REQUEST['province']."',ZipcodeID='".$_REQUEST['txtZipcode']."',EmployeeTel='".$_REQUEST['txtEmployeeTel']."',PositionID='".$_REQUEST['txtEmployeePosition']."',EmployeeUsername='".$_REQUEST['txtUsername']."',EmployeePassword='".$_REQUEST['txtPassword']."',AumphurID='".$_REQUEST['txtDistrict']."' WHERE EmployeeID='".$_REQUEST['txtEmployeeID']."'");
	 header( "location: /gobalchemicals/employee.php" );


?>
