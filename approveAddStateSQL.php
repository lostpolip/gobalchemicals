<?php

require 'dbManagement.php';
$dbManagement = new dbManagement();
$dbManagement->update("UPDATE claim SET State='confirm' WHERE ClaimID='".$_REQUEST['ClaimID']."'");
print_r("UPDATE claim SET State='confirm' WHERE ClaimID='".$_REQUEST['ClaimID']."'");
// header( "location: /gobalchemicals/approveOrder.php" );
?>