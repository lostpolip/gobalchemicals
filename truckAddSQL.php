
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();


	$dbManagement->insert("INSERT INTO truck (TruckID,TruckName, TruckTypeID, FuelID, TruckWeight, WeightQuantity, WeightCapacity,StateTruck,ConsumptionFuel, TruckCost, ResidualValue) VALUES ('".$_REQUEST['txtTruckID']."','".$_REQUEST['txtTruckName']."','".$_REQUEST['typeTruck']."','".$_REQUEST['fuelTruck']."',
		".$_REQUEST['txtTruckWeight'].",".$_REQUEST['txtTruckQuantity'].",'".$_REQUEST['txtTruckCapacity']."','confirm','".$_REQUEST['consumptionFuel']."','".$_REQUEST['costTruck']."','".$_REQUEST['residualValue']."')");

	header( "location: /gobalchemicals/truck.php" );

?>