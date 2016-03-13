<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$Transport=$dbManagement->select("SELECT TransportID FROM transport ");
$i = 0;
$maxID = 0;
if (mysqli_num_rows($Transport) > 0) {
	while($row = mysqli_fetch_assoc($Transport)) {
        $TransportID[$i] = $row["TransportID"];

        if ($maxID < str_replace('TS','',$TransportID[$i])) {
        	$maxID = str_replace('TS','',$TransportID[$i]);
        }
        $i++;
	}
}

$newID = $maxID + 1;
$orderID = $_REQUEST['orderid'];
$transportIDArray = explode(',',$orderID);
$transportIDArray = array_filter($transportIDArray);

	if ($orderID != '') {
	foreach ($transportIDArray as $orderID) {
		$dbManagement->insert("INSERT INTO transportdetail(TransportID, OrderID) VALUES ('TS' '".$newID."','".$orderID."')");

		$dbManagement->update("UPDATE orders SET State='sending' WHERE OrderID='".$orderID."'");

		}

		$dbManagement->insert("INSERT INTO transport(TransportID, TransportDate, TruckID, EmployeeID, TimeAction, TransportStatus, TotalWeightProduct,AmountDistance) VALUES ('TS' '".$newID."','".$_REQUEST['hiddenDate']."','".$_REQUEST['hiddenTruck']."','".$_REQUEST['hiddenEmployee']."','".$_REQUEST['hiddenRouteTime']."','processing','".$_REQUEST['hiddenWeightProduct']."','".$_REQUEST['totalDistance']."')");	

		
	}

	

?>