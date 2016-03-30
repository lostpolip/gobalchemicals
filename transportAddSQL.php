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
$truckID = $_REQUEST['hiddenTruck'];
$employeeID = $_REQUEST['hiddenEmployee'];
$transportIDArray = explode(',',$orderID);
$transportTruckIDArray = explode(',',$truckID);
$transportEmployeeIDArray = explode(',',$employeeID);
$transportIDArray = array_filter($transportIDArray);
	
	$dbManagement->insert("INSERT INTO transport(TransportID, TransportStatus,TotalWeightProduct,AmountDistance) VALUES ('TS' '".$newID."','processing','".$_REQUEST['hiddenWeightProduct']."','".$_REQUEST['totalDistance']."')");

	if ($orderID != '') {
		foreach ($transportIDArray as $orderID) {

			$dbManagement->update("UPDATE orders SET State='complete', SendOrder ='".$_REQUEST['hiddenDate']."',TransportID='TS' '".$newID."' WHERE OrderID='".$orderID."'");

		}

		$temp = 0;
		foreach ($transportTruckIDArray as $truckID) {

			$dbManagement->insert("INSERT INTO transportdetail(TransportDate, TruckID, EmployeeID, TimeAction,TransportID) VALUES ('".$_REQUEST['hiddenDate']."','".$transportTruckIDArray[$temp]."','".$transportEmployeeIDArray[$temp]."','".$_REQUEST['hiddenRouteTime']."','TS' '".$newID."')");	
				$temp++;	
			}	
	}

	echo 'TS'.$newID;
	

?>