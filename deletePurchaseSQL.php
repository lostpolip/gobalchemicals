<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->delete("DELETE FROM purchase WHERE PurchaseID='".$_REQUEST['PurchaseID']."'");

header( "location: /gobalchemicals/productPurchase.php" );

?>