<?php

	require 'dbManagement.php';
	$dbManagement = new dbManagement();	
	$dbManagement->update("UPDATE claim SET ClaimSendDate='".$_REQUEST['claimDate']."' WHERE ClaimID='".$_REQUEST['claimid']."'");


	header( "location: /gobalchemicals/approveClaim.php" );
?>