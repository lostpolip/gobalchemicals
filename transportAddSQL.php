<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$Transport=$dbManagement->select("SELECT TransportBillID FROM transport ");
$i = 0;
$maxID = 0;
if (mysqli_num_rows($Transport) > 0) {
	while($row = mysqli_fetch_assoc($Transport)) {
        $TransportBillID[$i] = $row["TransportBillID"];

        if ($maxID < str_replace('TS','',$TransportBillID[$i])) {
        	$maxID = str_replace('TS','',$TransportBillID[$i]);
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

	if ($orderID != '') {
		foreach ($transportIDArray as $orderID) {
			$dbManagement->insert("INSERT INTO transportdetail(TransportBillID, OrderID) VALUES ('TS' '".$newID."','".$orderID."')");

			$dbManagement->update("UPDATE orders SET State='complete', SendOrder ='".$_REQUEST['hiddenDate']."' WHERE OrderID='".$orderID."'");

		}

		$temp = 0;
		foreach ($transportTruckIDArray as $truckID) {
			$dbManagement->insert("INSERT INTO transport(TransportDate, TruckID, EmployeeID, TimeAction, TransportStatus, TotalWeightProduct,AmountDistance,TransportBillID) VALUES ('".$_REQUEST['hiddenDate']."','".$transportTruckIDArray[$temp]."','".$transportEmployeeIDArray[$temp]."','".$_REQUEST['hiddenRouteTime']."','processing','".$_REQUEST['hiddenWeightProduct']."','".$_REQUEST['totalDistance']."','TS' '".$newID."')");	
				$temp++;	
			}	
	}

	echo 'TS'.$newID;
	// echo $a;

?>