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
	$TruckAll =$_REQUEST['truck-id'];
	$truckIDArray = explode(',',$TruckAll);
	$ExpensesPerAround

	foreach ($truckIDArray as $TruckAll) {
		$a=$_REQUEST['transportId'.$TruckAll];
		$b=$_REQUEST['hiddenExpensesPerAround'.$TruckAll];
	}
	$dbManagement->insert("INSERT INTO expenses(ExpensesID, TransportID, ExpensesPerDay, ExpensesPerAround, StateExpenses, ExpensesDate) VALUES ('ES' '".$newID."','".a."','".$_REQUEST['hiddenExpensesPerDay']."','".$_REQUEST['hiddenExpensesPerAround']."','complete','".date("Y-m-d")."')");

	header( "location: /gobalchemicals/indexEmployee.php" );

?>
