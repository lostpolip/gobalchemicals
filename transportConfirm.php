<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$transportID=$_REQUEST['TransportID'];
	$dbManagement->update("UPDATE transport SET TransportStatus='complete' WHERE TransportID='".$transportID."'");
	header( "location: /gobalchemicals/billTransport.php" );
?>
