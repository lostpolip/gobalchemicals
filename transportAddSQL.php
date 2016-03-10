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
$transportID = $_REQUEST['transport-id'];
$transportIDArray = explode(',',$transportID);
$transportIDArray = array_filter($transportIDArray);

	if ($transportID != '') {
	foreach ($transportIDArray as $transportID) {
		$dbManagement->insert("INSERT INTO transportdetail(TransportID, OrderID) VALUES ('TS' '".$newID."','".$_REQUEST['orderID'.$transportID]."')");
		// print_r("INSERT INTO transportdetail(TransportID, OrderID) VALUES ('TS' '".$newID."','".$_REQUEST['orderID'.$transportID]."')");
		}

		$dbManagement->insert("INSERT INTO transport(TransportID, TransportDate, TruckID, EmployeeID, TimeAction, TransportStatus, TotalWeightProduct) VALUES ('TS' '".$newID."','".$_REQUEST['hiddenDate']."','".$_REQUEST['hiddenTruck']."','".$_REQUEST['hiddenEmployee']."','".$_REQUEST['hiddenRouteTime']."','processing','".$_REQUEST['hiddenWeightProduct']."')");	
		// print_r("INSERT INTO transport(TransportID, TransportDate, TruckID, EmployeeID, TimeAction, TransportStatusID, TotalWeightProduct) VALUES ('TS' '".$newID."','".$_REQUEST['hiddenDate']."','".$_REQUEST['hiddenTruck']."','".$_REQUEST['hiddenEmployee']."','".$_REQUEST['hiddenRouteTime']."','processing','".$_REQUEST['hiddenWeightProduct']."')");
	}
// header( "location: /gobalchemicals/indexCustomer.php" );
?>