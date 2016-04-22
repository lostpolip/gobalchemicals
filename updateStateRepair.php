<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE truck SET StateRepair='".$_REQUEST['staterepair']."' WHERE TruckID='".$_REQUEST['id']."'");

	header( "location: /gobalchemicals/truck.php" );
?>