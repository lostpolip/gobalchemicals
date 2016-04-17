<?php
	date_default_timezone_set('Asia/Bangkok');
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

	$TruckAll =$_REQUEST['truckId'];
	$IDBillTransport=$_REQUEST['transportId'];
	$date =$_REQUEST['dateTransport'];
	$expensesAround =$_REQUEST['hiddenExpensesPerAround'];

	$dbManagement->insert("INSERT INTO expenses(ExpensesID, StateExpenses, ExpensesDate) VALUES ('ES' '".$newID."', 'complete','".$date."')");


	$dbManagement->insert("INSERT INTO expensesdetail(TransportID, TruckID, ExpensesPerAround,ExpensesID) VALUES ('".$IDBillTransport."','".$TruckAll."','".$expensesAround."','ES' '".$newID."')");

	header( "location: /gobalchemicals/indexEmployee.php" );
?>
