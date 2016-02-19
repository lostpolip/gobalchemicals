<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$dbManagement->update("UPDATE product SET StateProduct='cancle' WHERE ProductID='".$_REQUEST['ProductID']."'");

header( "location: /gobalchemicals/product.php" );

?>