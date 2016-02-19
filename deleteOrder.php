ghf<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
$dbManagement->delete("DELETE FROM orders WHERE OrderID='".$_REQUEST['OrderID']."'");
$dbManagement->delete("DELETE FROM orderdetail WHERE OrderID='".$_REQUEST['OrderID']."'");

header( "location: /gobalchemicals/order.php" );

?>