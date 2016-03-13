<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$Transport=$dbManagement->update("UPDATE transport SET AmountDistance='".$_REQUEST['totalDistance']."'");

?>