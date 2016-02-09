<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->delete("DELETE FROM truck WHERE TruckID ='".$_REQUEST['TruckID']."'");

	 header( "location: /gobalchemicals/truck.php" );

?>