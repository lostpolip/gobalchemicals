<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->insert("INSERT INTO employee(EmployeeName, EmployeeAddress, DistrictID, ProvinceID, ZipcodeID, EmployeeTel, PositionID, EmployeeUsername, EmployeePassword, AumphurID,StateEmployee) VALUES ('".$_REQUEST['txtEmployeeName']."','".$_REQUEST['txtEmployeeAddress']."','".$_REQUEST['txtSubDistrict']."','".$_REQUEST['province']."','".$_REQUEST['txtZipcode']."','".$_REQUEST['txtEmployeeTel']."','".$_REQUEST['positionEmployee']."','".$_REQUEST['txtUsername']."','".$_REQUEST['txtPassword']."','".$_REQUEST['txtDistrict']."','confirm')");


header( "location: /gobalchemicals/employee.php" );

?>