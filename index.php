<?php
session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT CustomerID,CustomerName,CustomerUsername,CustomerPassword FROM customer");

	$i = 0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$CustomerID[$i] = $row["CustomerID"];
	    	$CustomerName[$i] = $row["CustomerName"];
	        $CustomerUsername[$i] = $row["CustomerUsername"];
	        $CustomerPassword[$i] = $row["CustomerPassword"];	

	        $i++;
	    }
	}

	for($j=0; $j<$i; $j++){
		if($CustomerUsername[$j] ==  $_REQUEST['username'] && $CustomerPassword[$j] == $_REQUEST['password']){
			$_SESSION['CustomerID'] = $CustomerID[$j];
			$_SESSION['CustomerName'] = $CustomerName[$j];
		}
	}
	header( "location: /gobalchemicals/indexCustomer.php" );
?>