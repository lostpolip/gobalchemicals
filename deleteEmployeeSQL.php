<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->delete("DELETE FROM employee WHERE EmployeeID='".$_REQUEST['EmployeeID']."'");

header( "location: /gobalchemicals/employee.php" );

?>