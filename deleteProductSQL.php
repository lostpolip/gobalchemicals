<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->delete("DELETE FROM product WHERE ProductID='".$_REQUEST['ProductID']."'");

header( "location: /gobalchemicals/product.php" );

?>