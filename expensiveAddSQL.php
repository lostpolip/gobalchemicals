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

	$dbManagement->insert("INSERT INTO expenses(ExpensesID, TransportID, ExpensesPerDay, ExpensesPerAround, StateExpenses) VALUES ('ES' '".$newID."','".$_REQUEST['transportId']."','".$_REQUEST['hiddenExpensesPerDay']."','".$_REQUEST['hiddenExpensesPerAround']."','complete')");

	header( "location: /gobalchemicals/indexEmployee.php" );

?>
