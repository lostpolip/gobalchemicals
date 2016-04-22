<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE employee SET StateSick='".$_REQUEST['statesick']."' WHERE EmployeeID='".$_REQUEST['id']."'");

	header( "location: /gobalchemicals/employee.php" );


?>