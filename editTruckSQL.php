<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$dbManagement->update("UPDATE truck SET TruckName='".$_REQUEST['txtTruckName']."',TruckTypeID='".$_REQUEST['typeTruck']."',FuelID='".$_REQUEST['fuelTruck']."',
		TruckWeight='".$_REQUEST['txtTruckWeight']."',WeightCapacity='".$_REQUEST['txtTruckCapacity']."',WeightQuantity='".$_REQUEST['txtTruckQuantity']."' WHERE TruckID='".$_REQUEST['txtTruckID']."'");
	header( "location: /gobalchemicals/truck.php" );


?>