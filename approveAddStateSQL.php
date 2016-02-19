<?php

require 'dbManagement.php';
$dbManagement = new dbManagement();
$dbManagement->update("UPDATE claim SET StateClaim='confirm' WHERE ClaimID='".$_REQUEST['ClaimID']."'");
header( "location: /gobalchemicals/approveOrder.php" );
?>