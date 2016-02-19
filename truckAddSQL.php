
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();


	$dbManagement->insert("INSERT INTO truck (TruckID,TruckName, TruckTypeID, FuelID, TruckWeight, WeightQuantity, WeightCapacity,StateTruck) VALUES ('".$_REQUEST['txtTruckID']."','".$_REQUEST['txtTruckName']."','".$_REQUEST['typeTruck']."','".$_REQUEST['fuelTruck']."',
		".$_REQUEST['txtTruckWeight'].",".$_REQUEST['txtTruckCapacity'].",'".$_REQUEST['txtTruckQuantity']."','confirm')");

	header( "location: /gobalchemicals/truck.php" );

?>