<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->update("UPDATE employee SET StateEmployee='cancle' WHERE EmployeeID='".$_REQUEST['EmployeeID']."'");

header( "location: /gobalchemicals/employee.php" );

?>