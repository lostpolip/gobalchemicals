<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();

	$dbManagement->delete("DELETE FROM productreceive WHERE ReceiveID='".$_REQUEST['ReceiveID']."'");

	header( "location: /gobalchemicals/productReceive.php" );

?>