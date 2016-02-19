<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->update("UPDATE truck SET StateTruck='cancle' WHERE TruckID ='".$_REQUEST['TruckID']."'");

	 header( "location: /gobalchemicals/truck.php" );

?>