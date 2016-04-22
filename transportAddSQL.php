<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

$expenses=$dbManagement->select("SELECT ExpensesID FROM expenses ");
$i = 0;
$maxID = 0;
if (mysqli_num_rows($expenses) > 0) {
	while($row = mysqli_fetch_assoc($expenses)) {
        $ExpensesID[$i] = $row["ExpensesID"];

        if ($maxID < str_replace('ES','',$ExpensesID[$i])) {
        	$maxID = str_replace('ES','',$ExpensesID[$i]);
        }
        $i++;
	}
}
$newID = $maxID + 1;

$transportId = $_REQUEST['transportId'];
$truckId = $_REQUEST['truckId'];
$employeeId = $_REQUEST['employeeId'];
$dateTransport = $_REQUEST['tomorrowDate'];
$timeTransport = $_REQUEST['timeTransport'];
$distance = $_REQUEST['distance'];
$expensesAround =$_REQUEST['hiddenExpensesPerAround'];
$orderID = $_REQUEST['orderid'];	
$OrderIDArray = explode(',',$orderID);


	$dbManagement->insert("INSERT INTO transport(TransportID, TransportStatus,AmountDistance,TransportDate, TruckID, EmployeeID, TimeAction) VALUES ('".$transportId."','processing','".$distance."','".$dateTransport."','".$truckId."','".$employeeId."','".$timeTransport."')");

	$dbManagement->insert("INSERT INTO expenses(ExpensesID, StateExpenses, ExpensesDate,TransportID, TruckID, ExpensesPerAround) VALUES ('ES' '".$newID."', 'complete','".$dateTransport."','".$transportId."','".$truckId."','".$expensesAround."')");

	if ($orderID != '') {
		foreach ($OrderIDArray as $orderID) {
			$dbManagement->update("UPDATE orders SET State='complete', SendOrder ='".$dateTransport."',TransportID='".$transportId."' WHERE OrderID='".$orderID."'");
		}
	}
	
header( "location: /gobalchemicals/billTransport.php" );

?>